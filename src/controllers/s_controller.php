<?php

App::import('Vendor', 'qp');
App::import('Lib', ['solr/solr_client', 'meta_search/meta_searcher']);

use MetaSearch\MetaSearcher;
use Solr\SolrClient;

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
    	    $src = $this->params['url']['prd'];
    	}

    	/**
    	 * Solr collection
    	 * */
    	if (isset($this->params['url']['solrCollection'])) {
    	    $this->solrCollection = $this->params['url']['solrCollection'];
    	}

    	$page = 1;
    	if (isset($this->params['named']['page'])) {
    	    $page = $this->params['named']['page'];
    	}
    	$limit = 20;
    	if (isset($this->params['named']['limit'])) {
    	    $limit = $this->params['named']['limit'];
    	}

    	$queryResult = $this->query($w, ($page - 1) * $limit, $limit, $provider);

        /**
         * All status :
         * success
         * */
        $docs = $queryResult['docs'];

        if ($fmt == "json") {
            $header = [
                    'status' => 'success',
                    'qtime' => $end - $start
            ];

    		$this->autoRender = false;
        	echo json_encode($docs, JSON_UNESCAPED_UNICODE);
        }
        else {
            $header = $queryResult['header']['warpspeed'];
            $expression = $queryResult['expression'];
            $providers = $this->providers;

            $this->paginate($page, $limit, $header['count'], $header['numFound'], ['limit' => $limit]);
        	$this->set(compact('header', 'docs', 'w', 'providers'));
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

    private function query($expression, $start = 0, $rows = 30, $provider = null) {
        $searchResults = [];
        $startTime = time();

        $header = [
                'baidu' => ['numFound' => 0, 'count' => 0], 
                'warpspeed' => ['numFound' => 0, 'count' => 0]
        ];

        if (!empty($expression)) {
            if ($provider == "baidu") {
                $metaSearcher = new \MetaSearch\MetaSearcher();
                $searchResults = $metaSearcher->searchBaidu($expression, $start, $rows);

                $header["baidu"] = $searchResults['header'];
                $searchResults = $searchResults['results'];
            }
            else if ($provider == "warpspeed") {
                $solrClient = new \Solr\SolrClient($this->solrUrlBase, $this->solrCollection);
                $searchResults = $solrClient->browse($expression, $start, $rows);

                $header["warpspeed"] = $searchResults['header'];
                $searchResults = $searchResults['results'];
            }
            else {
                $solrClient = new \Solr\SolrClient($this->solrUrlBase, $this->solrCollection);
                $r = $solrClient->browse($expression, $start, $rows);
                $header["warpspeed"] = $r['header'];
                $r = $r['results'];

                $metaSearcher = new \MetaSearch\MetaSearcher();
                $r2 = $metaSearcher->searchBaidu($expression, $start, $rows);
                $header["baidu"] = $r2['header'];
                $r2 = $r2['results'];

                $searchResults = array_merge($r, $r2);
            }
        }
        $endTime = time();

        $docs = $searchResults;

        return ['header' => $header, 'docs' => $docs, 'expression' => $expression];
    }
}

