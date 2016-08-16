<?php

namespace Solr;

/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 16-8-16
 * Time: 下午4:05
 */
class SolrClient
{
    private $solrUrlBase;

    private $params = [
        'debugQuery' => 'on',
        'hl' => 'on',
        'indent' => 'on',
        'start' => 0,
        'rows' => 20,
        'wt' => 'json'
    ];

    /**
     * @var HttpClient
     * */
    private $httpClient;

    public function __construct($solrUrlBase) {
        $this->solrUrlBase = $solrUrlBase;
        $this->httpClient = new \HttpClient();
    }

    /**
     * @param $q string Query String
     * @return array
     * */
    public function browse($q)
    {
        $url = $this->solrUrlBase;
        $url .= "browse?debugQuery=on&hl=on&indent=on&rows=20&start=0&wt=json";
        $url .= "&q=".urlencode($q);

        $json = $this->httpClient->get_content($url);
        $response = json_decode($json, true);

        $results = [];
        foreach ($response['response']['docs'] as $doc) {
            $id = $doc['id'];
            $highlighting = $response['highlighting'][$id];
            $shortContent = implode("。", $highlighting['content']);
            $shortContent = str_replace(["<b>", "</b>"], ["<em>", "</em>"], $shortContent);

            $result = [
                'id' => $id,
                'provider' => 'warpspeed',
                'sentence' => $response['responseHeader']['params']['q'],
                'domain' => $doc['domain'],
                'url' => $doc['url'],
                'title' => isset($doc['title'][0]) ? $doc['title'][0] : "",
                'content' => $doc['content'][0],
                'shortContent' => $shortContent,
                'quickView' => $doc['url']
            ];

            $results[] = $result;
        }
        
        return $results;
    }
}
