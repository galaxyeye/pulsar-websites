<?php 

App::import('Lib', array('filter_utils', 'nutch/nutch_client'));

define("GLOBAL_DATA_DIR", "/tmp/warps");
define("ROOT_DATA_DIR", GLOBAL_DATA_DIR."/satellite");
define("LOCAL_STORAGE_MODE", true);

class StorageWebPagesController extends AppController
{

  var $name = 'StorageWebPages';
  var $nutchClient;
  var $webpagesDir = ROOT_DATA_DIR . "/web/mia.com/06.16/detail/";
  var $localMode = LOCAL_STORAGE_MODE;

  function beforeFilter()
  {
    parent::beforeFilter();

    $this->nutchClient = new \Nutch\NutchClient();

    $this->Auth->allow('anonymous_index', 'anonymous_view');
  }

  function anonymous_index()
  {
    $this->index();
  }

  function anonymous_view($encodedUrl)
  {
    $this->view($encodedUrl);
  }

  /**
   * TODO : SQL-like LIMIT semantic
   * */
  function index()
  {
    $regex = ".+";
    $startKey = null;
    $endKey = null;
    $page = 1;
    $start = 0;
    $limit = 100;
    $page_entity_id = 0;

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
    if (!empty($this->params['url']['page_entity_id'])) {
      $page_entity_id = intval($this->params['url']['page_entity_id']);
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

    if ($this->localMode) {
      $storageWebPages = $this->_getLocalStorageWebPages($regex, $startKey, $endKey, ["title", "baseUrl", "outlinks"], $start, $limit);
    } else {
      $storageWebPages = $this->_getStorageWebPages($regex, $startKey, $endKey, ["title", "baseUrl", "outlinks"], $start, $limit);
    }

    $this->set(compact('storageWebPages', 'startKey', 'page', 'page_entity_id'));
  }

  function indexByCrawl($crawl_id)
  {
    $this->loadModel('Crawl');
    $this->Crawl->contain(array('CrawlFilter'));
    $crawl = $this->Crawl->read(null, $crawl_id);

    $fields = array("title", "baseUrl", "outlinks");
    $webPages = $this->_getStorageWebPagesByCrawlFilter($crawl, $fields, 100);

    $this->set(compact('crawl', 'webPages'));
  }

  /**
   * Download a web page from nutch server if exists.
   * By default, some of it's own tags is stripped to show it nested in our view correctly.
   * */
  function view($encodedUrl)
  {
    $this->layout = 'empty';

    $options = array();
    if (isset($this->params['named']['options'])) {
      $options = explode("+", $this->params['named']['options']);
    }
    array_push($options, 'strip');

    $page_entity_id = null;
    if (isset($this->params['named']['page_entity_id'])) {
      $page_entity_id = $this->params['named']['page_entity_id'];
    } else {
      array_push($options, 'raw');
    }

    $url = symmetric_decode($encodedUrl);

    if ($this->localMode) {
      $storageWebPage = $this->_getLocalStorageWebPage($url, $options);
    } else {
      $storageWebPage = $this->_getStorageWebPage($url, $options);
    }


    $pageEntity = $this->_getPageEntity($storageWebPage, $page_entity_id);

    if (in_array('raw', $options)) {
      echo $storageWebPage['StorageWebPage']['content'];
      die();
    }

    $this->set(compact('storageWebPage', 'pageEntity', 'options'));
  }

  function sketch()
  {
    $this->layout = 'empty';
  }

  function analysis($url)
  {
    $this->layout = 'empty';

    $url = symmetric_decode($url);
    $storageWebPage = $this->_getStorageWebPage($url, ['raw']);

    if (isset($this->params['named']['page_entity_id'])) {
      $page_entity_id = $this->params['named']['page_entity_id'];
    }
    $pageEntity = $this->_getPageEntity($storageWebPage, $page_entity_id);
    $content = $storageWebPage['StorageWebPage']['content'];

    $cacheFile = md5(__FUNCTION__ . '-' . $url);
    $results = Cache::read($cacheFile, 'minute');
    if ($results == null) {
      \App::import('Lib', array('scent/scent_client'));

      $scentClient = new \Scent\ScentClient();
      $results = $scentClient->extract(['-html' => $content, '-format' => 'all']);

      Cache::write($cacheFile, $results, 'minute');
    }

    $storageWebPage['StorageWebPage']['content'] = "";
    $results = qi_json_decode($results, true, 10);
    // Fix satellite version 0.1 bug
    if (!empty($results['result'])) {
      App::import('Lib', array('html_utils'));
      $content = $results['result'];

      $result = HtmlUtils::stripHTML($content, $url, []);
      $storageWebPage['StorageWebPage']['content'] = $result['content'];
    }

    $this->set(compact('storageWebPage', 'pageEntity'));
  }


  function _getPageEntity($storageWebPage, $page_entity_id = null)
  {
    $pageEntity = [
        'PageEntity' => ['id' => 0],
        'PageEntityField' => []
    ];

    if ($page_entity_id != null) {
      $this->loadModel('PageEntity');
      $pageEntity = $this->PageEntity->read(null, $page_entity_id);
    }

    $pageEntity['PageEntity']['url'] = $storageWebPage['StorageWebPage']['url'];
    $pageEntity['PageEntity']['name'] = $storageWebPage['StorageWebPage']['title'];
    $pageEntity['PageEntity']['content'] = $storageWebPage['StorageWebPage']['content'];

    return $pageEntity;
  }

  function _getStorageWebPagesByCrawlFilter($crawl, $fields = null, $limit = 100)
  {
    $executor = new \Nutch\RemoteCmdExecutor();
    $webPages = $executor->queryByCrawlFilter($crawl, $fields, $limit);

    $webPages = qi_json_decode($webPages, true, 10);
    if (!isset($webPages['values'])) {
      $webPages['values'] = [];
    }

    return $webPages['values'];
  }

  /**
   * Get web pages from hbase, via issue a query to nutchserver
   */
  function _getStorageWebPages($regex = '.+', $startKey = null, $endKey = null, $fields = null, $start = 0, $limit = 100)
  {
    $dbFilter = new \Nutch\DbFilter($startKey, $endKey, \Nutch\normalizeUrlFilter($regex), $fields,
        $start, $limit, null, $this->currentUser['id']);

    $cacheFile = md5(__FUNCTION__ . '-' . $dbFilter->__toString());
    $storageWebPages = Cache::read($cacheFile, 'minute');
    if ($storageWebPages == null) {
      $storageWebPages = $this->nutchClient->query($dbFilter);
      Cache::write($cacheFile, $storageWebPages, 'minute');
    }
    $storageWebPages = qi_json_decode($storageWebPages, true, 10);

    if (empty($storageWebPages['values'])) {
      $storageWebPages['values'] = [];
    }

    return $storageWebPages['values'];
  }

  /**
   * Get web pages from local file system
   */
  function _getLocalStorageWebPages($regex = '.+', $startKey = null, $endKey = null, $fields = null, $start = 0, $limit = 100)
  {
    $storageWebPages = [];

    // Create recursive dir iterator which skips dot folders
    $it = new RecursiveDirectoryIterator($this->webpagesDir, FilesystemIterator::SKIP_DOTS);

    // Basic loop displaying different messages based on file or folder
    foreach ($it as $fileinfo) {
      if ($fileinfo->isFile()) {
        $relativePath = $fileinfo->getPath() . DS . $fileinfo->getFilename();
        $relativePath = str_replace(ROOT_DATA_DIR, "", $relativePath);
        $storageWebPage = ['baseUrl' => $relativePath];
        array_push($storageWebPages, $storageWebPage);
      }
    }

    return $storageWebPages;
  }

  /**
   * @param $url
   * @param $options
   * @return null
   **/
  private function _getStorageWebPage($url, $options = [])
  {
    App::import('Lib', array('html_utils'));

    $cacheFile = md5(__FUNCTION__ . '-' . $url);
    $storageWebPages = Cache::read($cacheFile, 'minute');
    if ($storageWebPages == null) {
      $nutchClient = new \Nutch\NutchClient();
      $dbFilter = new \Nutch\DbFilter($url, $url);

//    bad idea to create a table for each user?
//    $dbFilter->setCrawlId($this->currentUser['id']);

      $storageWebPages = $nutchClient->query($dbFilter);

      Cache::write($cacheFile, $storageWebPages, 'minute');
    }

    $storageWebPages = qi_json_decode($storageWebPages, true, 10);

    if (empty($storageWebPages['values'])) {
      return array('StorageWebPage' => array('url' => $url, 'title' => '', 'content' => ''));
    }

    $storageWebPage['StorageWebPage'] = $storageWebPages['values'][0];

    $content = $storageWebPage['StorageWebPage']['content'];
    $result = HtmlUtils::stripHTML($content, $url, $options);
    $storageWebPage['StorageWebPage']['title'] = $result['title'];
    $storageWebPage['StorageWebPage']['content'] = $result['content'];

    return $storageWebPage;
  }

  /**
   * @param $url
   * @param $options
   * @return null
   **/
  private function _getLocalStorageWebPage($url, $options = [])
  {
    App::import('Lib', array('html_utils'));

    $storageWebPage = array('StorageWebPage' => array('url' => $url, 'title' => '', 'content' => ''));

    $content = file_get_contents(ROOT_DATA_DIR . $url);
    $result = HtmlUtils::stripHTML($content, null, $options);
    $storageWebPage['StorageWebPage']['title'] = $result['title'];
    $storageWebPage['StorageWebPage']['content'] = $result['content'];

    return $storageWebPage;
  }
}
