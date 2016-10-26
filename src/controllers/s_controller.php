<?php

App::import('Vendor', 'qp');
App::import('Lib', 'indexer_query');

// const CHINESE_SPLIT_PATTERN = "[:alnum:]+|\\s+|[，；。：！？]";

class SController extends AppController
{
    var $name = 'S';
    var $uses = array();
    var $solrUrlBase = "http://master:8983/solr";
    var $solrCollection = "information_native_0724";
    var $providers = ['warpspeed', 'baidu'];

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('*');
    }

    public function index()
    {
    	// Cache::clear();

    	/**
    	 * Query words
    	 * */
    	$w = "";
    	if (isset($this->params['url']['w'])) {
    		$w = $this->params['url']['w'];
    	}

    	/**
    	 * Output format, html or json
    	 * */
    	$fmt = "html";
    	if (isset($this->params['url']['fmt'])) {
    		$fmt = $this->params['url']['fmt'];
    	}

    	/**
    	 * Request Handler, browse or select
    	 * */
    	$rh = "browse";
    	if (isset($this->params['url']['rh'])) {
    	    $fmt = $this->params['url']['rh'];
    	}

    	$provider = "mashup";
    	if (isset($this->params['url']['prd'])) {
    	    $provider = $this->params['url']['prd'];
    	}

    	/**
    	 * Solr collection
    	 * */
    	if (isset($this->params['url']['sc'])) {
    	    $this->solrCollection = $this->params['url']['sc'];
    	}
    	$sc = $this->solrCollection;

    	$page = 1;
    	if (isset($this->params['named']['page'])) {
    	    $page = $this->params['named']['page'];
    	}
    	$limit = 20;
    	if (isset($this->params['named']['limit'])) {
    	    $limit = $this->params['named']['limit'];
    	}

    	$queryer = new IndexQuery($this->solrUrlBase, $this->solrCollection);
    	$queryResult = $queryer->query($w, "", ($page - 1) * $limit, $limit, $provider);

        /**
         * All status :
         * success
         * */
        $docs = $queryResult['docs'];

        if ($fmt == "json") {
            $header = [
                    'status' => 'success',
                    'qtime' => 0
            ];

    		$this->autoRender = false;
        	echo json_encode($docs, JSON_UNESCAPED_UNICODE);
        }
        else {
            $header = $queryResult['header']['warpspeed'];
            $expression = $queryResult['expression'];
            $providers = $this->providers;

            $this->paginate($page, $limit, $header['count'], $header['numFound'], ['limit' => $limit]);
        	$this->set(compact('header', 'docs', 'w', 'sc', 'providers'));
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
}
