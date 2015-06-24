<?php 

App::import('Lib', array(
  'scent/scent_config', 
  'scent/scent_client', 
  'scent/remote_cmd_executor')
);

use \Scent\JobType;

class ScentJobManagerComponent extends Object {

  private $controller;
  private $currentUser;
  private $remoteCmdExecutor;
  private $scentClient;

  public function startup(&$controller) {
    $this->controller = &$controller;
    $this->controller->loadModel('PageEntity');
    $this->controller->loadModel('ScentJob');

    $this->currentUser = $this->controller->currentUser;
    $this->remoteCmdExecutor = new \Scent\RemoteCmdExecutor();
    $this->scentClient = new \Scent\ScentClient();
  }

  public function createScentConfig($pageEntity) {
    $this->_validate($pageEntity);

    $pageEntityId = $pageEntity['PageEntity']['id'];
    if (empty($pageEntityId)) {
      $this->log("Invalid PageEntity");

      return null;
    }

    $configId = $this->remoteCmdExecutor->createScentConfig($pageEntity);

    if (empty($configId) || stripos($configId, "exception") !== false) {
      $this->log("Failed to create scent config, msg : $configId");

      return $configId;
    }

    $data = array('id' => $pageEntityId, 'configId' => $configId);
    if (!$this->controller->PageEntity->save($data)) {
      $this->log("Failed to update PageEntity config, msg : $configId");
    }

    return $configId;
  }

  public function ruledExtract($pageEntity, $limit = 1000) {
    $this->_validate($pageEntity);

    $jobType = JobType::RULEDEXTRACT;

    $pageEntity['PageEntity']['limit'] = $limit;
    $jobId = $this->remoteCmdExecutor->executeRemoteJob($pageEntity, $jobType);
    if ($jobId === false) {
      $this->log("Failed to execute job : $jobType");
      return false;
    }

    $p = $pageEntity['PageEntity'];
    $data = array('ScentJob' => array(
        'crawlId' => $p['crawlId'],
        'configId' => $p['configId'] ? $p['configId'] : 'default',
        'jobId' => $jobId,
        'type' => $jobType,
        'page_entity_id' => $p['id'],
        'user_id' => $this->currentUser['id']
    ));

    if (!$this->controller->ScentJob->save($data)) {
      $this->log("Failed to save ScentJob : $jobId");
    }

    return $jobId;
  }

  public function autoExtract($pageEntity, $domain = 'product', $limit = 1000, $builder = 'ProductHTMLBuilder') {
    $this->_validate($pageEntity);

    $jobType = JobType::AUTOEXTRACT;

    $pageEntity['PageEntity']['domain'] = $domain;
    $pageEntity['PageEntity']['limit'] = $limit;
    $pageEntity['PageEntity']['builder'] = $builder;

    $jobId = $this->remoteCmdExecutor->executeRemoteJob($pageEntity, $jobType);
    if ($jobId === false) {
      $this->log("Failed to execute job : $jobType");
      return false;
    }

    $this->_saveScentJob($jobId, $jobType, $pageEntity);

    return $jobId;
  }

  public function getStoragePageEntities($tenantId, 
    $regex = '.+', $startKey = null, $endKey = null, $fields = null, $start, $limit = 100) {
    $args = [
        'table' => 'pageentity',
        'tenantId' => intval($tenantId),
        'regex' => $regex,
        'startKey' => $startKey,
        'endKey' => $endKey,
        'start' => intval($start),
    		'limit' => intval($limit),
        'fields' => $fields
    ];
    $args = json_encode($args);

    $cacheFile = md5(__FUNCTION__.'-'.$args);
    $pageEntities = Cache::read($cacheFile, 'minute');
    if (true || $pageEntities == null) {
      $pageEntities = $this->scentClient->query($args);
      Cache::write($cacheFile, $pageEntities, 'minute');
    }

    if (!startsWith($pageEntities, "{\"exception\":")) {
    	$pageEntities = qi_json_decode($pageEntities, true, 10);
    }
    else {
    	$this->log($pageEntities);
    }

    if (empty($pageEntities)) {
    	$pageEntities = [];
    }

    return $pageEntities;
  }

  public function getStoragePageEntity($tenantId, $url) {
    $args = [
        'table' => 'pageentity',
        'tenantId' => intval($tenantId),
        'startKey' => $url,
        'endKey' => $url,
        'regex' => ".+",
        'start' => 0,
        'limit' => 2,
        'fields' => null
    ];
    $args = json_encode($args);

    $cacheFile = md5(__FUNCTION__.'-'.$args);
    $pageEntities = Cache::read($cacheFile, 'minute');
    if ($pageEntities == null) {
      $pageEntities = $this->scentClient->query($args);      
      Cache::write($cacheFile, $pageEntities, 'minute');
    }
    $pageEntities = qi_json_decode($pageEntities, true, 10);

    $pageEntity = [];
    foreach ($pageEntities as $k => $v) {
    	$pageEntity = $v;
    	break;
    }

    return $pageEntity;
  }

  public function segment($pageEntity, $limit = 1000) {
    $this->_validate($pageEntity);

    $jobType = JobType::SEGMENT;

    $pageEntity['PageEntity']['limit'] = $limit;
    $jobId = $this->remoteCmdExecutor->executeRemoteJob($pageEntity, $jobType);
    if ($jobId === false) {
      $this->log("Failed to execute job : $jobType");
      return false;
    }

    $this->_saveScentJob($jobId, $jobType, $pageEntity);

    return $jobId;
  }

  private function _saveScentJob($jobId, $jobType, $pageEntity) {
    $p = $pageEntity['PageEntity'];
    $data = array('ScentJob' => array(
        'crawlId' => $p['crawlId'],
        'configId' => $p['configId'] ? $p['configId'] : 'default',
        'jobId' => $jobId,
        'type' => $jobType,
        'page_entity_id' => $p['id'],
        'user_id' => $this->currentUser['id']
    ));

    if (!$this->controller->ScentJob->save($data)) {
      $this->log("Failed to save ScentJob : $jobId");
    }
  }

  private function _validate($pageEntity) {
    assert(isset($pageEntity['PageEntity']));
    assert(isset($pageEntity['PageEntityField']));
  }
}
