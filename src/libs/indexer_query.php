<?php 

App::import('Lib', ['solr/solr_client', 'meta_search/meta_searcher']);

use MetaSearch\MetaSearcher;
use Solr\SolrClient;

class IndexQuery {
    
    var $solrUrlBase;
    var $solrCollection;

    public function __construct($solrUrlBase, $solrCollection) {
        $this->solrUrlBase = $solrUrlBase;
        $this->solrCollection = $solrCollection;
    }

    public function query($expression, $highlightWords = "", $start = 0, $rows = 30, $debugQuery, $provider = null) {
        $searchResults = [];
        $startTime = time();

        $header = [
                'baidu' => ['numFound' => 0, 'count' => 0, 'request' => ['url' => '']],
                'warpspeed' => ['numFound' => 0, 'count' => 0, 'request' => ['url' => '']]
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
                $searchResults = $solrClient->browse($expression, $highlightWords, $start, $rows, $debugQuery);
    
                $header["warpspeed"] = $searchResults['header'];
                $searchResults = $searchResults['results'];
            }
            else {
                $solrClient = new \Solr\SolrClient($this->solrUrlBase, $this->solrCollection);
                $r = $solrClient->browse($expression, $highlightWords, $start, $rows, $debugQuery);
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

        return ['header' => $header, 'docs' => $docs, 'expression' => $expression, 'searchWord' => $searchWord];
    }
}
