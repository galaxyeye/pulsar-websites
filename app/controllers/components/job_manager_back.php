<?php 

App::import('Lib', array(
	'nutch/nutch_utils',
	'nutch/nutch_config', 
	'nutch/nutch_client', 
	'nutch/remote_cmd_executor')
);

class JobManagerComponent extends Object {

	public static $JOB_INTERVAL = 5; // 5s

	private $controller;
	private $currentUser;
	private $remoteCmdExecutor;

	public function startup(&$controller) {
		$this->controller = &$controller;
		$this->Crawl = $this->controller->loadModel('Crawl');
		$this->NutchJob = $this->controller->loadModel('NutchJob');
		$this->currentUser = $this->controller->currentUser;
		$this->remoteCmdExecutor = new RemoteCmdExecutor();
	}

  public function createNutchConfig($crawl) {
		assert(isset($crawl['Crawl']));
		assert(isset($crawl['CrawlFilter']));

    $configId = $this->remoteCmdExecutor->createNutchConfig($crawl);

    if (!empty($configId)) {
    	if (stripos($configId, "exception") === false) {
    		$sql = "UPDATE `crawls` SET `configId`='$configId' WHERE `id`={$crawl['Crawl']['id']}";

    		$db =& ConnectionManager::getDataSource('default');
    		$db->query($sql);
    	}
    	else {
    		$this->log("Failed to create nutch config, msg : $configId");

    		$configId = null;
    	}
    }

    return $configId;
  }

  public function createSeed($crawl) {
  	$this->_validate($crawl);

    $seedDirectory = $this->remoteCmdExecutor->createSeed($crawl);

    if (strpos($seedDirectory, 'exception') !== false) {
      $this->log("Seed directory : $seedDirectory", 'info');
      $seedDirectory = false;
    }

    if (!empty($seedDirectory)) {
      $sql = "UPDATE `crawls` SET `seedDirectory`='$seedDirectory' WHERE `id`={$crawl['Crawl']['id']}";

      $db =& ConnectionManager::getDataSource('default');
      $db->query($sql);
    }

    return $seedDirectory;
  }

  public function inject($crawl) {
  	$this->_validate($crawl);

    if ($crawl['Crawl']['job_type'] !== 'NONE') {
      $this->log("Failed to inect, job type is not NONE");

      return false;
    }

    if (empty($crawl['Crawl']['seedDirectory'])) {
      $this->log("Failed to inect, seed directory is empty");
      return false;
    }

    $jobType = RemoteCmdBuilder::$JobType['INJECT'];
    $jobId = $this->remoteCmdExecutor->executeRemoteJob($crawl, $jobType);
    if ($jobId !== false) {
    	$this->_createNutchJob($jobId, $jobType, 'CREATED', $crawl['Crawl']['id']);
    }

    $this->log("inject, job id : $jobId", 'info');

    return $jobId;
  }

