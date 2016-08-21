<?php

/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 16-8-16
 * Time: 下午5:18
 */

namespace MetaSearch;

\App::import('Lib', 'http_client');
\App::import('Vendor', 'qp');

class MetaSearcher {
    private $baiduUrlBase = "https://www.baidu.com/";

    public function searchBaidu($queryString, $start = 0) {
        $url = $this->baiduUrlBase . "s?"
                ."wd=" . urlencode($queryString)
                ."pn=" . $start;

        $httpClient = new \HttpClient();
        $html = $httpClient->get_content($url);

        // $html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");

        $qp = htmlqp($html, null, [
            'convert_to_encoding' => 'utf-8'
        ]);

        $header = [];
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

        $header['count'] = count($results);
        return ['header' => $header, 'results' => $results];
    }
}
