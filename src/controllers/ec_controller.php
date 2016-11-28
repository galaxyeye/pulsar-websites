<?php

App::import('Vendor', 'qp');
App::import('Lib', 'indexer_query');

// const CHINESE_SPLIT_PATTERN = "[:alnum:]+|\s+|[，；。：！？]";

class EcController extends AppController
{
    var $name = 'Ec';
    var $uses = array();
    var $solrUrlBase = "http://master:8983/solr";
    var $solrCollection = "ec_0901";
    var $providers = ['warpspeed', 'baidu'];

    /**
     * @var HttpClient
     * */
    var $httpClient;

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('*');

        $this->httpClient = new HttpClient();
    }

    public function index()
    {
    	// Cache::clear();

        /**
         * Output format, html or json
         * */
        $fmt = "html";
        if (isset($this->params['url']['fmt'])) {
            $fmt = $this->params['url']['fmt'];
        }

    	/**
    	 * Query words
    	 * */
    	$w = "";
    	if (isset($this->params['url']['w'])) {
    		$w = $this->params['url']['w'];
    	}
    	else if (isset($this->params['url']['sentences'])) {
    	    $w = $this->params['url']['sentences'];
    	    $fmt = "json";
    	}

    	/**
    	 * Request Handler, browse or select
    	 * */
    	$rh = "browse";
    	if (isset($this->params['url']['rh'])) {
    	    $rh = $this->params['url']['rh'];
    	}

    	/**
    	 * Solr collection
    	 * */
    	if (isset($this->params['url']['sc'])) {
    	    $this->solrCollection = $this->params['url']['sc'];
    	}
    	$sc = $this->solrCollection;

		$fmt = "html";
    	if (isset($this->params['url']['fmt'])) {
    	    $fmt = $this->params['url']['fmt'];
    	}

    	/**
    	 * Debug Query
    	 * */
    	$debugQuery = 'off';
    	if (isset($this->params['url']['debugQuery'])) {
    	    $debugQuery = $this->params['url']['debugQuery'];
    	}

    	$provider = "warpspeed";
    	if (isset($this->params['url']['prd'])) {
    	    $provider = $this->params['url']['prd'];
    	}

    	$page = 1;
    	if (isset($this->params['named']['page'])) {
    	    $page = $this->params['named']['page'];
    	}
    	$limit = 20;
    	if (isset($this->params['named']['limit'])) {
    	    $limit = $this->params['named']['limit'];
    	}

		$startTime = null;
		if (isset($this->params['url']['startTime'])) {
			$startTime = $this->params['url']['startTime'];
		}

		$endTime = null;
		if (isset($this->params['url']['endTime'])) {
			$endTime = $this->params['url']['endTime'];
		}

		$startPrice = 0;
		if (isset($this->params['url']['startPrice'])) {
			$startPrice = $this->params['url']['startPrice'];
		}

		$endPrice = null;
		if (isset($this->params['url']['endPrice'])) {
			$endPrice = $this->params['url']['endPrice'];
		}

		// TODO : user array_merge
    	// $params = array_merge($params, $this->params['named'], $this->params['url']);

        $defaultQueryResult = [
    	   'header' => [
    	       'warpspeed' => [
    	           'numFound' => 0,
    	               'count' => 0,
    	               'request' => [
    	               'url' => ''
    	               ]
                ],
    	        'baidu' => [
    	           'numFound' => 0,
    	           'count' => 0,
    	           'request' => [
    	               'url' => ''
    	           ]
                ]
            ],
            'expression' => $w,
    	    'docs' => []
    	];

		if ($startTime != null && $endTime != null) {
			$w .= " AND last_modified:[{$startTime}T00:00:00Z TO {$endTime}T00:00:00Z]";
		}

		if ($startPrice != null && $endPrice != null) {
			$w .= " AND price:[$startPrice TO $endPrice]";
		}

		$pos = strpos($w, " AND ");
		if ($pos !== -1) {
			$w = substr($w, strlen(" AND "));
		}

    	$queryResult = $this->query($w, ($page - 1) * $limit, $limit, $debugQuery, $provider);

        /**
         * All status :
         * success
         * */
        $docs = $queryResult['results'];

        if ($fmt == "json") {
    		$this->autoRender = false;
        	$result = json_encode($docs, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
			echo "<pre>$result</pre>";
        }
		else if ($fmt == "php") {
			$this->autoRender = false;
			echo "<pre>";
			print_r($docs);
			echo "</pre>";
		}
        else {
            $header = $queryResult['header'];
            $providers = $this->providers;

            $options = [];
            $parts = explode('?', $_SERVER['REQUEST_URI'], 2);
            if (count($parts) == 2) {
                $options['?'] = $parts[1];
            }

            $options['limit'] = $limit;
            $this->paginate($page, $limit, $header['count'], $header['numFound'], $options);
        	$this->set(compact('header', 'docs', 'w', 'sc', 'debugQuery', 'providers'));
        }
    }

    /**
     * Override the default paginate
     * */
    public function paginate($page, $limit, $current, $count, $options) {
        $pageCount = intval(ceil($count / $limit));

        $paging = array(
                'page'		=> $page,
                'current'	=> $current,
                'count'		=> $count,
                'prevPage'	=> ($page > 1),
                'nextPage'	=> ($count > ($page * $limit)),
                'pageCount'	=> $pageCount,
                'options'	=> $options,
                'defaults' => []
        );
        $this->params['paging']["MonitorTasks"] = $paging;

        if (!in_array('Paginator', $this->helpers) && !array_key_exists('Paginator', $this->helpers)) {
            $this->helpers[] = 'Paginator';
        }
    }

    public function query($expression, $start = 0, $rows = 30, $startTime = null, $endTime = null, $debugQuery = 'off', $provider = null) {
		$searchResults = Cache::read($expression, "minute");
		if (true || $searchResults) {
			$solrClient = new \Solr\SolrClient($this->solrUrlBase, $this->solrCollection);
			$searchResults = $solrClient->queryProduct($expression, $start, $rows, $startTime, $endTime, $debugQuery);

			Cache::write($expression, $searchResults, "minute");
		}

    	return $searchResults;
    }
}
