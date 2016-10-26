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
    	    $fmt = $this->params['url']['rh'];
    	}

    	/**
    	 * Solr collection
    	 * */
    	if (isset($this->params['url']['sc'])) {
    	    $this->solrCollection = $this->params['url']['sc'];
    	}
    	$sc = $this->solrCollection;

    	$rh = "browse";
    	if (isset($this->params['url']['rh'])) {
    	    $fmt = $this->params['url']['rh'];
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

    	// TODO : user array_merge
    	// $params = array_merge($params, $this->params['named'], $this->params['url']);

        $queryResult = [
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
    	$queryResult = $this->query($w, ($page - 1) * $limit, $limit, $debugQuery, $provider);
		
        /**
         * All status :
         * success
         * */
        $docs = $queryResult['results'];

        if ($fmt == "json") {
    		$this->autoRender = false;
        	pr(json_encode($docs, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
        }
		else if ($fmt == "php") {
			$this->autoRender = false;
			pr($docs);
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

    public function query($expression, $start = 0, $rows = 30, $debugQuery = 'off', $provider = null) {
        $sentences = $expression;
//         $sentences = "\"".$expression."\"";
//         $sentences = str_replace([",", "，", "\s+"], ["\"+\"", "\"+\"", "\"+\""], $sentences);
		$searchResults = Cache::read($sentences, "minute");
		if (true || $searchResults) {
//		    $queryer = new IndexQuery($this->solrUrlBase, $this->solrCollection);
//		    $searchResults = $queryer->query($sentences, $start, $rows, $debugQuery, $provider);

			$solrClient = new \Solr\SolrClient($this->solrUrlBase, $this->solrCollection);
			$searchResults = $solrClient->queryProduct($expression, $start, $rows, $debugQuery);

			Cache::write($sentences, $searchResults, "minute");
		}

    	return $searchResults;
    }
}
