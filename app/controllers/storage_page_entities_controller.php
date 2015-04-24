<?php 

App::import('Lib', array('scent/scent_client', 'scent/db_filter'));

class StoragePageEntitiesController extends AppController {

  var $name = 'StoragePageEntities';
  var $helpers = array('Cache');
  var $components = array('ScentJobManager');

  function beforeFilter() {
  	parent::beforeFilter();
  }

  function index() {
  	$tenantId = $this->currentUser['id'];
    $regex = '.+';
    $startKey = null;
    $endKey = null;
    $page = 1;
    $start = 0;
    $limit = 100;

    if (!empty($this->params['url']['regex'])) {
      $regex = trim($this->params['url']['regex']);
    }
    if (!empty($this->params['url']['startKey'])) {
      $startKey = trim($this->params['url']['startKey']);
    }
    if (!empty($this->params['url']['endKey'])) {
      $endKey = trim($this->params['url']['endKey']);
    }
    if (!empty($this->params['url']['page'])) {
      $page = intval($this->params['url']['page']);
      $start = ($page - 1) * $limit;
    }
    if (!empty($this->params['url']['limit'])) {
      $limit = intval($this->params['url']['limit']);
    }

    if ($startKey == null) {
    	$startKey = \Nutch\regex2startKey($regex);
    	if ($endKey == null && $startKey != null) {
    		$endKey = $startKey . "\uFFFF";
    	}
    }

    if ($endKey == null) {
    	$endKey = \Nutch\regex2endKey($regex);
    }

    $storagePageEntities = $this->ScentJobManager->getStoragePageEntities($tenantId,
    		$regex, $startKey, $endKey, ["title", "baseUri"], $start, $limit);
    if (!is_array($storagePageEntities)) {
      $storagePageEntities = [];
    }

    $this->set(compact('storagePageEntities', 'startKey', 'page', 'limit'));
  }

  function view($encodedUrl = null, $page_entity_id = null) {
  	$tenantId = $this->currentUser['id'];

    if ($encodedUrl == null) {
      $this->redirect2Index("Encoded url is required");
    }

    $url = symmetric_decode($encodedUrl);
    $storagePageEntity = $this->ScentJobManager->getStoragePageEntity($tenantId, $url);

    $options = array();
    if (isset($this->params['named']['options'])) {
      $options = explode("+", $this->params['named']['options']);
    }
    array_push($options, 'strip');

    App::import('Lib', array('html_utils'));
    $result = HtmlUtils::stripHTML($storagePageEntity['entityAttributes'], $url, $options);
    $content = $result['content'];
    if (empty($content)) {
      $this->redirect2Index("No content available, url : ".$url);
    }

    $pageEntity = [
    		'PageEntity' => [
    			'id' => 0,
    			'title' => $storagePageEntity['title'],
    			'url' => $storagePageEntity['baseUri'],
          'content' => $content
    		],
    		'PageEntityField' => []
    ];

    $this->set(compact('pageEntity', 'url', 'options'));
  }
}
