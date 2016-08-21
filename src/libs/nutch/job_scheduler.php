<?php 

namespace Nutch;

\App::import('Lib', [
    'filter_utils',
    'nutch/nutch',
    'nutch/job_info',
    'nutch/nutch_config',
    'nutch/nutch_client',
    'nutch/remote_cmd_executor'
]);

class JobScheduler extends \Object {

  const JOB_INTERVAL = 15; // 15s
  const LOCK_TTL = 600; // 10m

  /**
   * @var \NutchJob
   */
  private $NutchJob;
  /**
   * @var \AppController
   */
  private $controller;
  /**
   * @var \Nutch\RemoteCmdExecutor
   */
  private $remoteCmdExecutor;
  /**
   * @var \Nutch\NutchClient
   */
  private $nutchClient;

  public function __construct($controller) {
    $this->controller = &$controller;

    $this->_loadNutchJobModel();

    $this->remoteCmdExecutor = new RemoteCmdExecutor();
    $this->nutchClient = new NutchClient();
  }

  public function setDebugMsg($debugMsg) {
    $this->remoteCmdExecutor->setDebugMsg($debugMsg);
    $this->nutchClient->setDebugMsg($debugMsg);
  }

  /**
   * Create a new nutch config if not exist
   * @param $crawl The Crawl
   * @param $configId The specified configId, if set to be null, use $crawl['Crawl']['configId'],
   *        if both passed $configId and $crawl['Crawl']['configId'] are empty, calculate one by the server
   * @return array
   * */
  public function createNutchConfig($crawl, $configId = null, $priority = "minor") {
    if(!$this->_validateCrawl($crawl)) {
      return ['configId' => null, 'state' => 'BAD_CRAWL'];
    }

    // use specified config id
    if (!empty($configId)) {
      $crawl['Crawl']['configId'] = $configId;
      $this->log('User user defined configId '.$configId, 'info');
    }

    // create nutch config in nutch server
    $configId = $this->remoteCmdExecutor->createNutchConfig($crawl, $priority);
    
    // currently, handles only DUPLICATE exception
    if (empty($configId)) {
      return ['configId' => $configId, 'state' => 'DUPLICATE'];
    }

    // save config id for further usage
    $crawl_id = $crawl['Crawl']['id'];
    if ($priority == "major") {
      $this->NutchJob->Crawl->id = $crawl_id;
      if (!$this->NutchJob->Crawl->saveField('configId', $configId)) {
        $this->log("Can not save configId for crawl #$crawl_id");
      }
    }

    return ['configId' => $configId, 'state' => 'OK'];
  }

  public function createSeed($crawl, $updateCrawl = true) {
    if(!$this->_validateCrawl($crawl, " line #".__LINE__)) {
      return null;
    }

    $crawl_id = $crawl['Crawl']['id'];
    $seedDirectory = $this->remoteCmdExecutor->createSeed($crawl);

    if (striContains($seedDirectory, 'exception')) {
      $this->log("Failed to create seedDirectory for Crawl #$crawl_id, message : $seedDirectory");
      return null;
    }

    if ($updateCrawl) {
      $this->NutchJob->Crawl->id = $crawl_id;
      if (!$this->NutchJob->Crawl->saveField('seedDirectory', $seedDirectory)) {
        $this->log("Failed to update seedDirectory for #$crawl_id");
      }
    }

    return $seedDirectory;
  }

  /**
   * @return \NutchJob|null
   */
  public function inject($crawl) {
    if(!$this->_validateCrawl($crawl, " line #".__LINE__)) {
      return null;
    }

    if (!empty($crawl['Crawl']['batchId'])) {
      $this->log("Failed to inect, batchId is not empty");
      return null;
    }

    if (empty($crawl['Crawl']['seedDirectory'])) {
      $this->log("Failed to inect, seed directory is empty");
      return null;
    }

    return $this->createNutchJob($crawl, JobType::INJECT);
  }

