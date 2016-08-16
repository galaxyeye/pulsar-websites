<?php
App::import ( 'Lib', [ 
		'filter_utils',
		'nutch/nutch_client',
		'nutch/remote_cmd_executor' 
] );
class StorageWebPagesController extends AppController {
	public $name = 'StorageWebPages';
	private $webpagesDir = ROOT_DATA_DIR;
	private $localStorageMode = true;
	
	/**
	 *
	 * @var Nutch\NutchClient
	 *
	 */
	private $nutchClient;
	function beforeFilter() {
		parent::beforeFilter ();
		
		$this->webpagesDir = ROOT_DATA_DIR . "/web/mia.com/06.16/detail/";
		
		$this->localStorageMode = STORAGE_WEB_PAGES_MODE == "local" ? true : false;
		
		$this->nutchClient = new Nutch\NutchClient ();
		
		$this->Auth->allow ( 'anonymous_index', 'anonymous_view' );
	}
	function anonymous_index() {
		$this->index ();
	}
	function anonymous_view($encodedUrl) {
		$this->view ( $encodedUrl );
	}
	
	/**
	 * TODO : SQL-like LIMIT semantic
	 */
	function index() {
		$regex = ".+";
		$startKey = null;
		$endKey = null;
		$page = 1;
		$start = 0;
		$limit = 100;
		$page_entity_id = 0;
		
		if (! empty ( $this->params ['url'] ['regex'] )) {
			$regex = trim ( $this->params ['url'] ['regex'] );
		}
		if (! empty ( $this->params ['url'] ['startKey'] )) {
			$startKey = trim ( $this->params ['url'] ['startKey'] );
		}
		if (! empty ( $this->params ['url'] ['endKey'] )) {
			$endKey = trim ( $this->params ['url'] ['endKey'] );
		}
		if (! empty ( $this->params ['url'] ['page'] )) {
			$page = intval ( $this->params ['url'] ['page'] );
			$start = ($page - 1) * $limit;
		}
		if (! empty ( $this->params ['url'] ['page_entity_id'] )) {
			$page_entity_id = intval ( $this->params ['url'] ['page_entity_id'] );
		}
		
		if ($startKey == null) {
			$startKey = regex2startKey ( $regex );
			if ($endKey == null && $startKey != null) {
				$endKey = $startKey . "\uFFFF";
			}
		}
		
		if ($endKey == null) {
			$endKey = regex2endKey ( $regex );
		}
		
		$storageWebPages = [ ];
		if ($this->localStorageMode) {
			$storageWebPages = $this->_getLocalStorageWebPages ( $regex, $startKey, $endKey, [ 
					"title",
					"baseUrl",
					"outlinks" 
			], $start, $limit );
		} else {
			$nutchStatus = $this->nutchClient->getStatus ();
			if (! empty ( $nutchStatus )) {
				$storageWebPages = $this->_getStorageWebPages ( $regex, $startKey, $endKey, [ 
						"title",
						"baseUrl",
						"outlinks" 
				], $start, $limit );
			}
		}
		
		$this->set ( compact ( 'storageWebPages', 'startKey', 'page', 'page_entity_id', 'nutchStatus' ) );
		$this->set ( 'localStorageMode', $this->localStorageMode );
	}
	function indexByCrawl($crawl_id) {
		$this->loadModel ( 'Crawl' );
		$this->Crawl->contain ( [
			'CrawlFilter'
		]);
		$crawl = $this->Crawl->read ( null, $crawl_id );
		
		$fields = array (
				"title",
				"baseUrl",
				"outlinks"
		);
		$webPages = $this->_getStorageWebPagesByCrawlFilter ( $crawl, $fields, 100 );
		// $webPages = [];
		$this->set ( compact ( 'crawl', 'webPages' ) );
	}
	
