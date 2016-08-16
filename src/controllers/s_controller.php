<?php

App::import('Vendor', 'qp');
App::import('Lib', 'solr/solr_client');

// const CHINESE_SPLIT_PATTERN = "[:alnum:]+|\\s+|[，；。：！？]";

class SController extends AppController
{
    var $name = 'S';
    var $uses = array();
    var $searchUrlBase = "http://master:8983/solr/information_native_0724/";
    var $baiduUrlBase = "https://www.baidu.com/";

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

    	$searchResults = [];
    	$start = time();
    	if (!empty($w)) {
    	    if ($provider == "baidu") {
    	        $searchResults = $this->queryBaidu($w);
    	    }
    	    else if ($provider == "warpspeed") {
                $solrClient = new Solr\SolrClient($this->searchUrlBase);
                $searchResults = $solrClient->browse($w);
    	    }
            else {
                $solrClient = new Solr\SolrClient($this->searchUrlBase);

                $r = $solrClient->browse($w);
                $r2 = $this->queryBaidu($w);

                $searchResults = array_merge($r, $r2);
            }
    	}
        $end = time();

        /**
         * All status :
         * success
         * */
        $header = [
            'status' => 'success',
            'qtime' => $end - $start
        ];
        $docs = $searchResults;

        if ($fmt == "json") {
    		$this->autoRender = false;
        	echo json_encode($docs, JSON_UNESCAPED_UNICODE);
        }
        else {
        	$this->set(compact('header', 'docs', 'w'));
        }
    }

    public function queryBaidu($queryString)
    {
        $url = $this->baiduUrlBase . "s?wd=" . urlencode($queryString);
        $httpClient = new HttpClient();
        $html = $httpClient->get_content($url);

        // $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");

        $qp = htmlqp($html, null, [
            'convert_to_encoding' => 'utf-8'
        ]);

        $results = [];
        foreach($qp->find(".result.c-container") as $item) {
//            $itemQP = htmlqp($item, null, [
//                'convert_to_encoding' => 'utf-8'
//            ]);
            $itemQP = htmlqp($item);

            $url = $itemQP->find(".c-showurl")->text();
            // $url = preg_replace("/[^A-Za-z0-9 \\.]/", '', $url);
            // TODO : there is an unknown non-printable character at the end of url
            $url = preg_replace("/[^A-Za-z0-9 \\.]/", '', $url);

            if (false == strpos($url, "http")) {
                $url = "http://".$url;
            }

            $result = [
                'provider' => 'baidu',
                'sentence' => $itemQP->find("h3")->text(),
                'domain' => "",
                'url' => $url,
                'title' => $itemQP->find("h3")->innerHTML(),
                'content' => $itemQP->find(".c-abstract")->innerHTML(),
                'quickView' => $itemQP->find(".c-showurl")->innerHTML(),
            ];

            if (!empty($result['title']) && !empty($result['content'])) {
                $result['shortContent'] = $result['content'];
                $results[] = $result;
            }
        };

        return $results;
    }
}