  public function runParseChecker($crawl) {
    if(!$this->_validateCrawl($crawl, " line #".__LINE__)) {
      return null;
    }

    if (empty($crawl['Crawl']['test_url'])) {
      $this->log("Failed to run parse checker, invalid test url");
      return null;
    }

    $jobType = JobType::PARSECHECKER;
    $jobId = $this->createNutchJob($crawl, $jobType);

    $this->log("Run parse checker, job id : $jobId", 'info');

    return $jobId;
  }

  public function createNutchJob($crawl, $jobType, $batchId = null, $round = 0) {
    if (!$this->_validateCrawl($crawl, " line #".__LINE__)) {
      return false;
    }

    $user_id = $crawl['Crawl']['user_id'];
    $crawl_id = $crawl['Crawl']['id'];
    $crawlId = $crawl['Crawl']['crawlId'];
    $configId = $crawl['Crawl']['configId'];

    // Submit the Job
    $crawl['Crawl']['batchId'] = $batchId;
    $rawMsg = $this->remoteCmdExecutor->executeRemoteJob($crawl, $jobType);

    $jobId = $rawMsg;

    if (empty($jobId) || striContains($jobId, 'exception')) {
      $this->log("Failed to create Nutch Job $jobType, message : ".$rawMsg);
      return false;
    }

    // Record the submission result
    $data = [
        'round' => $round,
        'crawlId' => $crawlId,
        'confId' => $configId,
        'batchId' => $batchId,
        'jobId' => $jobId,
        'type' => $jobType,
        'state' => 'CREATED',
        'raw_msg' => $rawMsg,
        'crawl_id' => $crawl_id,
        'user_id' => $user_id
    ];

    $this->NutchJob->create();
    if (!$this->NutchJob->save($data)) {
      $this->log("Failed to save nutch job for crawl #$crawl_id");
    }

    $nutch_job_id = $this->NutchJob->id;
    $this->log("Created new NutchJob #$nutch_job_id, #$crawl_id, $jobId", LOG_INFO);

    return $jobId;
  }

  /**
   * Schedule crawl jobs, for every JOB_INTERVAL, we select some
   * crawl jobs to execute.
   * 
   * The crawl job to be schedule can be one of the following:
   * GENERATE, FETCH, PARSE, UPDATEDB
   * 
   * @see global variable $jobChangeMap
   * 
   * $jobChangeMap = array(
   *    "NONE" => "INJECT",
   *    "INJECT" => "GENERATE",
   *    "GENERATE" => "FETCH",
   *    "FETCH" => "PARSE",
   *    "PARSE" => "UPDATEDB",
   *    "UPDATEDB" => "INDEX",
   *    "INDEX" => "GENERATE"
   *  );
   * 
   * */
  public function schedule() {
    if (!$this->_check_timeout("crawl_jobs_scheduler", self::JOB_INTERVAL)) {
      return;
    }

    $limit = 5;

    // Explicitly disable in-memory query caching
    $this->_loadNutchJobModel();
    $cacheQueries = $this->NutchJob->cacheQueries;
    $this->NutchJob->cacheQueries = false;

    $this->NutchJob->contain(['Crawl' => 'CrawlFilter']);
    $nutchJobs = $this->NutchJob->find('all', [
        'fields' => ['id', 'round', 'jobId', 'crawlId', 'batchId', 'state', 'type', 'count', 'crawl_id', 'user_id'],
        'conditions' => [
            "NutchJob.state NOT IN('STOPPED', 'COMPLETED', 'FAILED_COMPLETED')",
        ],
        'limit' => $limit,
        'order' => 'NutchJob.id DESC'
    ]);

    $count = count($nutchJobs);
    if ($count > 0) {
      // $this->log("Schedule $count nutch jobs", 'debug');
    }

    $min = date('Hi');
    foreach ($nutchJobs as $nutchJob) {
      $crawl_id = $nutchJob['NutchJob']['crawl_id'];

//       $this->log("", 'debug');
//       $this->log("$crawl_id-$id------------------------", 'debug');

      $lockId = $crawl_id.'_'.$min;
      $fp = $this->_get_lock_fp($lockId);
      if ($this->_try_lock($fp, $lockId)) {
        $this->_doScheduleJob($nutchJob);
      }

      $success = $this->_try_unlock($fp, $lockId);
      if ($success) {
        $this->_remove_lock_file($lockId);
      }
    } // foreach

    // Reset cacheQueries
    $this->NutchJob->cacheQueries = $cacheQueries;
  }