	/**
	 * Download a web page from nutch server if exists.
	 * By default, some of it's own tags is stripped to show it nested in our view correctly.
	 */
	function view($encodedUrl) {
		$this->layout = 'empty';
		
		$options = array ();
		if (isset ( $this->params ['named'] ['options'] )) {
			$options = explode ( "+", $this->params ['named'] ['options'] );
		}
		array_push ( $options, 'strip' );
		
		$page_entity_id = null;
		if (isset ( $this->params ['named'] ['page_entity_id'] )) {
			$page_entity_id = $this->params ['named'] ['page_entity_id'];
		} else {
			array_push ( $options, 'raw' );
		}
		
		$url = symmetric_decode ( $encodedUrl );
		
		$nutchStatus = $this->nutchClient->getStatus ();
		if ($this->localStorageMode) {
			$storageWebPage = $this->_getLocalStorageWebPage ( $url, $options );
		} else {
			if ($nutchStatus) {
				$storageWebPage = $this->_getStorageWebPage ( $url, $options );
			}
		}
		
		if ($page_entity_id) {
			// load page entity to get it's name
			$pageEntity = $this->_getPageEntity ( $storageWebPage, $page_entity_id );
			$this->set ( compact ( 'storageWebPage', 'pageEntity', 'options' ) );
			// disable debug panel which lead to a very bad js performance
			Configure::write ( 'debug', 0 );
		} else {
			echo $storageWebPage ['StorageWebPage'] ['content'];
			$this->autoRender = false;
		}
	}
	function sketch() {
		App::import ( 'Vendor', 'qp' );
		
		// $url = "/scent/diagnosis/0628.parallel/block-shapes.html";
		$url = "/scent/ml/0707.2140/block-print.html";
		$url = GLOBAL_DATA_DIR . $url;
		
		$html = file_get_contents ( $url );
		$html = mb_convert_encoding ( $html, 'HTML-ENTITIES', "UTF-8" );
		
		$dom = htmlqp ( $html, null, [ 
				'convert_to_encoding' => 'utf-8' 
		] );
		$title = $dom->find ( 'title' )->text ();
		$alignedRectangles = $dom->find ( ".data .alignedRectangles" )->text ();
		$resizedShapes = $dom->find ( ".data .resizedShapes" )->text ();
		$content = $dom->find ( ".canvas" )->innerXHTML ();
		
		$storageWebPage ['StorageWebPage'] ['title'] = $title;
		$storageWebPage ['StorageWebPage'] ['alignedRectangles'] = $alignedRectangles;
		$storageWebPage ['StorageWebPage'] ['resizedShapes'] = $resizedShapes;
		$storageWebPage ['StorageWebPage'] ['content'] = $content;
		
		// pr(json_decode($data));
		// die();
		
		$this->set ( "storageWebPage", $storageWebPage );
		
		Configure::write ( 'debug', 0 );
	}
	function analysis($url) {
		$this->layout = 'empty';
		
		$url = symmetric_decode ( $url );
		$storageWebPage = $this->_getStorageWebPage ( $url, [ 
				'raw' 
		] );
		
		if (isset ( $this->params ['named'] ['page_entity_id'] )) {
			$page_entity_id = $this->params ['named'] ['page_entity_id'];
		}
		$pageEntity = $this->_getPageEntity ( $storageWebPage, $page_entity_id );
		$content = $storageWebPage ['StorageWebPage'] ['content'];
		
		$cacheFile = md5 ( __FUNCTION__ . '-' . $url );
		$results = Cache::read ( $cacheFile, 'minute' );
		if ($results == null) {
			App::import ( 'Lib', array (
					'scent/scent_client' 
			) );
			
			$scentClient = new Scent\ScentClient ();
			$results = $scentClient->extract ( [ 
					'-html' => $content,
					'-format' => 'all' 
			] );
			
			Cache::write ( $cacheFile, $results, 'minute' );
		}
		
		$storageWebPage ['StorageWebPage'] ['content'] = "";
		$results = qi_json_decode ( $results, true, 10 );
		// Fix satellite version 0.1 bug
		if (! empty ( $results ['result'] )) {
			App::import ( 'Lib', array (
					'html_utils' 
			) );
			$content = $results ['result'];
			
			$result = HtmlUtils::stripHTML ( $content, $url, [ ] );
			$storageWebPage ['StorageWebPage'] ['content'] = $result ['content'];
		}
		
		$this->set ( compact ( 'storageWebPage', 'pageEntity' ) );
	}
	function _getPageEntity($storageWebPage, $page_entity_id = null) {
		$pageEntity = [ 
				'PageEntity' => [ 
						'id' => 0 
				],
				'PageEntityField' => [ ] 
		];
		
		if ($page_entity_id != null) {
			$this->loadModel ( 'PageEntity' );
			$pageEntity = $this->PageEntity->read ( null, $page_entity_id );
		}
		
		$pageEntity ['PageEntity'] ['url'] = $storageWebPage ['StorageWebPage'] ['url'];
		$pageEntity ['PageEntity'] ['name'] = $storageWebPage ['StorageWebPage'] ['title'];
		$pageEntity ['PageEntity'] ['content'] = $storageWebPage ['StorageWebPage'] ['content'];
		
		return $pageEntity;
	}
	function _getStorageWebPagesByCrawlFilter($crawl, $fields = null, $limit = 100) {
		$executor = new Nutch\RemoteCmdExecutor ();
		$data = $executor->queryByCrawlFilter ( $crawl, $fields, $limit );
		$data ['content'] = qi_json_decode ( $data ['content'], true, 10 );
		$data ['storage'] = "REMOTE";
		
		if (empty ( $data ['content'] ['values'] )) {
			$data ['content'] ['values'] = [ ];
		}
		
		return $data ['content'] ['values'];
	}
	
