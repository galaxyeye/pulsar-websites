<?php 

App::import('Lib', [
  'nutch/nutch_utils',
  'nutch/job_info',
  'nutch/nutch_config',
  'nutch/nutch_client',
  'nutch/remote_cmd_executor']
);

use \Nutch\JobState;
use \Nutch\JobType;

class NutchJobManagerComponent extends Object {

  public static $JOB_INTERVAL = 15; // 15s

  private $controller;
  private $remoteCmdExecutor;

  public function startup(&$controller) {
    $this->controller = &$controller;

    $this->_loadNutchJob();

    $this->remoteCmdExecutor = new \Nutch\RemoteCmdExecutor();
  }

  public function createNutchConfig($crawl, $configId = null, $priority = "minor") {
    if(!$this->_validateCrawl($crawl)) {
      return ['configId' => null, 'state' => 'BAD_CRAWL'];
    }

    // use specified config id
    if (!empty($configId)) {
    	$crawl['Crawl']['configId'] = $configId;
    	$this->log('User defined configId '.$configId, 'info');
    }

    $configId = $crawl['Crawl']['configId'];

    // do not use reserved config id
    if($configId == 'default') {
    	return ['configId' => null, 'state' => 'RESERVED'];
    }

    // create one if configId not provided
    $crawl_id = $crawl['Crawl']['id'];
    if (empty($configId)) {
    	$user_id = $crawl['Crawl']['user_id'];
    	$configId = $this->generateConfigId($user_id, $crawl_id);
    }

    // create nutch config in nutch server
    $configId = $this->remoteCmdExecutor->createNutchConfig($crawl, $priority);
    // currently, handles only DUPLICATE exception
    if (empty($configId)) {
    	return ['configId' => $configId, 'state' => 'DUPLICATE'];
    }

    // save config id for further usage
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
      return;
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

  public function inject($crawl) {
    if(!$this->_validateCrawl($crawl, " line #".__LINE__)) {
      return;
    }

    if (!empty($crawl['Crawl']['batchId'])) {
      $this->log("Failed to inect, batchId is not empty");
      return;
    }

    if (empty($crawl['Crawl']['seedDirectory'])) {
      $this->log("Failed to inect, seed directory is empty");
      return;
    }

    return $this->createNutchJob($crawl, JobType::INJECT);
  }

  public function runParseChecker($crawl) {
    if(!$this->_validateCrawl($crawl, " line #".__LINE__)) {
      return;
    }

    if (empty($crawl['Crawl']['test_url'])) {
      $this->log("Failed to run parse checker, invalid test url");
      return;
    }

    $jobType = JobType::PARSECHECKER;
    $jobId = $this->createNutchJob($crawl, $jobType);

    $this->log("Run parse checker, job id : $jobId", 'info');

    return $jobId;
  }

  public function createNutchJob($crawl, $jobType, $batchId = null, $round = 0) {
  	if (!$this->_validateCrawl($crawl, " line #".__LINE__)) {
  		return;
  	}

  	$user_id = $crawl['Crawl']['user_id'];
  	$crawl_id = $crawl['Crawl']['id'];
  	$configId = $crawl['Crawl']['configId'];

  	// Submit the Job
  	$crawl['Crawl']['batchId'] = $batchId;
  	$rawMsg = $this->remoteCmdExecutor->executeRemoteJob($crawl, $jobType);
  	$jobId = $rawMsg;

  	if (empty($jobId) || striContains($jobId, 'exception')) {
  		$this->log("Failed to create Nutch Job, message : ".$rawMsg);
  		return $jobId;
  	}

  	// Record the submission result
  	$data = [
  			'round' => $round,
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
  	$this->log("Created new NutchJob #$nutch_job_id, #$crawl_id, $jobId", 'debug');

  	return $jobId;
  }

	public function generateConfigId($user_id, $crawl_id) {
		$configId = $user_id.'-'.$crawl_id.'-'.date('md-His').'-'.rand(0, 100 * 100);
	}

  /**
   * Schedule crawl jobs, for each page view, we select one or more pending
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
   *    "UPDATEDB" => "GENERATE"
   *  );
   * 
   * */
  public function scheduleNutchJobs() {
    if (!$this->_check_timeout("crawl_jobs_scheduler", 5)) {
      return;
    }

    $limit = 5;

    // Explicitly disable in-memory query caching
    $this->_loadNutchJob();
    $cacheQueries = $this->NutchJob->cacheQueries;
    $this->NutchJob->cacheQueries = false;

    $this->NutchJob->contain(['Crawl' => 'CrawlFilter']);
    $nutchJobs = $this->NutchJob->find('all', [
    		'fields' => ['id', 'round', 'jobId', 'batchId', 'state', 'type', 'crawl_id', 'user_id'],
    		'conditions' => [
						"NutchJob.state NOT IN('STOPPED', 'COMPLETED', 'FAILED_COMPLETED')",
    		],
    		'limit' => $limit,
    		'order' => 'NutchJob.id DESC'
    ]);

    $count = count($nutchJobs);
    if ($count > 0) {
      $this->log("Schedule $count nutch jobs", 'info');
    }

    $min = date('Hi');
    foreach ($nutchJobs as $nutchJob) {
    	$id = $nutchJob['NutchJob']['id'];
    	$crawl_id = $nutchJob['NutchJob']['crawl_id'];

//     	$this->log("", 'debug');
//     	$this->log("$crawl_id-$id------------------------", 'debug');

      $lockId = $crawl_id.'_'.$min;
      $fp = $this->_get_lock_fp($lockId);
      if ($this->_try_lock($fp, $lockId)) {
      	$this->_doScheduleJob($nutchJob);
      }

      $this->_try_unlock($fp, $lockId);
      fclose($fp);
    } // foreach

    // Reset cacheQueries
    $this->NutchJob->cacheQueries = $cacheQueries;
  }

  private function _doScheduleJob($nutchJob) {
  	$job_id = $nutchJob['NutchJob']['id'];
  	$crawl_id = $nutchJob['NutchJob']['crawl_id'];
  	$type = $nutchJob['NutchJob']['type'];
  	$state = $nutchJob['NutchJob']['state'];
  	$round = $nutchJob['NutchJob']['round'];

  	$fetchedPages = $nutchJob['Crawl']['fetched_pages'];
  	$crawlState = $nutchJob['Crawl']['state'];
  	$maxRound = $nutchJob['Crawl']['rounds'];
  	$maxPages = $nutchJob['Crawl']['limit'];

  	// Adjust data structure for consistency
  	$nutchJob['CrawlFilter'] = $nutchJob['Crawl']['CrawlFilter'];

  	global $jobChangeMap;
  	$circular = in_array($type, array_values($jobChangeMap));
  	// TODO : use enum
  	$schedulable = $state == JobState::FINISHED || $state == JobState::NOT_FOUND;
  	$schedulable = $schedulable && ($crawlState == 'RUNNING');
  	if ($circular) {
  		// Must not update job info while the job is under scheduling
  		if ($schedulable) {
  			$this->_scheduleNextJob($nutchJob);
  		}

  		// When the current job is finished, no need to query it's information
  		if (!$schedulable && $crawlState != 'FINISHED') {
  			$this->_updateJobInfo($nutchJob);
  		}

  		// Complete all jobs belongs to this crawl
  		if ($round > $maxRound) {
  			$this->_completeAllJobs($id, $crawl_id);
  			$this->log("All rounds done. Crawl #$crawl_id", 'info');
  		}

  		if ($fetchedPages > $maxPages) {
  			$this->_completeAllJobs($id, $crawl_id);
  			$this->log("All pages done. Crawl #$crawl_id", 'info');
  		}
  	}

  	if (!$circular) {
  		$this->_updateJobInfo($nutchJob);
  		$this->_updateCompletedNonCircularJobs($job_id, $crawl_id);
  	}

  	// handle failed jobs
  	if ($state == JobState::FAILED) {
  		$this->_handleFailedJob($nutchJob);
  	}
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

  		$this->log("Schedule job for crawl #$crawl_id, $currentJobType -> $nextJobType", 'debug');

  		// Update finished round
  		$this->NutchJob->Crawl->id = $crawl_id;
  		if (!$this->NutchJob->Crawl->saveField('finished_rounds', $round)) {
  			$this->log("Failed to save finished_rounds for crawl #".$crawl_id);
  		}

  		// The next round
  		// Generate batchId for the next job
  		if ($nextJobType == \Nutch\JobType::GENERATE) {
  			$batchId = '-'.$round.'-'.$user_id.'-'.$crawl_id.'-'.date('Ymd-His');
  		  $round += 1;
  		}

  		// Create nutch job
  		$crawl = $nutchJob;
  		$crawl['CrawlFilter'] = $crawl['Crawl']['CrawlFilter'];
  		$this->createNutchJob($crawl, $nextJobType, $batchId, $round);

  		// Set completed job status to be COMPLETED
			$this->_updateCompletedCircularJobs($job_id, $crawl_id);
  	} // if
  }

  private function _handleFailedJob($nutchJob) {
  	$this->NutchJob->id = $nutchJob['NutchJob']['id'];

  	if (!$this->NutchJob->saveField('state', JobState::FAILED_COMPLETED)) {
  		$this->log("Failed to update nutch job  #$id");
  	}
  }

  private function _updateCompletedCircularJobs($job_id, $crawl_id) {
  	// Once we can not find the job in Nutch Server, it's completed
  	$db =& ConnectionManager::getDataSource('default');
  	$sql = "UPDATE `nutch_jobs` SET `state`='COMPLETED'"
  			." WHERE `crawl_id`=$crawl_id"
  			." AND `id` <= $job_id"
   			." AND `type` IN ('INJECT', 'GENERATE', 'FETCH', 'PARSE', 'UPDATEDB')"
  			." AND (`state`='NOT_FOUND' OR `state`='FINISHED');";
  	// $this->log($sql, 'info');
  	$db->execute($sql);
  }

  private function _updateCompletedNonCircularJobs($job_id, $crawl_id) {
  	// Once we can not find the job in Nutch Server, it's completed
  	$db =& ConnectionManager::getDataSource('default');
  	$sql = "UPDATE `nutch_jobs` SET `state`='COMPLETED'"
  			." WHERE `crawl_id`=$crawl_id"
  			." AND `id` <= $job_id"
  			." AND `type` NOT IN ('INJECT', 'GENERATE', 'FETCH', 'PARSE', 'UPDATEDB')"
  			." AND (`state`='NOT_FOUND' OR `state`='FINISHED');";
  	// $this->log($sql, 'info');
  	$db->execute($sql);
  }

  private function _completeAllJobs($job_id, $crawl_id) {
  	// Once we can not find the job in Nutch Server, it's completed
  	$db =& ConnectionManager::getDataSource('default');
  	$sql = "UPDATE `nutch_jobs` SET `state`='COMPLETED'"
  			." WHERE `crawl_id`=$crawl_id"
  			." AND `type` IN ('INJECT', 'GENERATE', 'FETCH', 'PARSE', 'UPDATEDB')"
  			." AND `state` NOT IN ('FAILED_COMPLETE', 'COMPLETE');";
  	// $this->log($sql, 'info');
  	$db->execute($sql);

  	$this->log("All jobs are completed for crawl $$crawl_id", 'info');
  }

  /**
   * update job state
   * TODO : move to cron job
   * */
  private function _updateJobInfo($nutchJob, $force = false) {
  	if (!$this->_validateNutchJob($nutchJob, " line #".__LINE__)) {
  		return;
  	}

  	$job_id = $nutchJob['NutchJob']['id'];
  	$jobId = $nutchJob['NutchJob']['jobId'];
  	$state = $nutchJob['NutchJob']['state'];

    // $this->log('-----------update job info------------', 'debug');

    // TODO : use status enum?
    if (!$force) {
    	$COMPLETED = JobState::COMPLETED;
    	$FAILED_COMPLETED = JobState::FAILED_COMPLETED;

	    if ($state == $COMPLETED || $state == $FAILED_COMPLETED) {
	    	$this->log("Ignore state COMPLETED and FAILED_COMPLETED");
	    	return;
	    }
    }

    // update job status
    $client = new \Nutch\NutchClient();
    $rawMsg = $client->getJobInfo($jobId);

    if (empty($rawMsg) || striContains($rawMsg, '{exception')) {
      $this->log("Failed to get JobInfo".$rawMsg);
      return ['rawMsg' => $rawMsg, 'job' => null];
    }

    $jobInfo = json_decode($rawMsg, true);
    $data = [
    		'id' => $job_id,
        'state' => $jobInfo['state'],
        'args' => json_encode($jobInfo['args'], JSON_PRETTY_PRINT),
        'msg' => $jobInfo['msg'],
        'raw_msg' => $rawMsg,
    		'fetch_count' => $this->_getFetchCount($jobInfo)
    ];

    if (!$this->NutchJob->save($data)) {
      $this->log("Failed to update nutch job  #$id");
    }

    return ['rawMsg' => $rawMsg, 'job' => $jobInfo];
  }

  /**
   * @param $count Base count to accumulate
   * @param $jobInfo 
   * */
  private function _getFetchCount($jobInfo) {
  	if ($jobInfo['type'] != JobType::FETCH) {
  		return 0;
  	}

  	if (empty($jobInfo['result']['jobs'])) {
  		// $this->log(json_encode($jobInfo), 'debug');
  		return 0;
  	}

  	$count = 0;
  	foreach ($jobInfo['result']['jobs'] as $k => $job) {
  		$count += $job['counters']['FetcherStatus']['FetchedPages'];
  	}

  	$this->log("fetch count : $count", 'debug');

  	return $count;
  }

  // TODO : This is a very simple inter process timer, find better solution!
  private function _check_timeout($timerId, $timeout) {
    $lockFile = LOCK_DIR . 'timer-' . $timerId;
    if(file_exists($lockFile)) {

//      $this->log("time : ".time()." filetime : ".filemtime($lockFile), "info");

      // lock time out
      if (time() - filemtime($lockFile) > $timeout) {
        touch($lockFile);

        // $this->log("Timer file timed out", "info");

        return true;
      }

//      $this->log("Lock $id failed", "info");

      return false;
    }

    $fp = fopen($lockFile, 'w');
    fwrite($fp, $timerId);

//    $this->log("Lock $id OK", "info");

    return true;
  }

  private function _get_lock_fp($lockId) {
  	$lockFile = LOCK_DIR . 'crawl_' . $lockId;

  	// $this->log("Lock file $lockId", 'debug');

  	$fp = fopen($lockFile, 'w');

  	return $fp;
  }

  private function _try_lock($fp, $lockId) {
    /* Activate the LOCK_NB option on an LOCK_EX operation */
    // No blocking, return immediately if the lock is not available
    if(!flock($fp, LOCK_EX | LOCK_NB)) {
      $this->log("Lock $lockId failed", "info");
      return false;
    }

    // $this->log("Lock $lockId OK", "debug");

    return true;
  }

  private function _try_unlock($fp, $lockId) {
    // release the lock
    if (!flock($fp, LOCK_UN)) {
      $this->log("Unlock $lockId failed", "info");

      return false;
    }

    // $this->log("Unlock $lockId OK", "debug");

    return true;
  }

  private function _loadNutchJob() {
  	$this->controller->loadModel('NutchJob');
  	$this->NutchJob = &$this->controller->NutchJob;
  }

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
