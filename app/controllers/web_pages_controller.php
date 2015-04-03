<?php 

App::import('Lib', array('qp'));

class WebPagesController extends AppController {

  var $name = 'WebPages';
  var $cacheDir = "/tmp/web_pages";

  function search() {
    if (empty($this->data)) {
      $this->loadModel('Crawl');
      // $this->Crawl->find('list', array('fields' => array('batchId')));
    }

    if (!empty($this->data)) {
      $nutchClient = new NutchClient();

      $startKey = $this->data['WebPage']['startKey'];
      $endKey = $this->data['WebPage']['endKey'];
      if (empty($startKey)) $startKey = null;
      if (empty($endKey)) $endKey = null;

      $dbFilter = new DbFilter($startKey, $endKey);

      pr($dbFilter->__toString());

      $result = $nutchClient->query($dbFilter);
      $this->set('webPages', json_decode($result, true, 10));
    }
  }

  function searchByUrl($url = null) {
    if (!$url && empty($this->data)) {
      return;
    }

    if ($url) {
      $startKey = symmetric_decode($url);
      $endKey = null;
    }

    if (!empty($this->data)) {
      $startKey = $this->data['WebPage']['startKey'];
      $endKey = $this->data['WebPage']['endKey'];
    }

    if (empty($startKey)) $startKey = null;
    if (empty($endKey)) $endKey = null;

    $nutchClient = new NutchClient();
    $dbFilter = new DbFilter($startKey, $endKey);
    $webPages = $nutchClient->query($dbFilter);
    $webPages = json_decode($webPages, true, 10);

    $this->set(compact('webPages', 'dbFilter'));
  }

  function indexByPageEntity($page_entity_id) {
    $this->loadModel('PageEntity');
    $pageEntity = $this->PageEntity->read(null, $page_entity_id);

    $crawl = [
    		'Crawl' => ['id' => $pageEntity['PageEntity']['crawl_id']], 
    		'CrawlFilter' => [
    				[
    						'url_filter' => $pageEntity['PageEntity']['url_filter'], 
    						'text_filter' => $pageEntity['PageEntity']['text_filter']				
    				]
    		]
    ];

    $fields = array("title", "baseUrl", "outlinks");
    $webPages = $this->_getWebPagesByCrawlFilter($crawl, $fields, 500);

    $this->set(compact('pageEntity', 'webPages'));
  }

  function indexByCrawl($crawl_id) {
    $this->loadModel('Crawl');
    $this->Crawl->contain(array('CrawlFilter'));
    $crawl = $this->Crawl->read(null, $crawl_id);

    $fields = array("title", "baseUrl", "outlinks");
    $webPages = $this->_getWebPagesByCrawlFilter($crawl, $fields, 500);

    $this->set(compact('crawl', 'webPages'));
  }

  /**
   * TODO : add a nutch server side service to report fetched count
   * */
  function ajax_getFetchedDetailPageCount($crawl_id) {
  	$this->autoRender = false;

  	$this->loadModel('Crawl');
  	$this->Crawl->contain(array('CrawlFilter' => array('conditions' => array('page_type' => 'DETAIL'))));
  	$crawl = $this->Crawl->read(null, $crawl_id);

  	if ($fields == null) {
  		$fields = array("title", "baseUrl", "outlinks");
  	}

  	$urlFilter = null;
  	foreach ($crawlFilters as $f) {
  		$urlFilter .= \Nutch\normalizeUrlFilter($f['url_filter']);
  	}

  	$nutchClient = new \Nutch\NutchClient();
  	$dbFilter = new \Nutch\DbFilter();
  	$dbFilter->setUrlFilter($urlFilter);
  	$dbFilter->setFields($fields);
  	if ($limit) {
  		$dbFilter->setLimit($limit);
  	}

  	$webPages = $nutchClient->query($dbFilter);
  	$webPages = json_decode($webPages, true, 10);

  	return $webPages['values'];
  }