  private function _doScheduleJob($nutchJob) {
    if ($this->_checkCrawlCompleted($nutchJob)) {
    	return;
    }

    $job_id = $nutchJob['NutchJob']['id'];
    $crawl_id = $nutchJob['NutchJob']['crawl_id'];
    $type = $nutchJob['NutchJob']['type'];
    $state = $nutchJob['NutchJob']['state'];
    $crawlState = $nutchJob['Crawl']['state'];

    // Adjust data structure for consistency
    $nutchJob['CrawlFilter'] = $nutchJob['Crawl']['CrawlFilter'];
    $crawl = $nutchJob;

    // Create nutch config if not exist
    $configId = $this->createNutchConfig($crawl, null, "major");
    if ($configId['state'] != 'DUPLICATE') {
    	$this->log("A new config id has been created during schedule, "
    			."this may indicate that the server has been restarted", LOG_INFO);
    }

    // Start scheduling jobs
    global $jobChangeMap;
    $crawlRunning = in_array($crawlState, [CrawlState::RUNNING]);
    $circular = in_array($type, array_values($jobChangeMap));
    $jobNeedSchedule = in_array($state, [JobState::FINISHED, JobState::NOT_FOUND]);

    // Circular jobs
    if ($circular) {
      // Must not update job info while the job is under scheduling
      if ($crawlRunning && $jobNeedSchedule) {
        $this->_scheduleNextJob($nutchJob);
      }

      // When the current job is finished, we update it's info the next circle
      $crawlRunning = !in_array($crawlState, [CrawlState::FINISHED, CrawlState::STOPPED]);
      if ($crawlRunning && !$jobNeedSchedule) {
        $this->_updateJobInfo($nutchJob);
      }
    } // if circular

    // Non circular jobs
    if (!$circular) {
      $this->_updateJobInfo($nutchJob);
      $this->_updateCompletedNonCircularJobs($job_id, $crawl_id);
    }

    // handle failed jobs
    if ($state == JobState::FAILED) {
      $this->_handleFailedJob($nutchJob);
    }
  }

  private function _checkCrawlCompleted($nutchJob) {
    $crawlStatus = $nutchJob['Crawl']['state'];
    if (CrawlState::COMPLETED == $crawlStatus || CrawlState::STOPPED == $crawlStatus) {
      return true;
    }

    $job_id = $nutchJob['NutchJob']['id'];
  	$crawl_id = $nutchJob['Crawl']['id'];

  	$round = $nutchJob['NutchJob']['round'];
  	$maxRound = $nutchJob['Crawl']['rounds'];

  	$fetchedPages = $nutchJob['Crawl']['fetched_pages'];
  	$maxPages = $nutchJob['Crawl']['limit'];

  	$crawlCompleted = false;

  	// Complete all jobs belongs to this crawl
  	if ($round > $maxRound) {
  		$this->log("All rounds done, round : $round, max round : $maxRound."
  				." Complete crawl #$crawl_id", 'info');

  		$this->_completeCrawl($job_id, $crawl_id);
  		$crawlCompleted = true;
  	}

  	if ($fetchedPages > $maxPages) {
  		$this->log("All pages done, fetched pages : $fetchedPages, expected pages : $maxPages."
  				." Complete crawl #$crawl_id", 'info');

  		$this->_completeCrawl($job_id, $crawl_id);
  		$crawlCompleted = true;
  	}

  	return $crawlCompleted;
  }