  public function runParseChecker($crawl) {
  	$this->_validate($crawl);

  	$jobType = RemoteCmdBuilder::$JobType['PARSECHECKER'];
  	$jobId = $this->remoteCmdExecutor->executeRemoteJob($crawl, $jobType);
  	if ($jobId !== false) {
    	$this->_createNutchJob($jobId, $jobType, 'CREATED', $crawl['Crawl']['id']);
  	}

  	$this->log("parse checker, job id : $jobId, url : {$crawl['Crawl']['test_url']}", 'info');

  	return $jobId;
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
  public function scheduleCrawlJobs() {
    if (!$this->_check_timeout("crawl_jobs_scheduler", 5)) {
      return;
    }

    $limit = 100;

    $db =& ConnectionManager::getDataSource('default');

    // TODO : random select
    $sql = "SELECT * from `crawls` AS `Crawl` 
      WHERE `finished_rounds`<`rounds` AND `job_state`!='FAILED' LIMIT $limit";
    $crawls = $db->query($sql);
//     $crawls = $this->Crawl->find('all', array(
//     	'conditions' => array('')
//     	)
//     );

    foreach ($crawls as $crawl) {
      $id = $crawl['Crawl']['id'];

      // someone else is monitoring the crawl
      if (!$this->_try_lock($id)) {
        continue;
      }

      $sql = "SELECT * from `nutch_jobs` AS `NutchJob`
      WHERE `crawl_id`=$id AND `state`!='FINISHED' LIMIT $limit";
      $nutchJobs = $db->query($sql);

      if ($crawl['Crawl']['job_state'] == 'FINISHED') {
        $this->_scheduleNextJob($crawl);
      }
      else {
        $this->_updateJobInfo($crawl);
      }

      // release the file lock
      $this->_unlock($id);
    } // foreach
  } // _scheduleCrawlJobs

  private function _createNutchJob($jobId, $jobType, $state, $crawl_id) {
  	$nutchJob = array(
  			'jobId' => $jobId,
  			'type' => $jobType,
  			'state' => 'CREATED',
  			'crawl_id' => $crawl['Crawl']['id']
  	);
  	$this->_saveOrUpdate($nutchJob);
  }

  private function _createNutchJob($id, $jobType, $state, $crawl_id) {
  	$nutchJob = array(
  			'id' => $id,
  			'type' => $jobType,
  			'state' => 'CREATED',
  			'crawl_id' => $crawl['Crawl']['id']
  	);
  	$this->_saveOrUpdate($nutchJob);
  }

  private function _saveOrUpdate($nutchJob) {
  	$this->controller->loadModel('NutchJob');
  	if (empty($nutchJob['NutchJob']['id'])) {
  		$this->NutchJob->create();
  	}

  	if (isset($nutchJob['NutchJob'])) {
  		$nutchJob = $nutchJob['NutchJob'];
  	}

  	$nutchJob['user_id'] = $this->currentUser['id'];
  	$this->NutchJob->save($nutchJob);
  }

  /**
   * update job state
   * TODO : move to cron job
   * */
  private function _updateJobInfo($crawl) {
    if (empty($crawl['Crawl']['jobId'])) {
      return;
    }

    $db =& ConnectionManager::getDataSource('default');

    // update job status
    $client = new NutchClient();
    $output = $client->getJobInfo($crawl['Crawl']['jobId']);

    $data = json_decode($output, true);
    if (!isset($data['exception']) && isset($data['state'])) {
      $sql = "UPDATE `crawls` 
        SET `job_state`='{$data['state']}', `job_msg`='{$data['msg']}', `job_raw_msg`='$output'
        WHERE `id`={$crawl['Crawl']['id']} AND `job_type`='{$data['type']}'";
      $db->query($sql);
    }
    else {
      $sql = "UPDATE `crawls` SET `job_raw_msg`='$output' WHERE `id`={$crawl['Crawl']['id']}";
      $db->query($sql);
    }
  }

  /**
   * schedule next job inside a crawl round
   * */
  private function _scheduleNextJob($crawl) {
    if ($crawl['Crawl']['job_state'] != 'FINISHED') {
      return;
    }

    $id = $crawl['Crawl']['id'];

    $db =& ConnectionManager::getDataSource('default');

    // finish the crawl round
    if ($crawl['Crawl']['job_state'] == 'FINISHED' && $crawl['Crawl']['job_type'] == 'UPDATEDB') {
      $sql = "UPDATE `crawls` SET `finished_rounds`=`finished_rounds`+1 WHERE `id`=$id";
      $db->query($sql);

      if (1 + $crawl['Crawl']['finished_rounds'] == $crawl['Crawl']['rounds']) {
        return;
      }
    }

    global $jobChangeMap;
    // execute the next job inside a crawl round
    $currentJobType = $crawl['Crawl']['job_type'];
    if (key_exists($currentJobType, $jobChangeMap)) {
      $nextJobType = $jobChangeMap[$currentJobType];

      $sql = "UPDATE `crawls` SET `job_type`='$nextJobType', `job_state`='CREATED'";
      if ($nextJobType == 'GENERATE') {
        // generate a batchId
        $crawl['Crawl']['batchId'] = uniqid().'-'.time().'-'.$this->currentUser['id'];
        $sql .= ", `batchId`='{$crawl['Crawl']['batchId']}'";
      }
      $sql .= " WHERE `id`=$id";

      $db->query($sql);

      $this->log("$sql", "info");

      $jobId = $this->remoteCmdExecutor->executeRemoteJob($crawl, $nextJobType);

      if (!empty($jobId)) {
        $sql = "UPDATE `crawls` SET `jobId`='$jobId' WHERE `id`=$id";
        $db->query($sql);
      }
    } // if
  }

  // TODO : This is a very simple inter process timer, find better solution!
  private function _check_timeout($timerId, $timeout) {
    $lockFile = LOCK_DIR . 'timer-' . $timerId;
    if(file_exists($lockFile)) {

//      $this->log("time : ".time()." filetime : ".filemtime($lockFile), "info");

      // lock time out
      if (time() - filemtime($lockFile) > $timeout) {
        touch($lockFile);

//        $this->log("Lock $id time out", "info");

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

  // TODO : This is a very simple and slow lock, find better solution!
  private function _try_lock($id) {
    $lockFile = LOCK_DIR . $id;
    if(file_exists($lockFile)) {

//      $this->log("time : ".time()." filetime : ".filemtime($lockFile), "info");

      // lock time out
      if (time() - filemtime($lockFile) > self::$JOB_INTERVAL) {
        touch($lockFile);

//        $this->log("Lock $id time out", "info");

        return true;
      }

//      $this->log("Lock $id failed", "info");

      return false;
    }

    $fp = fopen($lockFile, 'w');
    fwrite($fp, $id);

//    $this->log("Lock $id OK", "info");

    return true;
  }

  private function _unlock($id) {
    $lockFile = LOCK_DIR . $id;
//    $this->log("Unlock $id OK", "info");

    unlink($lockFile);
  }

  private function _validate($crawl) {
  	assert(isset($crawl['Crawl']));
  	assert(isset($crawl['CrawlFilter']));
  }
}
