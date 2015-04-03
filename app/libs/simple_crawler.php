<?php 

class SimpleCrawler extends Object {

	public static $CRAWL_REGIONS = [
		'ANY' => 'ANY',
		'TLD' => 'TLD',
		'DOMAIN' => 'DOMAIN',
 		'DIRECTORY' => 'DIRECTORY',
	];

	var $cacheDir = "/tmp/simple_crawler";
	var $limit = 50;
	var $maxUrlLength = 1000;

	var $seed = null;
	var $crawlRegion = 'DIRECTORY';
	var $tld = "";
	var $domain = "";
	var $baseDir = "";

	var $seen = array();
	var $outlinks = array();

	// special words in url
	var $p1words = array('item', 'detail', 'product', 'shop', 'activity', 'goods');
	var $p2words = array('index', 'list');
	var $badWords = array(
			'comment', 'help',
			'ajax', 'javascript',
			'cdn', 'cache',
			'video',
			'jpg', 'png', 'gif', 'swf', 'flv');

	public function __construct() {
	}

	public function getOutlinks() {
		return array_keys($this->outlinks);
	}

	/**
	 * $depth does not implemented yet
	 * */
	public function crawl($url, $depth, $region = 'DIRECTORY') {
		if (empty($this->seed)) {
			$this->seed = $url;
			if ($this->crawlRegion == self::$CRAWL_REGIONS['TLD']) {
				$this->tld = get_tld($url);
			}
		}

		if (!file_exists($this->cacheDir)) {
			@mkdir($this->cacheDir);
		}

		$fetchList = $this->_doCrawl($url, $depth);
	  $fetchList2 = array('p1' => array(), 'p2' => array(), 'p3' => array());

		// round 1
		foreach (array('p1', 'p2', 'p3') as $priority) {
			foreach ($fetchList[$priority] as $link) {
				$fl = $this->_doCrawl($link, $depth - 1);
				$fetchList2 += $fl;
			}
		}

		if ($this->limit <= 0) {
			return;
		}

		// round 2
	  $fetchList = array('p1' => array(), 'p2' => array(), 'p3' => array());
		foreach (array('p1', 'p2', 'p3') as $priority) {
			foreach ($fetchList2[$priority] as $link) {
				$fl = $this->_doCrawl($link, $depth - 1);
				$fetchList += $fl;
			}
		}

		if ($this->limit <= 0) {
			return;
		}

		// round 3
	  $fetchList2 = array('p1' => array(), 'p2' => array(), 'p3' => array());
		foreach (array('p1', 'p2', 'p3') as $priority) {
			foreach ($fetchList[$priority] as $link) {
				$this->_doCrawl($link, $depth - 1);
			}
		}

		// TODO : crawl deeper?
	}

	protected function _doCrawl($url, $depth) {
	  $fetchList = array('p1' => array(), 'p2' => array(), 'p3' => array());

	  if (isset($this->seen[$url]) || $depth === 0 || $this->limit === 0) {
	    return $fetchList;
	  }

	  $this->seen[$url] = true;

	  $dom = new DOMDocument('1.0');
	  $cacheFile = $this->cacheDir.DS.md5($url).".html";
	  if (file_exists($cacheFile)) {
	  	@$dom->loadHTMLFile($cacheFile);
	  }
	  else {
	  	@$dom->loadHTMLFile($url);

	  	if (file_exists($this->cacheDir)) {
	  		$dom->save($cacheFile);
	  	}
	  }

	  $this->log("Fetched $url", 'debug');

	  // Generate fetch list
	  $anchors = $dom->getElementsByTagName('a');

	  foreach($anchors as $element ) {
	    $href = $element->getAttribute('href');
	    $href = removeTail($href, "#");
	    // $href = removeTail($href, "?");

	    $this->log("$href ".$this->tld, 'info');

	    if (!startsWith($href, 'http')) {
	      $path = '/' . ltrim($href, '/');
	      $href = http_build_url($url, array ('path' => $path));
	    } // if

	    if (strContains($href, $this->tld)) {
	    	if (strContainsAny($href, $this->badWords)) {
	    		continue;
	    	}

	    	$this->outlinks[$href] = true;

	    	if (strContainsAny($href, $this->p1words)) {
	    		array_push($fetchList['p1'], $href);
	    	}
	    	else if (strContainsAny($href, $this->p2words)) {
	    		array_push($fetchList['p2'], $href);
	    	}
	    	else {
	    		array_push($fetchList['p3'], $href);
	    	}
	    }
	  } // foreach

	  --$this->limit;

	  return $fetchList;
	}
}