  /**
   * Schedule next job inside a crawl round
   * */
  private function _scheduleNextJob($nutchJob) {
    if (!$this->_validateNutchJob($nutchJob, " line #".__LINE__)) {
      return;
    }

    $job_id = $nutchJob['NutchJob']['id'];
    $jobId = $nutchJob['NutchJob']['jobId'];
    $batchId = $nutchJob['NutchJob']['batchId'];
    $round = $nutchJob['NutchJob']['round'];
    $currentJobType = $nutchJob['NutchJob']['type'];
    $crawl_id = $nutchJob['NutchJob']['crawl_id'];
    $user_id = $nutchJob['NutchJob']['user_id'];

    if (empty($jobId)) {
      $this->log("Invalid jobId in NutchJob #$job_id");
      return;
    }

    global $jobChangeMap;

    // execute the next job inside a crawl round
    if (key_exists($currentJobType, $jobChangeMap)) {
      $nextJobType = $jobChangeMap[$currentJobType];

      $this->log("Schedule job for crawl #$crawl_id, $currentJobType -> $nextJobType", 'info');

      // Update finished round
      $this->NutchJob->Crawl->id = $crawl_id;
      if (!$this->NutchJob->Crawl->saveField('finished_rounds', $round)) {
        $this->log("Failed to save finished_rounds for crawl #".$crawl_id);
      }

      // The next round
      // Generate batchId for the next job
      if ($nextJobType == JobType::GENERATE) {
        $round += 1;
        $batchId = '-'.$round.'-'.$user_id.'-'.$crawl_id.'-'.date('Ymd-His');
      }

      // Create nutch job
      $crawl = $nutchJob;
      $crawl['CrawlFilter'] = $crawl['Crawl']['CrawlFilter'];
      // May try for several times
      $jobId = $this->createNutchJob($crawl, $nextJobType, $batchId, $round);
      // Set completed job status to be COMPLETED
      if ($jobId) {
      	// Nutch job created successful
      	$this->_updateCompletedCircularJobs($job_id, $crawl_id);
      }
      else {
      	$this->log("Failed to schedule job for crawl #$crawl_id, "
      			."$currentJobType -> $nextJobType, will try later", 'info');
      }
    } // if
  }

  private function _handleFailedJob($nutchJob) {
    $id = $this->NutchJob->id = $nutchJob['NutchJob']['id'];

    if (!$this->NutchJob->saveField('state', JobState::FAILED_COMPLETED)) {
      $this->log("Failed to update nutch job  #$id");
    }
  }

  private function _updateCompletedCircularJobs($job_id, $crawl_id) {
    if (!$job_id && $crawl_id) {
      $this->log("Invalid Argument : $job_id, $crawl_id");
      return;
    }

    // Once we can not find the job in Nutch Server, it's completed
    $db =& \ConnectionManager::getDataSource('default');
    $sql = "UPDATE `nutch_jobs` SET `state`='COMPLETED'"
        ." WHERE `crawl_id`=$crawl_id"
        ." AND `id` <= $job_id"
         ." AND `type` IN ('INJECT', 'GENERATE', 'FETCH', 'PARSE', 'UPDATEDB', 'INDEX')"
        ." AND `state` IN ('NOT_FOUND', 'FINISHED', 'RUNNING');";
    $db->execute($sql);

    // Update crawl fetched pages
    $sql = "SELECT SUM(`count`) AS `count` FROM `nutch_jobs` WHERE `crawl_id`=$crawl_id AND `type`='FETCH'";
    $fetchedPages = $db->query($sql);
    $fetchedPages = $fetchedPages[0][0]['count'];

    if ($fetchedPages) {
      $sql = "UPDATE `crawls` SET `fetched_pages`=$fetchedPages WHERE `id`=$crawl_id";
      $db->execute($sql);
    }
  }

  private function _updateCompletedNonCircularJobs($job_id, $crawl_id) {
    if (!$job_id && $crawl_id) {
      $this->log("Invalid Argument : $job_id, $crawl_id");
      return;
    }

    // Once we can not find the job in Nutch Server, it's completed
    $db =& \ConnectionManager::getDataSource('default');
    $sql = "UPDATE `nutch_jobs` SET `state`='COMPLETED'"
        ." WHERE `crawl_id`=$crawl_id"
        ." AND `id` <= $job_id"
        ." AND `type` NOT IN ('INJECT', 'GENERATE', 'FETCH', 'PARSE', 'UPDATEDB', 'INDEX')"
        ." AND (`state`='NOT_FOUND' OR `state`='FINISHED');";
    // $this->log($sql, 'info');
    $db->execute($sql);
  }