	/**
	 * Get web pages from hbase, via issue a query to nutchserver
	 */
	function _getStorageWebPages($regex = '.+', $startKey = null, $endKey = null, $fields = null, $start = 0, $limit = 100) {
		$dbFilter = new Nutch\DbFilter ( $startKey, $endKey, normalizeUrlFilter ( $regex ), $fields, $start, $limit, null, $this->currentUser ['id'] );
		
		$cacheFile = md5 ( __FUNCTION__ . '-' . $dbFilter->__toString () );
		$data = Cache::read ( $cacheFile, 'minute' );
		if (false && $data != null) {
			$data = qi_json_decode ( $data, true, 10 );
			$data ['storage'] = "CACHE";
		} else {
			$data = $this->nutchClient->query ( $dbFilter );
			$data ['content'] = qi_json_decode ( $data ['content'], true, 10 );
			$data ['storage'] = "REMOTE";
			
			Cache::write ( $cacheFile, json_encode ( $data ), 'minute' );
		}
		
		if (empty ( $data ['content'] ['values'] )) {
			$data ['content'] ['values'] = [ ];
		}
		
		return $data ['content'] ['values'];
	}
	
	/**
	 * Get web pages from local file system
	 */
	function _getLocalStorageWebPages($regex = '.+', $startKey = null, $endKey = null, $fields = null, $start = 0, $limit = 100) {
		$storageWebPages = [ ];
		
		// Create recursive dir iterator which skips dot folders
		$it = new RecursiveDirectoryIterator ( $this->webpagesDir, FilesystemIterator::SKIP_DOTS );
		
		// Basic loop displaying different messages based on file or folder
		foreach ( $it as $fileinfo ) {
			if ($fileinfo->isFile ()) {
				$relativePath = $fileinfo->getPath () . DS . $fileinfo->getFilename ();
				$relativePath = str_replace ( ROOT_DATA_DIR, "", $relativePath );
				$storageWebPage = [ 
						'baseUrl' => $relativePath 
				];
				array_push ( $storageWebPages, $storageWebPage );
			}
		}
		
		return $storageWebPages;
	}
	
	/**
	 *
	 * @param
	 *        	$url
	 * @param
	 *        	$options
	 * @return null
	 *
	 */
	private function _getStorageWebPage($url, $options = []) {
		App::import ( 'Lib', 'html_utils' );
		
		$cacheFile = md5 ( __FUNCTION__ . '-' . $url );
		$data = Cache::read ( $cacheFile, 'minute' );
		if (false && $data != null) {
			$data = qi_json_decode ( $data, true, 10 );
		} else {
			$dbFilter = new Nutch\DbFilter ( $url, $url );
			$data = $this->nutchClient->query ( $dbFilter );
			$data ['content'] = qi_json_decode ( $data ['content'], true, 10 );
			$data ['storage'] = "REMOTE";
			
			Cache::write ( $cacheFile, json_encode ( $data ), 'minute' );
		}
		
		if (empty ( $data ['content'] ['values'] )) {
			return [ 
					'StorageWebPage' => [ 
							'url' => $url,
							'title' => '',
							'content' => '' 
					] 
			];
		}
		$storageWebPage = [ ];
		$storageWebPage ['StorageWebPage'] = $data ['content'] ['values'] [0];

		if (isset($storageWebPage ['StorageWebPage'] ['content'])) {
			$content = $storageWebPage ['StorageWebPage'] ['content'];
			$result = HtmlUtils::stripHTML ( $content, $url, $options );
			$storageWebPage ['StorageWebPage'] ['title'] = $result ['title'];
			$storageWebPage ['StorageWebPage'] ['content'] = $result ['content'];
		}
		else {
			$storageWebPage ['StorageWebPage'] ['content'] = "";
		}

		return $storageWebPage;
	}
	
	/**
	 *
	 * @param
	 *        	$url
	 * @param
	 *        	$options
	 * @return null
	 *
	 */
	private function _getLocalStorageWebPage($url, $options = []) {
		App::import ( 'Lib', array (
				'html_utils' 
		) );
		
		$storageWebPage = array (
				'StorageWebPage' => array (
						'url' => $url,
						'title' => '',
						'content' => '' 
				) 
		);
		
		$content = file_get_contents ( ROOT_DATA_DIR . $url );
		$result = HtmlUtils::stripHTML ( $content, null, $options );
		$storageWebPage ['StorageWebPage'] ['title'] = $result ['title'];
		$storageWebPage ['StorageWebPage'] ['content'] = $result ['content'];
		
		return $storageWebPage;
	}
}
