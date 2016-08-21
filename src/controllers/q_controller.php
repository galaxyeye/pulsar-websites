<?php

App::import('Vendor', 'qp');

const CHINESE_SPLIT_PATTERN = "[:alnum:]+|\s+|[，；。：！？]";

class QController extends AppController
{
    var $name = 'Q';
    var $uses = array();
    var $searchUrlBase = "http://master:8983/solr/novel_native_0808/";
    var $baiduUrlBase = "https://www.baidu.com/";

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

    	if (isset($this->params['url']['w'])) {
    		$w = $this->params['url']['w'];
    	}
    	else if (isset($this->params['url']['sentences'])) {
    		$w = $this->params['url']['sentences'];
    	}
    	else {
    		$w = "";
    	}

    	$fmt = "json";
    	if (isset($this->params['url']['fmt'])) {
    		$fmt = $this->params['url']['fmt'];
    	}

    	if ($fmt == "json") {
    		$this->autoRender = false;
    	}

    	$rh = "browse";
    	if (isset($this->params['url']['rh'])) {
    	    $fmt = $this->params['url']['rh'];
    	}

    	$searchResults = [];
    	$start = time();
    	if (!empty($w)) {
    	    $searchResults = $this->querySolr($w);
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
        	echo json_encode($docs, JSON_UNESCAPED_UNICODE);
        }
        else {
        	$this->set(compact('header', 'docs', 'w'));
        }
    }

    public function querySolr($w, $method = "browse") {
        $sentences = "\"".$w."\"";
        $sentences = str_replace([",", "，", "\s+"], ["\"+\"", "\"+\"", "\"+\""], $sentences);
		$searchResults = Cache::read($sentences, "minute");
		if (true || $searchResults) {
		    if ($method == "select") {
		        $searchResults = $this->searchSolrSelectAPI($sentences, $sentences);
		    }
		    else {
		        $searchResults = $this->searchSolrBrowseAPI($sentences, $sentences);
		    }
			Cache::write($sentences, $searchResults, "minute");
		}

    	return $searchResults;
    }

    public function searchBaidu($queryString, $highlights = null)
    {
        $this->autoRender = false;

        $url = $this->baiduUrlBase . "s?wd=" . $queryString;
        $html = $this->httpClient->get_content($url);

        // $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");

        $dom = htmlqp($html, null, [
            'convert_to_encoding' => 'utf-8'
        ]);

        $title = $dom->find('title')->text();

        $dom->find(".result.c-container")->each(function ($index, $item) {
            $dom2 = htmlqp($item, null, [
                'convert_to_encoding' => 'utf-8'
            ]);

            $result = [
                'sentence' => $dom2->find("h3")->text(),
                'domain' => "",
                'url' => "",
                'title' => $dom2->find("h3")->text(),
                'content' => $dom2->find(".c-abstract")->text(),
                'quickView' => $dom2->find(".c-showurl")->text(),
            ];
        });

        echo $html;
    }

    private function searchSolrBrowseAPI($queryString)
    {
        $url = $this->searchUrlBase .
                 "browse?debugQuery=on&hl=on&indent=on&rows=20&start=0&wt=json&q=" .
                 urlencode($queryString);
        $json = $this->httpClient->get_content($url);
        $response = json_decode($json, true);
        
        // pr($response['response']['docs']);
        // pr($response['highlighting']);

        $results = [];
        if (empty($response)) {
            return $results;
        }

        foreach ($response['response']['docs'] as $doc) {
            $id = $doc['id'];
            $highlighting = $response['highlighting'][$id];
            $shortContent = implode("。", $highlighting['content']);
            $shortContent = str_replace([
                    "<b>",
                    "</b>"
            ], [
                    "<em>",
                    "</em>"
            ], $shortContent);
            
            $match = false;
            if (false !== mb_strpos($shortContent, $queryString)) {
                $match = true;
            }
            
            $result = [
                    'id' => $id,
                    'sentence' => $response['responseHeader']['params']['q'],
                    'domain' => $doc['domain'],
                    'url' => $doc['url'],
                    'title' => isset($doc['title'][0]) ? $doc['title'][0] : "",
                    'content' => $doc['content'][0],
                    'shortContent' => $shortContent,
                    'quickView' => $doc['url'],
                    'match' => $match
            ];
            
            $results[] = $result;
        }
        
        return $results;
    }
    
    private function searchSolrSelectAPI($queryString, $highlights)
    {
        $url = $this->searchUrlBase . "select?indent=on&hl=on&q=" . urlencode($queryString) 
            . "&wt=json&debugQuery=on&start=0&rows=20";

        $json = $this->httpClient->get_content($url);
        // $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");

        $response = json_decode($json, true);

        $results = [];
        foreach ($response['response']['docs'] as $doc) {
            $result = [
                'sentence' => $response['responseHeader']['params']['q'],
                'domain' => $doc['domain'],
                'url' => $doc['url'],
                'title' => isset($doc['title'][0]) ? $doc['title'][0] : "",
                'content' => $doc['content'][0],
                'quickView' => $doc['url']
            ];

            // $sentence = $result['sentence'];
            $shortContent = $content = $result['content'];
            $sentences = mb_split(CHINESE_SPLIT_PATTERN, $shortContent);
            
            // $sentences = mb_split("^[[:alnum:]_-]*$", $shortContent);

            // TODO : check the converting
//            $content = htmlspecialchars($content);
//            $shortContent = htmlspecialchars($shortContent);
//            $content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8" );
//            $shortContent = mb_convert_encoding($shortContent, 'HTML-ENTITIES', "UTF-8" );

            $candidates = [];
            $totalLength = 0;
            for ($i = 1; $i < count($sentences) - 3; $i += 3) {
                $last = $sentences[$i - 1];
                $curr = $sentences[$i];
                $next = $sentences[$i + 1];

                foreach ($highlights as $highlight) {
                    if (mb_strpos($last, $highlight) || mb_strpos($curr, $highlight) || mb_strpos($next, $highlight)) {
                        $candidates[] = $last;
                        $candidates[] = $curr;
                        $candidates[] = $next;

                        $totalLength += mb_strlen($last);
                        $totalLength += mb_strlen($curr);
                        $totalLength += mb_strlen($next);
                    }
                }

                if ($totalLength > 1500) {
                    break;
                }
            }

            $shortContent = implode("，", $candidates);
            foreach ($highlights as $highlight) {
                $shortContent = str_replace($highlight, "<em>$highlight</em>", $shortContent);
            }

            $result['content'] = $content;
            $result['shortContent'] = $shortContent;

            $results[] = $result;
        }

        return $results;
    }
}