  private function _completeCrawl($job_id, $crawl_id) {
    if (!$job_id && $crawl_id) {
      $this->log("Invalid Argument : $job_id, $crawl_id");
      return;
    }

    $db =& \ConnectionManager::getDataSource('default');
    $sql = "UPDATE `crawls` SET `state`='COMPLETED' WHERE `id`=$crawl_id";
    $db->execute($sql);

    $sql = "UPDATE `nutch_jobs` SET `state`='COMPLETED'"
    		." WHERE `crawl_id`=$crawl_id"
    		." AND `id` <= $job_id"
    		." AND `type` IN ('INJECT', 'GENERATE', 'FETCH', 'PARSE', 'UPDATEDB', 'INDEX')"
        ." AND `state` NOT IN ('COMPLETED', 'FAILED_COMPLETED');";
    $db->execute($sql);

    $this->log("Crawl #$crawl_id is completed", 'info');
  }

  /**
   * update job state
   * @param $nutchJob \NutchJob
   * @param $force bool
   * @return array status
   * */
  private function _updateJobInfo($nutchJob, $force = false) {
    if (!$this->_validateNutchJob($nutchJob, " line #".__LINE__)) {
      return ['rawMsg' => "Invalid nutch job", 'job' => null];
    }

    $job_id = $nutchJob['NutchJob']['id'];
    $crawl_id = $nutchJob['NutchJob']['crawl_id'];
    $jobId = $nutchJob['NutchJob']['jobId'];
    $state = $nutchJob['NutchJob']['state'];
    $round = $nutchJob['NutchJob']['round'];
    $count = $nutchJob['NutchJob']['count'];

    // $this->log('-----------update job info------------', 'debug');

    if (!$force) {
      $ignoreStatus = [
          JobState::COMPLETED,
          JobState::FAILED_COMPLETED,
          JobState::NOT_FOUND
      ];
      if (in_array($state, $ignoreStatus)) {
        return ['rawMsg' => "Ignored Status $state", 'job' => null];
      }
    }

    // update job status
    $rawMsg = $this->nutchClient->getJobInfo($jobId);

    if (empty($rawMsg) || striContains($rawMsg, '{"exception')) {
      $this->log("Failed to get JobInfo".$rawMsg);
      return ['rawMsg' => $rawMsg, 'job' => null];
    }

    $jobInfo = qi_json_decode($rawMsg, true, 10, JSON_BIGINT_AS_STRING);
    $affectedRows = $jobInfo['affectedRows'];
    if ($affectedRows < $count) {
      // the message if from another task in the same job
      // and this is also not accurate enough
      $affectedRows += $count;
    }

    $data = [
        'id' => $job_id,
        'state' => $jobInfo['state'],
        'args' => json_encode($jobInfo['args'], JSON_PRETTY_PRINT),
        'msg' => $jobInfo['msg'],
        'raw_msg' => $rawMsg,
        'count' => $affectedRows
    ];

    if (!$this->NutchJob->save($data)) {
      $this->log("Failed to update nutch job  #$job_id");
    }

    // Nothing to fetch, complete the job, and also the crawl
    // 4 * 5 + 1 : every round have 4 tasks
    $recentAffectedRows = $this->_getRecentAffectedRows($crawl_id, 4 * 5 + 1);
    if ($round > 5 && $recentAffectedRows == 0) {
    	$this->log("No rows affected during last 5 rounds, complete the crawl", 'info');
    	$this->_completeCrawl($job_id, $crawl_id);
    }

    return ['rawMsg' => $rawMsg, 'job' => $jobInfo];
  }

