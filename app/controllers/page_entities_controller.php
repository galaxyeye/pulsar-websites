<?php 
class PageEntitiesController extends AppController {

  var $name = 'PageEntities';

  public $components = array('ScentJobManager');

  var $paginate = ['PageEntity' => ['limit'=> 500, 'order' => 'PageEntity.id DESC']];

  function index() {
    $this->PageEntity->recursive = 1;
    $this->set('pageEntities', $this->paginate(array('PageEntity.user_id' => $this->currentUser['id'])));
  }

  function view($id = null) {
    $this->_validateId($id);

    $this->set('pageEntity', $this->PageEntity->read(null, $id));
  }

  function viewXml($id = null) {
    $this->_validateId($id);

    $pageEntity = $this->PageEntity->read(null, $id);

    $xml = $this->_asXml($pageEntity);
    echo $xml;

    $this->autoLayout = false;
    $this->autoRender = false;
    $this->RequestHandler->respondAs('xml');
    $this->RequestHandler->renderAs($this, 'xml');
  }

  function add() {
    if (!empty($this->data)) {
      $this->data['PageEntity']['user_id'] = $this->currentUser['id'];

      $this->data = $this->_tidyFilters($this->data);
      $this->PageEntity->create();
      if ($this->PageEntity->save($this->data)) {
        $this->Session->setFlash(__('The PageEntity has been saved', true));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The PageEntity could not be saved. Please, try again.', true));
      }
    }

    if (isset($this->params['named']['crawl_id'])) {
      $crawlId = $this->params['named']['crawl_id'];
      $this->_setCrawlInfo($crawlId);
    }
    else {
      $this->_setCrawlFilterInfo();
    }
  }

  function ajax_addFields($id) {
    $this->autoRender = false;

    if (empty($id)) {
      return getResponseStatusJson(400, "Invalid id");
    }

    if (empty($this->params['data'])) {
      return getResponseStatusJson(400, "Invalid request body", $this->params);
    }

    if(!$this->checkTenantPrivilege($id)) {
      return getResponseStatusJson(401);
    }

    $data = $this->params['data'];
    $fields = qi_json_decode($data, true, 4);
    foreach ($fields as &$field) {
      $field['page_entity_id'] = $id;
      $field['user_id'] = $this->currentUser['id'];
    }

    $conditions = array('page_entity_id' => $id);
    if (!$this->PageEntity->PageEntityField->deleteAll(array('page_entity_id' => $id))) {
      return getResponseStatusJson(500, "Failed to save PageEntityField");
    }

    if(!$this->PageEntity->PageEntityField->saveAll($fields)) {
      return getResponseStatusJson(500, "Failed to save PageEntityField", $fields);
    }

    return getResponseStatusJson(200, null, $fields);
  }

