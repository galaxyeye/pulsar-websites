<?php

namespace Solr;

\App::import('Lib', 'http_client');

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
     * @param $expression string Query String
     * @param $start int
     * @param $rows int
     * @param $debugQuery string
     * @return array
     * */
    public function queryProduct($expression, $start = 0, $rows = 20, $debugQuery = 'off')
    {
        $url = $this->solrUrlBase . '/' . $this->solrCollection . '/';

        $sort = urlencode('last_modified desc');
        $url .= "select?hl=on&indent=on&start=$start&rows=$rows&wt=json&sort=$sort&TZ=Asia/Shanghai";
        if ($debugQuery == 'on') {
            $url .= "&debugQuery=$debugQuery";
        }
        $expression = empty($expression) ? "*:*" : urlencode($expression);
        $url .= "&q=$expression%20AND%20type_s:Product";

        $json = $this->httpClient->get_content($url);
        $response = json_decode($json, true);

        $header = [
            'count' => 0,
            'numFound' => $response['response']['numFound'],
            'QTime' => $response['responseHeader']['QTime'],
            'request' => ['url' => $url]
        ];

        $results = [];
        if (empty($response)) {
            return ['header' => $header, 'results' => $results];
        }

        foreach ($response['response']['docs'] as $doc) {
            $comments = $this->queryComments($doc['url'], 0, 100, $debugQuery);
            $doc['comments'] = $comments['results'];
            $results[] = $doc;
        }

        $header['count'] = count($results);
        return ['header' => $header, 'results' => $results];
    }

    /**
     * @param $productUrl string Page url
     * @param $start int
     * @param $rows int
     * @param $debugQuery string
     * @return array
     * */
    public function queryComments($productUrl, $start = 0, $rows = 20, $debugQuery = 'off')
    {
        $url = $this->solrUrlBase . '/' . $this->solrCollection . '/';
        $url .= "browse?hl=on&indent=on&start=$start&rows=$rows&wt=json";
        if ($debugQuery == 'on') {
            $url .= "&debugQuery=$debugQuery";
        }
        $url .= "&q=url:\"".$productUrl."\"";
        $url .= "%20AND%20type_s:Comment";

        $json = $this->httpClient->get_content($url);
        $response = json_decode($json, true);

        $header = [
            'count' => 0,
            'numFound' => $response['response']['numFound'],
            'QTime' => $response['responseHeader']['QTime'],
            'request' => ['url' => $url]
        ];

        $results = [];
        if (empty($response)) {
            return ['header' => $header, 'results' => $results];
        }

        foreach ($response['response']['docs'] as $doc) {
            $results[] = $doc;
        }

        $header['count'] = count($results);
        return ['header' => $header, 'results' => $results];
    }

    public function statSolrByParameters($solrParams = null) {
        $urlBase = $this->solrUrlBase . '/' . $this->solrCollection . '/';

        $defaultSolrParams = [
            'fl' => "id",
            // There is a bug while extracting publish_time
            'sort' => urlencode('publish_time desc,last_crawl_time desc'),
            'hl' => 'on',
            'indent' => 'on',
            'wt' => 'json',
            'TZ' => CURRENT_TIME_ZONE,
            'debugQuery' => null
        ];

        if ($solrParams != null) {
            $solrParams = array_merge($defaultSolrParams, $solrParams);
        }
        else {
            $solrParams = $defaultSolrParams;
        }

        $queryParams = "";
        foreach ($solrParams as $k => $v) {
            if (!empty($v)) {
                $queryParams .= "$k=$v&";
            }
        }
        $queryUrl = $urlBase."query?$queryParams";

        $response = $this->httpClient->get_content($queryUrl);
        $result = json_decode($response, true);
        $result['header'] = ['request' => [
            'url' => urldecode($queryUrl)
        ]];

        return $result;
    }

    public function querySolrByParameters($solrParams = null, $highlightWords = "", $queryHandler = "browse") {
        $urlBase = $this->solrUrlBase . '/' . $this->solrCollection . '/';

        $defaultSolrParams = [
            'fl' => "id,url,title,article_title,html_content,domain,host,site_name,reference,encoding,resource_category,author,director,last_crawl_time,publish_time",
            'start' => 0,
            'rows' => 40,
            'sort' => urlencode('publish_time desc,last_crawl_time desc'),
            'hl' => 'on',
            'indent' => 'on',
            'wt' => 'json',
            'TZ' => CURRENT_TIME_ZONE,
            'debugQuery' => null
        ];

        if ($solrParams != null) {
            $solrParams = array_merge($defaultSolrParams, $solrParams);
        }
        else {
            $solrParams = $defaultSolrParams;
        }

        $queryParams = "";
        foreach ($solrParams as $k => $v) {
            if (!empty($v)) {
                $queryParams .= "$k=$v&";
            }
        }

        $queryUrl = $urlBase."$queryHandler?$queryParams";

        $json = $this->httpClient->get_content($queryUrl);
        $response = json_decode($json, true);
        $response = $this->convertResult($queryUrl, $response, $highlightWords);

        return $response;
    }

    /**
     * @param $query string Query String
     * @param $highlightWords string search word to highlight
     * @param $start int
     * @param $rows int
     * @param $debugQuery string
     * @return array
     * */
    public function browse($query, $highlightWords = "", $start = 0, $rows = 20, $debugQuery = 'off')
    {
        $solrParams = [
            'start' => $start,
            'rows' => $rows,
            'debugQuery' => $debugQuery == 'on' ? 'on' : null,
            'q' => $query
        ];

        return $this->querySolrByParameters($solrParams, $highlightWords);
    }

    private function getContent($doc) {
        $content = "";
        if (isset($doc['html_content'])) {
            $content = $doc['html_content'];
        }
        else if (isset($doc['text'])) {
            $content = $doc['text'];
        }

        return $content;
    }

    private function getTitle($doc, $highlighting) {
        $title = "";
        if (isset($highlighting['title'])) {
            $title = implode("|", $highlighting['title']);
        }
        else if (isset($doc['article_title'][0])) {
            $title = $doc['article_title'][0];
        }
        else if (isset($doc['title'][0])) {
            $title = $doc['title'][0];
        }

        if (mb_strlen($title) > 200) {
            $title = mb_substr($title, 0, 200);
        }

        if (empty($title)) {
            $textContent = strip_tags($doc['html_content']);
            // Find the first Chinese character in the string
            for ($i = 0; $i < mb_strlen($textContent); ++$i) {
                $ch = mb_substr($textContent, $i, 1);
                if (preg_match("/[一-龥]/", $ch)) {
                    break;
                }
            }
            $title = mb_substr($textContent, $i, 40)."...";
        }

        return $title;
    }

    /**
     * @param $url {string}
     * @param $response {object}
     * @param $highlightWords {string|array}
     * @return array
     **/
    public function convertResult($url, $response, $highlightWords = "") {
        $header = [
            'count' => 0,
            'numFound' => $response['response']['numFound'],
            'QTime' => $response['responseHeader']['QTime'],
            'request' => ['url' => $url]
        ];
        $results = [];

        if (empty($url) || empty($response)) {
            return ['header' => $header, 'results' => $results];
        }

        foreach ($response['response']['docs'] as $doc) {
            $id = $doc['id'];

            $responseQ = "";
            if (isset($response['responseHeader']['params']['q'])) {
                $responseQ = $response['responseHeader']['params']['q'];
            }

            $sentiment = "中";
            if (isset($doc['sentiment_main'])) {
                $sentiment = $doc['sentiment_main'];
            }

            /** Title/Abstract/Content */
            $content = $this->getContent($doc);

            $shortContent = $content;
            $highlighting = $response['highlighting'][$id];
            if (isset($highlighting['content'])) {
                $shortContent = implode("。", $highlighting['content']);
            }

            $title = $this->getTitle($doc, $highlighting);

            $abstract = $shortContent;
            if (isset($doc['abstract'])) {
                $abstract = $doc['abstract'];
            }

            $title = $this->highlighting($highlightWords, $title);
            $content = $this->highlighting($highlightWords, $content);
            $shortContent = $this->highlighting($highlightWords, $shortContent);
            $abstract = $this->highlighting($highlightWords, $abstract);

            /** Author */
            // Fix author extraction bug, and further more, we can have a name/姓氏 list
            $author = "";
            if (isset($doc['author'])) {
                $author .= implode(",", $doc['author']);
            }
            if (isset($doc['director'])) {
                $author .= implode(",", $doc['director']);
            }

            /** Date time */
            $lastCrawlTime = new \DateTime($doc['last_crawl_time'], new \DateTimeZone('UTC'));
            $lastCrawlTime->setTimezone(new \DateTimeZone(CURRENT_TIME_ZONE));
            $publishTime = $lastCrawlTime;
            $publishTimeStr = date_format($publishTime, 'Y-m-d');
            if (isset($doc['publish_time'])) {
                $publishTime = new \DateTime($doc['publish_time'], new \DateTimeZone('UTC'));
                $publishTime ->setTimezone(new \DateTimeZone(CURRENT_TIME_ZONE));
                $publishTimeStr = date_format($publishTime, 'Y-m-d H:i:s');
            }

            /** Site/Host/Domain */
            $sourceSite = "";
            if (isset($doc['reference'])) {
                $sourceSite = $doc['reference'];
            }
            else if (isset($doc['host'])) {
                $sourceSite = $doc['host'];
            }

            $siteName = $doc['host'];
            if (isset($doc['site_name'])) {
                $siteName = $doc['site_name'];
            }

            $result = [
                'provider' => 'warpspeed',
                'sentence' => $responseQ,

                'id' => $id,
                'solr_id' => $id,

                'url' => $doc['url'],

                'last_crawl_time' => $lastCrawlTime,
                'publish_time' => $publishTime,
                'publish_time_str' => $publishTimeStr,

                'domain' => $doc['domain'],
                'site_name' => $siteName,
                'source_site' => $sourceSite,

                'title' => $title,
                'content' => $content,
                'html_content' => $content,
                'shortContent' => $shortContent,
                'sentiment' => $sentiment,

                'original_url' => $doc['url'],
                'author' => $author,

                'abstract' => $abstract
            ];

            $results[] = $result;
        }

        $header['count'] = count($results);
        return ['header' => $header, 'results' => $results];
    }

    private function highlighting($highlightWords, $text) {
        if (!is_array($highlightWords)) {
            $highlightWords = [$highlightWords];
        }

        foreach ($highlightWords as $highlightWord) {
            if (!empty($highlightWord)) {
                $text = str_replace($highlightWord, "<em>".$highlightWord."</em>", $text);
            }
            $text = str_replace(["<b>", "</b>"], ["<em>", "</em>"], $text);
        }
        return $text;
    }
}
