<?php 

App::import('Vendor', 'qp');
App::import('Lib', 'nutch/nutch_utils');

/**
 * @deprecated, use storage_web_pages instead
 * */
class WebPagesController extends AppController {

  var $name = 'WebPages';

  function beforeFilter() {
  	parent::beforeFilter();
  	die("Deprecated");
  }

  /**
   * @deprecated
   * */
  function viewScentFileServer($path = DS) {
  	$path = trim($path, DS);

  	$this->redirect(SCENT_FILE_SERVER . "/" . $path);
  }

  /**
   * @deprecated
   * */
  function showExtractResultAsWebsite($outFolder) {
  	$folder = SCENT_OUT_DIR_AUTO_EXTRACT . "/" . $outFolder;
  	$this->viewScentFileServer($folder);
  }

  /**
   * @deprecated
   * */
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
   * @deprecated
   * */
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
  }die("Deprecated");
  

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

  function viewByPageEntity($url) {
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

  function viewAnalysisResult($url) {
  	$this->layout = 'empty';

  	$this->_viewByPageEntity($this->params['named']['page_entity_id']);

  	$url = symmetric_decode($url);
  	$webPage = $this->_getWebPage($url, ['raw']);

  	$results = Cache::read("viewAnalysisResult-".$url, 'minute');
  	if ($results == null) {
  		\App::import('Lib', array('scent/scent_client'));

  		$scentClient = new \Scent\ScentClient();
  		$results = $scentClient->extract(['-html' => $webPage['WebPage']['content'], '-format' => 'all']);

  		Cache::write("viewAnalysisResult-".$url, $results, 'minute');
  	}

  	$webPage['WebPage']['content'] = "";
  	$results = json_decode($results, true, 10);
  	// Fix satellite version 0.1 bug
  	if (!empty($results['result'])) {
	  	$content = $results['result'];

	  	$webPage['WebPage']['content'] = $content;
	  	$webPage = $this->_stripHTML($webPage, ['simpleCss']);
  	}

  	$this->set(compact('webPage'));
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

  private function _viewByPageEntity($pageEntityId) {
  	$this->loadModel('PageEntity');
  	$pageEntity = $this->PageEntity->read(null, $pageEntityId);
  
  	$this->set(compact('pageEntity'));
  }

  private function _getWebPage($url, $options = []) {
  	$webPages = Cache::read("_getWebPage-".$url, 'minute');
  	if ($webPages == null) {
    	$nutchClient = new \Nutch\NutchClient();
    	$dbFilter = new \Nutch\DbFilter($url, $url);
    	$webPages = $nutchClient->query($dbFilter);

  		Cache::write("_getWebPage-".$url, $webPages, 'minute');
  	}

    $webPages = json_decode($webPages, true, 10);

    if (empty($webPages['values'])) {
      return array('WebPage' => array('url' => $url, 'title' => '', 'content' => ''));
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

  function _getWebPagesByCrawlFilter($crawl, $fields = null, $limit = 100) {
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
    $content = preg_replace("/<html|<body|<head/", "<div", $content);
    $content = preg_replace("/DOCTYPE|dtd|xml/i", "", $content);

    $content = preg_replace("/#QiwurScrapingMetaInformation &gt;/", "body &gt;", $content);
    $content = preg_replace("/#qiwurBody &gt;/", "body &gt;", $content);

    $webPage['WebPage']['title'] = $title;
    $webPage['WebPage']['content'] = $content;

    return $webPage;
  }
}