  private function _getRecentAffectedRows($crawl_id, $limit = 10) {
  	$db =& \ConnectionManager::getDataSource('default');

  	$sql = "SELECT SUM(`count`) AS `count` FROM "
  			." (SELECT `count` FROM `nutch_jobs` WHERE `crawl_id`=$crawl_id ORDER BY `id` DESC LIMIT $limit)"
  			." AS AffectedRows;";
  	$count = $db->query($sql);
  	$count = $count[0][0]['count'];

  	return $count;
  }

  // TODO : This is a very simple inter process timer, find better solution!
  private function _check_timeout($timerId, $timeout) {
    $lockFile = LOCK_DIR . 'timer-' . $timerId;
    if(file_exists($lockFile)) {

//      $this->log("time : ".time()." filetime : ".filemtime($lockFile), LOG_INFO);

      // lock time out
      if (time() - filemtime($lockFile) > $timeout) {
        touch($lockFile);

        // $this->log("Timer file timed out", LOG_INFO);

        return true;
      }

      return false;
    }

    $fp = fopen($lockFile, 'w');
    fwrite($fp, $timerId);

//    $this->log("Lock $id OK", LOG_INFO);

    return true;
  }

  private function _remove_timeout_lock_file($lockId, $timeout) {
  	$lockFile = LOCK_DIR . 'crawl_' . $lockId;

  	if(file_exists($lockFile)) {
  		// $this->log("time : ".time()." filetime : ".filemtime($lockFile), LOG_INFO);

  		// lock time out
  		if (time() - filemtime($lockFile) > $timeout) {
  			unlink($lockFile);

  			$this->log("Lock file removed", LOG_INFO);

  			return true;
  		}

  		return false;
  	}

  	return true;
  }

  private function _get_lock_fp($lockId) {
    $lockFile = LOCK_DIR . 'crawl_' . $lockId;

//    $this->log("Lock file $lockId", 'debug');

    $fp = fopen($lockFile, 'w');

    return $fp;
  }

  private function _try_lock($fp, $lockId) {
    /* Activate the LOCK_NB option on an LOCK_EX operation */
    // No blocking, return immediately if the lock is not available
    if(!flock($fp, LOCK_EX | LOCK_NB)) {
      $this->log("Lock $lockId failed", LOG_INFO);
      return false;
    }

//    $this->log("Lock $lockId OK", "debug");

    return true;
  }

  private function _try_unlock($fp, $lockId) {
    // release the lock
    if (!flock($fp, LOCK_UN)) {
      $this->log("Unlock $lockId failed", LOG_INFO);

      fclose($fp);

      return false;
    }

    fclose($fp);

//    $this->log("Unlock $lockId OK", "debug");

    // $this->_remove_timeout_lock_file($lockId, LOCK_TTL);

    return true;
  }

  private function _remove_lock_file($lockId) {
  	$lockFile = LOCK_DIR . 'crawl_' . $lockId;
  
  	//    $this->log("Lock file $lockId", 'debug');

  	if (!unlink($lockFile)) {
  		$this->log("Failed to remove lock file $lockId");
  	}
  }

  private function _loadNutchJobModel() {
    $this->controller->loadModel('NutchJob');
    $this->NutchJob = &$this->controller->NutchJob;
  }

  /**
   * @param $nutchJob array
   * @param $msg string
   * @return bool
   */
  private function _validateNutchJob($nutchJob, $msg = "") {
    $valid = true;

    $valid = $valid && !empty($nutchJob['NutchJob']['id']);
    $valid = $valid && $this->_validateCrawl($nutchJob);

    if (!$valid) {
      $this->log("Invalid Nutch Job ".json_encode($nutchJob).", message : ".$msg);
      // $this->log(json_encode($nutchJob));
    }

    return $valid;
  }

  private function _validateCrawl($crawl, $msg = "") {
    $valid = true;

    $valid = $valid && !empty($crawl['Crawl']['id']);
    $valid = $valid && !empty($crawl['CrawlFilter']);

    if (!$valid) {
      $this->log("Invalid Crawl, ".json_encode($crawl).", message : ".$msg);
    }
  
    return $valid;
  }
}