  function ajax_getDetailPageLinks($crawl_id, $options = "", $limit = 100) {
    $this->autoRender = false;

    $options = explode("+", $options);

    $this->loadModel('Crawl');
    $this->Crawl->contain(array('CrawlFilter' => array('conditions' => array('page_type' => 'DETAIL'))));
    $crawl = $this->Crawl->read(null, $crawl_id);

    $webPages = $this->_getWebPagesByCrawlFilter($crawl, array('baseUrl'), $limit);

    $outlinks = array();

    if (in_array('random', $options)) {
    	$i = rand(0, count($webPages));
    	array_push($outlinks, $webPages[$i]['baseUrl']);
    }
    else {
    	foreach ($webPages as $webPage) {
    		array_push($outlinks, $webPage['baseUrl']);
    	}
    }

    echo json_encode($outlinks);
  }

  /**
   * Get a random detail page from nutch server for the given crawl
   * */
  function ajax_getRandomDetailPage($crawl_id, $contentOnly = true) {
  	$this->autoRender = false;

  	$webPage = $this->_getRandomDetailPage();

  	if ($contentOnly) {
	  	echo empty($webPage) ? "" : $webPage['WebPage']['content'];
  	}
  	else {
  		echo json_encode($webPage);
  	}
  }

  function index() {
    $webPages = array(
        array('WebPage' => array(
            'url' => "http://www.hahaertong.com/huodong-shanghai/",
            'title' => '东方童画3月萌宝生日会，邀您一起来参与！ '
          )
        ),
        array('WebPage' => array(
            'url' => "http://www.hahaertong.com/huodong-beijing/",
            'title' => 'Duang!宝贝闹元宵，欢乐送大礼！ '
          )
        )
    );

    $this->set(compact('webPages'));
  }

  /**
   * Download a web page from nutch server if exists.
   * By default, some of it's own tags is stripped to show it nested in our view correctly.
   * */
  function view($url) {
    $this->layout = 'empty';

    $options = array();
    if (isset($this->params['named']['options'])) {
      $options = explode("+", $this->params['named']['options']);
    }
    array_push($options, 'strip');

    $view = 'view';
    if (isset($this->params['named']['page_entity_id'])) {
      $this->_viewByPageEntity($this->params['named']['page_entity_id']);
      $view = 'view_by_page_entity';
    }

    $url = symmetric_decode($url);
    $webPage = $this->_getWebPage($url, $options);

    if (in_array('raw', $options)) {
    	echo $webPage['WebPage']['content'];
    	die();
    }

    $this->set(compact('webPage', 'options'));

    $this->render($view);
  }

  /**
   * TODO : use ant test this action instead of view with named params
   * */
  function viewByPageEntity($page_entity_id) {
  	$this->layout = 'empty';

  	$options = array();
  	if (isset($this->params['named']['options'])) {
  		$options = explode("+", $this->params['named']['options']);
  	}
  	array_push($options, 'strip');

  	$this->_viewByPageEntity($this->params['named']['page_entity_id']);

  	$url = symmetric_decode($url);
  	$webPage = $this->_getWebPage($url, $options);

  	$this->set(compact('webPage', 'options'));
  }

  function viewRandomDetailPage() {
    $this->layout = 'empty';

    $options = array();
    if (isset($this->params['named']['options'])) {
      $options = explode("+", $this->params['named']['options']);
    }
    array_push($options, 'strip');

    $view = 'view';
    $page_entity_id = null;
    $crawlFilters = array(array('url_filter' => '.+'));

    if (isset($this->params['named']['page_entity_id'])) {
    	$page_entity_id = $this->params['named']['page_entity_id'];
      $view = 'view_by_page_entity';

      $this->loadModel('PageEntity');
      $this->PageEntity->contain('PageEntityField');
      $pageEntity = $this->PageEntity->read(null, $page_entity_id);

      $crawlFilters = array(array('url_filter' => $pageEntity['PageEntity']['url_filter']));

      $this->set(compact('pageEntity'));
    }

    $webPage = $this->_getRandomDetailPage($crawlFilters, $options);

    $this->set(compact('webPage', 'options'));

    $this->render($view);
  }

  function _viewByPageEntity($pageEntityId) {
    $this->loadModel('PageEntity');
    $pageEntity = $this->PageEntity->read(null, $pageEntityId);

    $this->set(compact('pageEntity'));
  }

  /**
   * Download the url from the original site
   * */
  function download($url) {
    $this->layout = 'empty';

    $url = symmetric_decode($url);
    $content = file_get_contents($url);

    $this->set(compact('content'));
  }