  function edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid page entity', true));
      $this->redirect(array('action' => 'index'));
    }

    if (!empty($this->data)) {
      $this->_validateId($id);

      $this->data = $this->_tidyFilters($this->data);
      if ($this->PageEntity->save($this->data)) {
        $this->Session->setFlash(__('The page entity has been saved', true));
        $this->redirect(array('action' => 'view', $this->PageEntity->id));
      } else {
        $this->Session->setFlash(__('The page entity could not be saved. Please, try again.', true));
      }
    }

    if (empty($this->data)) {
      $this->_validateId($id);
      $this->data = $this->PageEntity->read(null, $id);

      // TODO : we'd really need bind page_entity to a crawl
      $this->_setCrawlFilterInfo();
    }
  }

  function delete($id = null) {
    $this->_validate($id);

    if ($this->PageEntity->delete($id)) {
      $this->Session->setFlash(__('Page entity deleted', true));
      $this->redirect(array('action'=>'index'));
    }

    $this->Session->setFlash(__('Page entity was not deleted', true));
    $this->redirect(array('action' => 'index'));
  }

  function startFeatureAnalysis() {
  	$id = $this->params['url']['id'];
  	$this->_validateId($id);
  
  	$limit = $this->params['url']['limit'];
  
  	$pageEntity = $this->PageEntity->read(null, $id);
  
  	$pageEntity['PageEntity']['domain'] = $this->_asXml($pageEntity);
  	$jobId = $this->ScentJobManager->featureAnalysis($pageEntity, $limit);
  	$message = 'FeatureAnalysis job submitted';
  	if (!$jobId) {
  		$message = 'Failed to execute job RuledExtract';
  		$this->redirect2View($id, $message);
  	}
  
  	$this->loadModel('ScentJob');
  	$this->ScentJob->recursive = -1;
  	$scentJob = $this->ScentJob->find('first', array('conditions' => array('jobId' => $jobId)));
  
  	$this->Session->setFlash($message);
  	$this->redirect(array('controller' => 'scent_jobs', 'action' => 'view', $scentJob['ScentJob']['id']));
  } // startFeatureAnalysis

  function startRuledExtract($id = null, $limit = 500) {
  	if (empty($id)) {
      $id = $this->params['url']['id'];
  	}
    $this->_validateId($id);

    if (isset($this->params['url']['limit'])) {
      $limit = intval($this->params['url']['limit']);
    }

    if ($limit > 500) {
      $limit = 500;
    }

    $pageEntity = $this->PageEntity->read(null, $id);
    if (empty($pageEntity['PageEntityField'])) {
      $this->redirect2View($id, "No Mining Rules");
    }

    $pageEntity['PageEntity']['extract_rules'] = $this->_asXml($pageEntity);
    $jobId = $this->ScentJobManager->ruledExtract($pageEntity, $limit);
    $message = 'RuledExtract job submitted';
    if (!$jobId) {
      $message = 'Failed to execute job RuledExtract';
      $this->redirect2View($id, $message);
    }

    $this->loadModel('ScentJob');
    $this->ScentJob->recursive = -1;
    $scentJob = $this->ScentJob->find('first', array('conditions' => array('jobId' => $jobId)));

    $this->Session->setFlash($message);
    $this->redirect(array('controller' => 'scent_jobs', 'action' => 'view', $scentJob['ScentJob']['id']));
  } // startRuledExtract

  function startAutoExtract() {
  	$id = $this->params['url']['id'];
  	$this->_validateId($id);

    $domain = $this->params['url']['domain'];
    $limit = $this->params['url']['limit'];
    $builder = $this->params['url']['builder'];

    $pageEntity = $this->PageEntity->read(null, $id);

    $jobId = $this->ScentJobManager->autoExtract($pageEntity, $domain, $limit, $builder);
    $message = 'AutoExtract job submitted';
    if (!$jobId) {
      $message = 'Failed to execute job AutoExtract';
      $this->redirect2View($id, $message);
    }

    $this->loadModel('ScentJob');
    $this->ScentJob->recursive = -1;
    $scentJob = $this->ScentJob->find('first', array('conditions' => array('jobId' => $jobId)));

    $this->Session->setFlash($message);
    $this->redirect(array('controller' => 'scent_jobs', 'action' => 'view', $scentJob['ScentJob']['id']));
  } // startAutoExtract

  function ajax_startRuledExtract($id = null, $limit = 500) {
    $this->autoRender = false;

    // Make it consistent with startExtraction
    if (empty($id)) {
      $id = $this->params['url']['id'];
    }

    if ($limit > 500) {
    	$limit = 500;
    }

    if (empty($id) || !is_numeric($id)) {
      return getResponseStatusJson(400);
    }

    $pageEntity = $this->PageEntity->read(null, $id);
    if (empty($pageEntity['PageEntityField'])) {
      return getResponseStatusJson(400, "Extract Rule Required");
    }

    $pageEntity['PageEntity']['extract_rules'] = $this->_asXml($pageEntity);
    $jobId = $this->ScentJobManager->ruledExtract($pageEntity, $limit);

    if (!empty($jobId)) {
      return getResponseStatusJson(200, '', $jobId);
    }
    else {
      return getResponseStatusJson(500, $jobId);
    }
  } // ajax_startRuledExtract

  function ajax_startAutoExtract($id = null, $limit = 500, $domain = 'product', $builder = 'ProductHTMLBuilder') {
    $this->autoRender = false;

    // Make it consistent with startExtract
    if (empty($id)) {
      $id = $this->params['url']['id'];
    }

    if (empty($id) || !is_numeric($id)) {
      return getResponseStatusJson(400);
    }

    $pageEntity = $this->PageEntity->read(null, $id);
    $jobId = $this->ScentJobManager->autoExtract($pageEntity, $domain, $limit, $builder);

    if (!empty($jobId)) {
      return getResponseStatusJson(200, '', $jobId);
    }
    else {
      return getResponseStatusJson(500, $jobId);
    }
  } // ajax_startAutoExtract

  function ajax_getJobInfo($id, $realTime = false) {
    $this->autoRender = false;

    if (empty($id) || !is_numeric($id)) {
      echo getResponseStatusJson(400);
      return;
    }
  
    if(!$this->checkTenantPrivilege($id)) {
      echo getResponseStatusJson(401);
      return;
    }

    $this->PageEntity->recursive = -1;
    $pageEntity = $this->PageEntity->read(null, $id);
  
    if ($realTime && !empty($pageEntity['PageEntity']['jobId'])) {
      $client = new \Scent\ScentClient();
      echo $client->getjobInfo($pageEntity['PageEntity']['jobId']);
    }
    else {
      echo $pageEntity['PageEntity']['job_raw_msg'];
    }
  }

  function admin_testScentMessage($id = null) {
    $this->autoRender = false;

    error_reporting(E_ALL);
    ini_set('display_errors','On');

    App::import('Lib', 'scent/remote_cmd_builder');
    $pageEntity = $this->PageEntity->read(null, $id);

    $cmdBuilder = new \Scent\RemoteCmdBuilder($pageEntity);

    pr("-----scent config-----");
    $scentConfig = $cmdBuilder->buildScentConfig();
    pr($scentConfig->__toString());

    pr("-----scent commands-----");
    $commands = $cmdBuilder->createCommands();
    for ($i = 0; $i < min(count($commands), 10); ++$i) {
       pr($commands[$i]->getJobConfig()->__toString());
    }
  }

  function admin_index() {
    $this->PageEntity->recursive = 0;
    $this->set('pageEntities', $this->paginate());
  }

  function admin_view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid page entity', true));
      $this->redirect(array('action' => 'index'));
    }
    $this->set('pageEntity', $this->PageEntity->read(null, $id));
  }

  function admin_add() {
    if (!empty($this->data)) {
      $this->PageEntity->create();
      if ($this->PageEntity->save($this->data)) {
        $this->Session->setFlash(__('The page entity has been saved', true));
        $this->redirect(array('action' => 'index'));
      } else {
        $this->Session->setFlash(__('The page entity could not be saved. Please, try again.', true));
      }
    }
    $pageEntities = $this->PageEntity->PageEntity->find('list');
    $this->set(compact('pageEntities'));
  }

  function admin_edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid page entity', true));
      $this->redirect(array('action' => 'index'));
    }

    if (!empty($this->data)) {
      $this->_validateId($id);

      $this->data = $this->_tidyFilters($this->data);
      if ($this->PageEntity->save($this->data)) {
        $this->Session->setFlash(__('The page entity has been saved', true));
        $this->redirect(array('action' => 'view', $this->PageEntity->id));
      } else {
        $this->Session->setFlash(__('The page entity could not be saved. Please, try again.', true));
      }
    }
  
    if (empty($this->data)) {
      $this->_validateId($id);
      $this->data = $this->PageEntity->read(null, $id);
  
      // TODO : we'd really need bind page_entity to a crawl
      $this->_setCrawlFilterInfo();
    }
  }

  function admin_delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for page entity', true));
      $this->redirect(array('action'=>'index'));
    }
    if ($this->PageEntity->delete($id)) {
      $this->Session->setFlash(__('Page entity deleted', true));
      $this->redirect(array('action'=>'index'));
    }
    $this->Session->setFlash(__('Page entity was not deleted', true));
    $this->redirect(array('action' => 'index'));
  }

  private function _setCrawlFilterInfo() {
    $this->loadModel('CrawlFilter');
    $this->CrawlFilter->recursive = -1;
    $crawlFilters = $this->CrawlFilter->find('all', array(
        'conditions' => array('user_id' => $this->currentUser['id'])
    ));

    $filters = $this->_buildFilterList($crawlFilters);
    $urlFilters = $filters['urlFilters'];
    $textFilters = $filters['textFilters'];

    $this->set(compact('urlFilters', 'textFilters'));
  }

  private function _setCrawlInfo($crawlId) {
    $this->loadModel('Crawl');
    $this->Crawl->contain(array('CrawlFilter'));
    $crawl = $this->Crawl->read(null, $crawlId);

    $filters = $this->_buildFilterList($crawl['CrawlFilter']);
    $urlFilters = $filters['urlFilters'];
    $textFilters = $filters['textFilters'];

    $this->set(compact('crawl', 'urlFilters', 'textFilters'));
  }

  private function _asXml($pageEntity) {
    $xml = new SimpleXMLElement('<extract-rules />');
    $extractRule = $xml->addChild("extract-rule");
    $extractRule->addAttribute("entityName", $pageEntity['PageEntity']['name']);
    $extractRule->addAttribute("urlRegex", $pageEntity['PageEntity']['url_filter']);
    $fields = $extractRule->addChild("fields");

    $fieldNameMap = array(
        'name' => 'name',
        'css_path' => 'cssPath',
        'extractor_class' => 'extractor',
        'text_extract_regex' => 'extract-regex',
        'text_validate_regex' => 'validate-regex',
        'sql_data_type' => 'dataType',
    );

    foreach ($pageEntity['PageEntityField'] as $f) {
      $field = $fields->addChild("field");

      foreach ($fieldNameMap as $dbName => $xmlName) {
        $field->addAttribute($xmlName, $f[$dbName]);
      }
    }

    return $xml->asXML();
  }

  function _buildFilterList($crawlFilters) {
    $urlFilters = array();
    $textFilters = array();
    foreach ($crawlFilters as $f) {
      if (isset($f['CrawlFilter'])) $f = $f['CrawlFilter'];

      $splitted = \Nutch\splitUrlFilter($f['url_filter']);
      $urlFilters = array_merge($urlFilters, $splitted);
      array_push($textFilters, $f['text_filter']);
    }

    $urlFilters = array_filter($urlFilters);
    $textFilters = array_filter($textFilters);
    $urlFilters = array_unique($urlFilters);
    $textFilters = array_unique($textFilters);

    $keys = $urlFilters;
    foreach ($keys as &$key) {
      $key = symmetric_encode($key);
    }
    foreach ($urlFilters as &$urlFilter) {
      $urlFilter = str_replace("\n", "\n", $urlFilter);
      $urlFilter = trim($urlFilter, "\n");
    }
    $urlFilters = array_combine($keys, $urlFilters);
    $urlFilters = array("" => "==========") + $urlFilters;

    $keys = $textFilters;
    foreach ($keys as &$key) {
      $key = symmetric_encode($key);
    }
    foreach ($textFilters as &$textFilter) {
      $textFilter = str_replace("\n", "\n", $textFilter);
      $textFilter = trim($textFilter, "\n");
    }
    $textFilters = array_combine($keys, $textFilters);
    $textFilters = array("" => "==========") + $textFilters;

    return array('urlFilters' => $urlFilters, 'textFilters' => $textFilters);
  }

  function _tidyFilters($pageEntity) {
    if (isset($pageEntity['PageEntity'])) {
      $pageEntity = $pageEntity['PageEntity'];
    }

    $urlFilter = $pageEntity['url_filter'];
    $textFilter = $pageEntity['text_filter'];

    if (stripos($urlFilter, 'http') === false) {
      $pageEntity['url_filter'] = symmetric_decode($urlFilter);
    }

    // TODO : may not correct sometimes
    if (stripos($textFilter, 'contains') === false) {
      $pageEntity['text_filter'] = symmetric_decode($textFilter);
    }

    foreach (array('url_filter', 'text_filter') as $field) {
      $isset = isset($crawlFilter[$field]);
      if ($isset && false !== stripos($crawlFilter[$field], "QiwurInputTemplate")) {
        unset($crawlFilter[$field]);
      }
    }

    return array('PageEntity' => $pageEntity);
  }
}
