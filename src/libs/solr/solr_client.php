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
    /**
     * @var string
     * */
    private $solrUrlBase;
    
    /**
     * @var string
     * */
    private $solrCollection;

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

    public function __construct($solrUrlBase, $solrCollection) {
        $this->solrUrlBase = $solrUrlBase;
        $this->solrCollection = $solrCollection;
        $this->httpClient = new \HttpClient();
    }

    /**
     * @param $q string Query String
     * @return array
     * */
    public function browse($expression, $start = 0, $rows = 20)
    {
        $url = $this->solrUrlBase . '/' . $this->solrCollection . '/';
        $url .= "browse?debugQuery=on&hl=on&indent=on&start=$start&rows=$rows&wt=json";
        $url .= "&q=".urlencode($expression);

        $json = $this->httpClient->get_content($url);
        $response = json_decode($json, true);

//         pr($url);
//         pr($response);
//         die();

        $header = [
            'numFound' => $response['response']['numFound'],
            'QTime' => $response['responseHeader']['QTime']
        ];

        $results = [];
        if (empty($response)) {
            return ['header' => $header, 'results' => $results];
        }

        foreach ($response['response']['docs'] as $doc) {
            $id = $doc['id'];

            $highlighting = $response['highlighting'][$id];

            $title = implode("|", $highlighting['title']);
            $title = str_replace(["<b>", "</b>"], ["<em>", "</em>"], $title);

            $shortContent = implode("。", $highlighting['content']);
            $shortContent = str_replace(["<b>", "</b>"], ["<em>", "</em>"], $shortContent);

            $result = [
                'id' => $id,
                'provider' => 'warpspeed',
                'sentence' => $response['responseHeader']['params']['q'],
                'domain' => $doc['domain'],
                'url' => $doc['url'],
                'title' => $title,
                'content' => $doc['content'][0],
                'shortContent' => $shortContent,
                'quickView' => $doc['url']
            ];

            $results[] = $result;
        }

        $header['count'] = count($results);
        return ['header' => $header, 'results' => $results];
    }
}
