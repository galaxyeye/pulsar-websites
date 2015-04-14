<?php 

App::import('Lib', array('qp'));
App::import('Lib', array('scent/scent_client', 'scent/db_filter'));

class StoragePageEntitiesController extends AppController {

  var $name = 'StoragePageEntities';
  var $cacheDir = "/tmp/qiwur-data-ui";
  var $helpers = array('Cache');
  var $scentClient;

  function beforeFilter() {
    $this->scentClient = new \Scent\ScentClient();
  }

  function index() {
    $regex = '.+';
    $startKey = null;
    $endKey = null;
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
    if (!empty($this->params['url']['limit'])) {
      $limit = intval($this->params['url']['limit']);
    }

    if ($startKey == null) {
      $startKey = \Nutch\regex2startKey($regex);
    }

    $storagePageEntities = $this->_getStoragePageEntities($regex, $startKey, $endKey, ["title", "baseUri"], $limit);
    if (!is_array($storagePageEntities)) {
      $storagePageEntities = [];
    }

    $this->set(compact('storagePageEntities', 'startKey', 'endKey', 'limit'));
  }

  function view($encodedUrl = null, $page_entity_id = null) {
    if ($encodedUrl == null) {
      $this->redirect2Index("Encoded url is required");
    }

    $url = symmetric_decode($encodedUrl);
    $storagePageEntity = $this->_getStoragePageEntity($url);

    $options = array();
    if (isset($this->params['named']['options'])) {
      $options = explode("+", $this->params['named']['options']);
    }
    array_push($options, 'strip');

    $content = $this->_stripHTML($url, $storagePageEntity['entityAttributes'], $options);
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

  private function _getStoragePageEntities($regex = '.+', $startKey = null, $endKey = null, $fields = null, $limit = 100) {
    $args = [
      '-table' => 'pageentity',
      '-startKey' => $startKey,
      '-endKey' => $endKey,
      '-regex' => $regex,
      '-limit' => $limit,
      '-fields' => $fields
    ];
    $args = json_encode($args);

    $pageEntities = Cache::read(json_encode($args), 'minute');
    if ($pageEntities == null) {
      $pageEntities = $this->scentClient->query($args);
      Cache::write($args, $pageEntities, 'minute');
    }
    $pageEntities = json_decode($pageEntities, true, 10);
    foreach ($pageEntities as $k => $v) {
      if (is_string($v)) {
        $pageEntities[$k] = json_decode($v, true, 10);
      }
    }

    return $pageEntities;
  }

  private function _getStoragePageEntity($url) {
    $args = [
      '-table' => 'pageentity',
      '-startKey' => $url,
      '-endKey' => $url,
      '-regex' => ".+",
      '-limit' => 10,
      '-fields' => null
    ];
    $args = json_encode($args);

    $pageEntities = Cache::read(json_encode($args), 'minute');
    if (true && $pageEntities == null) {
      $pageEntities = $this->scentClient->query($args);
      Cache::write($args, $pageEntities, 'minute');
    }
    $pageEntities = json_decode($pageEntities, true, 10);

    if (count($pageEntities) > 0) {
      $pageEntities = array_values($pageEntities);
      return $pageEntities[0];
    }
  }

  private function _stripHTML($basUri, $content, $options) {
    $MIN_CONTENT_LENGTH = 100;
    if (strlen($content) < $MIN_CONTENT_LENGTH) {
      return null;
    }

    $dom = htmlqp($content, null, ['convert_to_encoding' => 'utf-8']);
  
    App::import('Lib', array('html_utils'));
    HtmlUtils::qpMakeLinksAbsolute($dom, $basUri);
    // HtmlUtils::qpRemoveAllInlineStyle($dom);

    $dom->find('*')->each(function($index, $item) {
      $item->removeAttribute('style');
    });
  
    // TODO : sniff encoding
    $title = $dom->find('title')->text();
  
    $removeTags = [
        'title', 'base', 'script', 'meta', 'iframe',
        'link[rel=icon]', 'link[rel="shortcut icon"]'
    ];
    foreach ($removeTags as $removal) {
      $dom->find($removal)->remove();
    }
  
    if (in_array('simpleCss', $options)) {
      foreach (['style', 'link', 'head'] as $removal) {
        $dom->find($removal)->remove();
      }
    }
    // Add qiwur specified information
    $dom->find('html')->attr('id', 'qiwurHtml');
    $dom->find('body')->attr('id', 'qiwurBody');
    $dom->find('img')->html("")->removeAttr("src");
    // A fix for older QiwurScrapingMetaInformation holder protocol
    // we can not make this information at the first div, instead of which
    // we move the information to a created input element at to bottom of
    // body element
    $dom->find('#QiwurScrapingMetaInformation')->removeAttr('id');
    $content = $dom->html();

    // Strip to show the page inside our own layout
    // TODO : Can we do these replace using $dom ?
    $content = preg_replace("/<html|<body|<head/", "<div", $content);
    $content = preg_replace("/DOCTYPE|dtd|xml/i", "", $content);

    // Fix satellite version 0.1 bug
    $content = preg_replace("/#QiwurScrapingMetaInformation &gt;/", "body &gt;", $content);
    $content = preg_replace("/#qiwurBody &gt;/", "body &gt;", $content);

    return $content;
  }
}