  function _getWebPage($url, $options = array()) {
    // cache 
  	if (!file_exists($this->cacheDir)) {
  		@mkdir($this->cacheDir);
  	}

    $cacheFile = $this->cacheDir.DS.md5($url).".html";
    if (file_exists($cacheFile)) {
    	$webPages = file_get_contents($cacheFile);
    }
    else {
    	$startKey = $endKey = $url;

    	$nutchClient = new \Nutch\NutchClient();
    	$dbFilter = new \Nutch\DbFilter($startKey, $endKey);
    	$webPages = $nutchClient->query($dbFilter);

    	file_put_contents($cacheFile, $webPages);
    }

    $webPages = json_decode($webPages, true, 10);

    if (empty($webPages['values'])) {
      return array('WebPage' => array('url' => $startKey, 'title' => '', 'content' => ''));
    }

    $webPage['WebPage'] = $webPages['values'][0];

    if (in_array('raw', $options)) {
    	return $webPage;
    }

    if (in_array('strip', $options)) {
      return $this->_stripHTML($webPage, $options);
    }

    return $webPage;
  }

  private function _getRandomDetailPage($crawl, $options = null) {
  	// TODO : We can do this on the server side
  	$limit = 100;
  	$links = $this->_getWebPagesByCrawlFilter($crawl, array('baseUrl'), $limit);
		if (count($links) == 0) {
			return null;
		}

  	$i = rand(0, count($links));
  	$url = $links[$i]['baseUrl'];
  	$webPage = $this->_getWebPage($url, $options);

  	return $webPage;
  }

  function _getWebPagesByCrawlFilter($crawl, $fields = null, $limit = null) {
  	if ($limit == null) $limit = 500;

  	$executor = new \Nutch\RemoteCmdExecutor();
  	$webPages = $executor->queryByCrawlFilter($crawl, $fields, $limit);
    $webPages = json_decode($webPages, true, 10);
    if (!is_array($webPages['values'])) {
    	$webPages['values'] = [];
    }

    return $webPages['values'];
  }

  private function _stripHTML($webPage, $options) {
    if (empty($webPage['WebPage']['content'])) {
      return null;
    }

    $MIN_CONTENT_LENGTH = 100;
    $content = $webPage['WebPage']['content'];
    if (strlen($content) < $MIN_CONTENT_LENGTH) {
      return null;
    }

    $dom = htmlqp($content, null, ['convert_to_encoding' => 'utf-8']);

    App::import('Lib', array('html_utils'));
    HtmlUtils::qpMakeLinksAbsolute($dom, $webPage['WebPage']['baseUrl']);
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
    $content = preg_replace("/html|body|head/", "div", $content);
    $content = preg_replace("/DOCTYPE|dtd|xml/i", "", $content);

    $webPage['WebPage']['title'] = $title;
    $webPage['WebPage']['content'] = $content;

    return $webPage;
  }

  private function __analysis($dom) {
    //     pr($dom);
    //     die();
  
    $this->__walk($dom);
  }
  
  private function __walk($dom) {
    $node = $dom->top();

    $this->__analysisNode($node);

    $this->__walkChildren($node);
  }

  private function __walkChildren($dom) {
    foreach($dom->children() as $child) {
      $this->__analysisNode($child);

      $this->__walkChildren($child);
    }
  }

  private function __analysisNode($node) {
    if (in_array($node->tag(), $this->keyTags)) {
      // do something
      pr($node->tag().$node->text());
    }
  }

  private function __trimAllTags($page) {
  }

  private function __segmentWords($page) {
  }

  private function __parseMeta($dom) {
    $meta = array('title', '');
  
    $title = $dom->find('title');
    $metaKeywords = $dom->find('meta');
    $metaDescription = $dom->find('meta');
  }

  function __analysisHeaders($dom) {
    $headerTags = array('h1', 'h2', 'h3', 'h4', 'h5', 'h6');

    foreach ($headerTags as $headerTag) {
      foreach ($dom->find($headerTag) as $h) {
        $headerTags[$headerTag] = $h->html();
      }
    }

    return $headerTags;
  }

  function __analysisSummary($dom) {
  
  }

  function __analysisTags($dom) {

  }
}
