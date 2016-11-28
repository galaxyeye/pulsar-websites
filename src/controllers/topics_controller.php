<?php

App::import('Lib', ['solr/solr_client', 'meta_search/meta_searcher']);

const DEFAULT_PROVIDER = 'warpspeed';

class TopicsController extends AppController
{
    var $name = 'Topics';

    public $providers = ['warpspeed', 'baidu'];
    private $solrUrlBase = SOLR_URL_BASE;
    private $solrCollection = SOLR_COLLECTION;

    private $defaultTimeField = "publish_time";
    // private $defaultTimeField = "last_crawl_time";

    private $defaultDoc = [
        'id' => '',
        'solr_id' => '',
        'alert' => '',
        'sentiment' => '中',
        'title' => '',
        'shortContent' => '',
        'publish_time' => '',
        'author' => '',
        'source_site' => '',
        'similar_data' => '',
        'click_forward' => '',
        'comment_count' => '',
        'provider' => DEFAULT_PROVIDER
    ];

    private $dummyDoc = [
        'id' => 'xxx',
        'solr_id' => 'xxx',
        'alert' => '',
        'sentiment' => '中',
        'title' => 'title',
        'shortContent' => 'shortContent',
        'publish_time' => '1970-01-01 00:00:00',
        'author' => 'author',
        'source_site' => 'source_site',
        'similar_data' => 'similar_data',
        'click_forward' => 'click_forward',
        'comment_count' => 'comment_count',
        'provider' => DEFAULT_PROVIDER
    ];

    private $dummyQueryResult = [
        'header' => ['warpspeed' => [
            'count' => 0,
            'numFound' => 0,
            'request' => ['url' => '']
        ]
        ],
        'docs' => [
            [], [], [], []
        ],
        'q' => ''
    ];

    /**
     * @var HttpClient
     * */
    private $httpClient;

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->httpClient = new \HttpClient();
    }

    function u_index()
    {
        $this->Topic->recursive = 0;
        $this->set('topics', parent::paginate());
    }

    function u_view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid topic', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('topic', $this->Topic->read(null, $id));
    }

    function u_quickView($id, $encodedUrl = null)
    {
        global $defaultTopic;
        $topic = $defaultTopic;
        if ($id) {
            $topic = $this->Topic->read(null, $id);
        }

        $highlightWords = $this->getHighlightWords($topic['Topic']['expression']);

        $docId = symmetric_decode($encodedUrl);
        $params = [
            'q' => urlencode("id:$docId"),
            'rows' => 1
        ];
        $queryResult = $this->querySolrByParameters($params, $highlightWords);
        $solrUrl = $queryResult['header'][DEFAULT_PROVIDER]['request']['url'];

        if (empty($queryResult['docs'])) {
            echo "404 Not found";
            die();
        }

        $doc = $queryResult['docs'][0];
        $this->set(compact('topic', 'doc', 'solrUrl'));
    }

    function u_add()
    {
        if (!empty($this->data)) {
            $this->Topic->create();
            if ($this->Topic->save($this->data)) {
                $this->Session->setFlash(__('The topic has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The topic could not be saved. Please, try again.', true));
            }
        }
        $users = $this->Topic->User->find('list');
        $this->set(compact('users'));
    }

    function u_edit($id = null)
    {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid topic', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Topic->save($this->data)) {
                $this->Session->setFlash(__('The topic has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The topic could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Topic->read(null, $id);
        }
        $users = $this->Topic->User->find('list');
        $this->set(compact('users'));
    }

    function u_edit2($id = null)
    {
    }

    function u_mark($topicId, $solrId, $markName, $markValue)
    {
        $this->loadModel("MonitorRecord");
        $monitorRecord = $this->MonitorRecord->find("first", ['condition' => [
            'topic_id' => $topicId,
            'solrId' => $solrId
        ]]);

        $monitorRecordId = $monitorRecord['MonitorRecord']['id'];

        $data = [
            'topic_id' => $topicId,
            'solrId' => $solrId,
            $markName => $markValue
        ];

        if (!empty($monitorRecordId)) {
            $data['id'] = $monitorRecordId;
        }

        $this->MonitorRecord->save($data);
    }

    function u_delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for topic', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Topic->delete($id)) {
            $this->Session->setFlash(__('Topic deleted', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Topic was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }

    public function u_monitor($id = null)
    {
        /** Get topic list */
        $this->Topic->recursive = -1;
        // $topics = parent::paginate();
        $topics = $this->Topic->find('all');

        $this->set(compact('topics'));

        /** Common parameters */
        $commonParams = $this->getCommonParams($id);

        /** Query solr */
        $expression = $commonParams['expression'];
        $solrParams = $commonParams['solrParams'];
        $highlightWords = $this->getHighlightWords($expression);
        $queryResult = $this->querySolrByParameters($solrParams, $highlightWords);

        // $queryResult = $this->marshupQuery($expression, $highlightWords, ($page - 1) * $limit, $limit, $provider);

        // $queryResult = $this->dummyQueryResult;

        /** Convert query result */
        $header = $queryResult['header'][DEFAULT_PROVIDER];
        $docs = $queryResult['docs'];
        foreach ($docs as &$doc) {
            $doc = array_merge($this->defaultDoc, $doc);
        }
        $q = $queryResult['q'];
        $providers = $this->providers;

        /** Generate view variables */
        $topic = $commonParams['topic'];            // topic data model
        $page = $commonParams['page'];              // page number
        $limit = $commonParams['limit'];            // number per page
        $this->paginate($page, $limit, $header['count'], $header['numFound'], ['limit' => $limit]);
        $this->set(compact('topic', 'header', 'docs', 'q', 'providers', 'id'));
    }

    public function u_stat($id = null)
    {
        $this->Topic->recursive = -1;
        $topics = parent::paginate();

        $this->set(compact('topics'));

        global $defaultTopic;
        $topic = $defaultTopic;
        if ($id) {
            $topic = $this->Topic->read(null, $id);
        }

        $this->set(compact('topic', 'id'));
    }

    /**
     * TODO : publish_time
     * @param $id
     * @param $format
     * @return string|object
     * */
    public function u_statTrends($id = null, $format = "php")
    {
        $fl = $this->defaultTimeField;
        $defaultSolrParams = [
            "fl" => $fl,
            "facet" => "true",
            "facet.range" => $fl,
            "facet.range.start" => "NOW/MONTH",
            "facet.range.end" => "NOW",
            "facet.range.gap" => "%2B1DAY",
            "group" => "true",
            "group.limit" => 1,
            "group.func" => "rint(div(ms($fl),mul(24,3600000)))"
        ];

        $commonParams = $this->getCommonParams($id);
        $solrParamQ = $commonParams['solrParamQ'];
        $solrParams = array_merge($defaultSolrParams, $commonParams['solrParams']);

        /** Calculate facet.range */
        $dateRange = $commonParams['dateRange'];
        if (isset($dateRange['startTime'])) {
            $solrParams['facet.range.start'] = $dateRange['startTime'];
        }
        if (isset($dateRange['endTime'])) {
            $solrParams['facet.range.end'] = $dateRange['endTime'];
        }

        /** Calculate date gap unit */
        $dateGapUnit = 'DAY';
        $startTime = $solrParams['facet.range.start'];
        $endTime = $solrParams['facet.range.end'];
        if ($startTime == 'NOW/DAY' || ($startTime == 'NOW/DAY-1DAY' && $endTime == 'NOW/DAY')) {
            $dateGapUnit = 'HOUR';
        }
        $solrParams['facet.range.gap'] = "%2B1$dateGapUnit";

        $result = $this->statCommon($id, $solrParamQ, $solrParams, $commonParams);

        $xAxis = [
            "type" => 'category',
            "boundaryGap" => "false",
            "data" => []
        ];

        $series = [];

        $searchResults = $result['searchResults'];
        $searchResults['grouped'] = "ignored";
        $data = $searchResults['facet_counts']['facet_ranges'][$fl]['counts'];

        $serial = [
            'name' => '统计',
            'type' => 'line',
            'smooth' => 'true',
            'itemStyle' => ['normal' => ['label' => ['show' => 'true']]],
            'data' => []
        ];

        for ($i = 0; $i < count($data); $i += 2) {
            $date = date_create($data[$i], new DateTimeZone('UTC'));
            date_timezone_set($date, new DateTimeZone(CURRENT_TIME_ZONE));
            $date = date_parse(date_format($date, 'Y-m-d H:i:s'));

            array_push($xAxis['data'], $date[strtolower($dateGapUnit)]);
            array_push($serial['data'], $data[$i + 1]);
        }

        array_push($series, $serial);
        $result['xAxis'] = $xAxis;
        $result['series'] = $series;
        $result['header'] = $result['searchResults']['header'];

        if ($format == 'php') {
            return $result;
        }
        else if ($format == 'json') {
            $this->autoRender = false;
            return json_encode($result);
        }
    }

    public function u_statMediaDistribution($id = null, $format = "php") {
        $fl = $this->defaultTimeField;
        $defaultSolrParams = [
            "fl" => $fl,
            "group" => "true",
            "group.limit" => 1,
            "group.field" => "resource_category"
        ];

        $commonParams = $this->getCommonParams($id);
        $solrParamQ = $commonParams['solrParamQ'];
        $solrParams = array_merge($defaultSolrParams, $commonParams['solrParams']);

        $result = $this->statCommon($id, $solrParamQ, $solrParams, $commonParams);

        $groups = $result['searchResults']['grouped']['resource_category']['groups'];

        $series = [
            [
                'name' => '资源类型分布',
                'type' => 'pie',
                'radius' => '55%',
                'center' => ['50%', '50%'],
                'itemStyle' => [
                    'emphasis' => [
                        'shadowBlur' => 10,
                        'shadowOffsetX' => 0,
                        'shadowColor' => 'rgba(0, 0, 0, 0.5)'
                    ]
                ],
                'data' => [
                    ['value' => 0, 'name' => '微博'],
                    ['value' => 0, 'name' => '博客'],
                    ['value' => 0, 'name' => '资讯'],
                    ['value' => 0, 'name' => '论坛'],
                    ['value' => 0, 'name' => '贴吧']
                ]
            ]
        ];

        foreach ($groups as $group) {
            foreach ($series[0]['data'] as &$item) {
                if ($item['name'] == $group['groupValue']) {
                    $item['value'] = $group['doclist']['numFound'];
                }
            }
        }

        $result['series'] = $series;

        if ($format == 'php') {
            return $result;
        }
        else if ($format == 'json') {
            $this->autoRender = false;
            return json_encode($result);
        }
    }

    public function u_statTrendsGroupByMedia($id = null, $format = "php") {
        $fl = $this->defaultTimeField;
        global $allResourceCategories;
        $defaultSolrParams = [
            "fl" => $fl,
            "facet" => "true",
            "facet.range" => $fl,
            "facet.range.start" => "NOW/MONTH",
            "facet.range.end" => "NOW",
            "facet.range.gap" => "%2B1DAY",
            "group" => "true",
            "group.limit" => 1,
            "group.func" => "rint(div(sum(ms($fl),mul(8,3600000)),mul(24,3600000)))"
        ];

        $series = [];

        foreach ($allResourceCategories as $resourceCategory) {
            $solrParamQ = "*:*";
            $solrParams = [];

            if (isset($this->params['form']['solrParamQ'])) {
                $solrParamQ = $this->params['form']['solrParamQ'];
            }
            if (isset($this->params['form']['solrParams'])) {
                $solrParams = $this->params['form']['solrParams'];
            }

            $solrParamQ .= " AND resource_category:$resourceCategory";
            $solrParams = array_merge($defaultSolrParams, $solrParams);

            $xAxis = [
                "type" => 'category',
                "boundaryGap" => "false",
                "data" => []
            ];

            $result = $this->statCommon($id, $solrParamQ, $solrParams);

            $searchResults = $result['searchResults'];
            $searchResults['grouped'] = "ignored";
            $data = $searchResults['facet_counts']['facet_ranges'][$fl]['counts'];

            $serial = [
                'name' => $resourceCategory,
                'type' => 'line',
                'smooth' => 'true',
                'itemStyle' => ['normal' => ['label' => ['show' => 'true']]],
                'data' => []
            ];

            if (empty($xAxis['data'])) {
                for ($i = 0; $i < count($data); $i += 2) {
                    $date = date_parse($data[$i]);
                    array_push($xAxis['data'], $date['day']);
                }
            }

            for ($i = 0; $i < count($data); $i += 2) {
                array_push($serial['data'], $data[$i + 1]);
            }

            array_push($series, $serial);
        }

        $result['xAxis'] = $xAxis;
        $result['series'] = $series;

        if ($format == 'php') {
            return $result;
        }
        else if ($format == 'json') {
            $this->autoRender = false;
            return json_encode($result);
        }
    }

    public function u_statSentiment($id = null, $format = "php") {
        $fl = $this->defaultTimeField;
        $defaultSolrParams = [
            "fl" => $fl,
            "group" => "true",
            "group.limit" => 1,
            "group.field" => "sentiment_main"
        ];

        $solrParamQ = "*:*";
        $solrParams = [];
        if (isset($this->params['form']['solrParamQ'])) {
            $solrParamQ = $this->params['form']['solrParamQ'];
        }
        if (isset($this->params['form']['solrParams'])) {
            $solrParams = $this->params['form']['solrParams'];
        }

        $solrParams = array_merge($defaultSolrParams, $solrParams);

        $result = $this->statCommon($id, $solrParamQ, $solrParams);

        $groups = $result['searchResults']['grouped']['sentiment_main']['groups'];

        $series = [
            [
                'name' => '正负面统计',
                'type' => 'pie',
                'radius' => '55%',
                'center' => ['50%', '50%'],
                'itemStyle' => [
                    'emphasis' => [
                        'shadowBlur' => 10,
                        'shadowOffsetX' => 0,
                        'shadowColor' => 'rgba(0, 0, 0, 0.5)'
                    ]
                ],
                'data' => [
                    ['value' => 0, 'name' => '正面'],
                    ['value' => 0, 'name' => '负面'],
                    ['value' => 0, 'name' => '中性']
                ]
            ]
        ];

        foreach ($groups as $group) {
            foreach ($series[0]['data'] as &$item) {
                if ($item['name'] == $group['groupValue']) {
                    $item['value'] = $group['doclist']['numFound'];
                }
            }
        }

        $result['series'] = $series;

        if ($format == 'php') {
            return $result;
        }
        else if ($format == 'json') {
            $this->autoRender = false;
            return json_encode($result);
        }
    }

    public function u_statAlert($id = null, $format = "php") {
        $result = [
            'id' => $id,
            'name' => __FUNCTION__,
            'xdata' => [1,2,3,4,5],
            'ydata' => [1,2,3,4,5]
        ];

        if ($format == 'php') {
            return $result;
        }
        else if ($format == 'json') {
            $this->autoRender = false;
            return json_encode($result);
        }
    }

    public function u_statHotWords($id = null, $format = "php") {
        $result = [
            'id' => $id,
            'name' => __FUNCTION__,
            'xdata' => [1,2,3,4,5],
            'ydata' => [1,2,3,4,5]
        ];

        if ($format == 'php') {
            return $result;
        }
        else if ($format == 'json') {
            $this->autoRender = false;
            return json_encode($result);
        }
    }

    public function u_statHotEvents($id = null, $format = "php") {
        $result = [
            'id' => $id,
            'name' => __FUNCTION__,
            'xdata' => [1,2,3,4,5],
            'ydata' => [1,2,3,4,5]
        ];

        if ($format == 'php') {
            return $result;
        }
        else if ($format == 'json') {
            $this->autoRender = false;
            return json_encode($result);
        }
    }

    public function u_statTagComparation($id = null, $format = "php") {
        $result = [
            'id' => $id,
            'name' => __FUNCTION__,
            'xdata' => [1,2,3,4,5],
            'ydata' => [1,2,3,4,5]
        ];

        if ($format == 'php') {
            return $result;
        }
        else if ($format == 'json') {
            $this->autoRender = false;
            return json_encode($result);
        }
    }

    public function u_report($id = null)
    {
        $this->u_monitor($id);
    }

    public function u_browseToday($expression = null)
    {
        $fl = $this->defaultTimeField;

        $q = "$fl:[NOW-1DAY/DAY TO *]";
        if ($expression != null) {
            $q .= " AND $expression";
        }

        $solrParams['q'] = urlencode($q);

        $response = $this->querySolrByParameters($solrParams);

        $this->autoRender = false;
    }

    public function u_transmissionPath($id = null, $provider = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid topic', true));
            $this->redirect(array('action' => 'index'));
        }
        $topic = $this->Topic->read(null, $id);

        $this->set(compact('topic'));
    }

    public function u_forwardChart($id = null, $provider = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid topic', true));
            $this->redirect(array('action' => 'index'));
        }
        $topic = $this->Topic->read(null, $id);
        $this->set(compact('topic'));
    }

    /**
     * @param $page {int} current page number
     * @param $limit {int} rows per page
     * @param $current {int} result count in current page
     * @param $totalCount {int} total result count
     * @param $options {array} other options
     * @return null
     * */
    public function paginate($page, $limit, $current, $totalCount, $options)
    {
        $pageCount = intval(ceil($totalCount / $limit));
        $paging = array(
            'page' => $page,
            'current' => $current,
            'count' => $totalCount,
            'prevPage' => $page > 1 ? ($page - 1) : false,
            'nextPage' => ($totalCount > ($page * $limit)) ? ($page + 1) : false,
            'pageCount' => $pageCount,
            'options' => $options,
            'defaults' => []
        );
        $this->params['paging']["Topic"] = $paging;

        if (!in_array('Paginator', $this->helpers) && !array_key_exists('Paginator', $this->helpers)) {
            $this->helpers[] = 'Paginator';
        }
    }

    private function statCommon($id = null, $solrParamQ = "", $solrParams = [], $commonParams = null)
    {
        $this->Topic->recursive = -1;
        $topics = parent::paginate();

        $this->set(compact('topics'));

        if ($id == null) {
            $id = $topics[0]['Topic']['id'];
        }

        if ($commonParams == null) {
            $commonParams = $this->getCommonParams($id);
        }
        $topic = $commonParams['topic'];        // topic data model

        $solrClient = new \Solr\SolrClient($this->solrUrlBase, $this->solrCollection);
        $searchResults = $solrClient->statSolrByParameters($solrParams);

        return [
            'topic' => $topic,
            'solrParamQ' => $commonParams['solrParamQ'],
            'solrParams' => $commonParams['solrParams'],
            'searchResults' => $searchResults
        ];
    }

    /**
     * Get query parameters for topic
     * @param $id {int} topic id
     * @return array
     * */
    private function getCommonParams($id = null)
    {
        if (empty($id)) {
            global $defaultTopic;
            $topic = $defaultTopic;
        }
        else {
            $topic = $this->Topic->read(null, $id);
        }

        /** Limit */
        $page = 1;
        if (isset($this->params['named']['page'])) {
            $page = $this->params['named']['page'];
        }
        $limit = 40;
        if (isset($this->params['named']['limit'])) {
            $limit = $this->params['named']['limit'];
        }

        /** Expression */
        $expression = $topic['Topic']['expression'];
        if (!empty($expression) && stripos($expression, ":") === false) {
            $expression = "text:($expression)";
        }

        /** Date range */
        $dateRange = ['startTime' => 'NOW/-30DAY', 'endTime' => 'NOW'];
        if (isset($this->params['form']['dateRange'])) {
            $dateRange = $this->params['form']['dateRange'];
        }
        else if (isset($this->params['url']['dateRange'])) {
            $dateRange = $this->params['url']['dateRange'];
        }

        /** Solr q parameter */
        $solrParamQ = $this->buildSolrParamQ($expression);

        /** Solr parameters array */
        $solrParams = [];
        if (isset($this->params['form']['solrParams'])) {
            $solrParams = $this->params['form']['solrParams'];
        }
        else if (isset($this->params['url']['solrParams'])) {
            $solrParams = $this->params['url']['solrParams'];
        }
        $solrParams['q'] = urlencode($solrParamQ);
        $solrParams['rows'] = $limit;
        $solrParams['start'] = ($page - 1) * $limit;

        $commonParams = [
            'topic' => $topic,
            'page' => $page,
            'limit' => $limit,
            'expression' => $expression,
            'solrParamQ' => $solrParamQ,
            'solrParams' => $solrParams,
            'dateRange' => $dateRange,
            'q' => $solrParamQ
        ];

        return $commonParams;
    }

    private function buildSolrParamQ($expression) {
        /** Solr q parameter */
        $solrParamQ = "";
        $solrParamQArray = [];
        if (isset($this->params['form']['solrParamQ'])) {
            $solrParamQ = $this->params['form']['solrParamQ'];
        }
        else if (isset($this->params['url']['solrParamQ'])) {
            $solrParamQ = $this->params['url']['solrParamQ'];
        }

        /** Explode query string into array */
        if (is_string($solrParamQ)) {
            $params = explode("AND", $solrParamQ);
            foreach ($params as $param) {
                $param = trim($param);
                $kv = explode(':', $param);
                if (count($kv) == 2) {
                    $solrParamQArray[$kv[0]] = $kv[1];
                }
            }
        }

        /** Add some default parameters */
        if (empty($solrParamQArray['publish_time'])) {
            $solrParamQArray['publish_time'] = '[NOW-3MONTH TO NOW]';
        }

        if (empty($solrParamQArray['last_crawl_time'])) {
            $solrParamQArray['last_crawl_time'] = '[NOW-3MONTH TO NOW]';
        }

        if (!empty($expression)) {
            $solrParamQArray['expression'] = $expression;
        }

//        if (empty($id)) {
//            $solrParamQArray['*'] = '*';
//        }

        $solrParamQ = "";
        $i = 0;
        foreach ($solrParamQArray as $k => $v) {
            if ($i++ > 0) {
                $solrParamQ .= " AND ";
            }
            if ($k == 'expression') {
                $solrParamQ .= "$v";
            }
            else {
                $solrParamQ .= "$k:$v";
            }
        }

        return $solrParamQ;
    }

    /**
     * Get hightlight words from monitor expression
     * @param $expression {string} the monitor expression
     * @return array
     * */
    private function getHighlightWords($expression)
    {
        $highlightWords = [];
        $pattern = "|\"(.+)\"|U";
        preg_match_all($pattern, $expression, $capturedWords);
        foreach ($capturedWords as $words) {
            foreach ($words as $word) {
                array_push($highlightWords, trim($word, "\""));
            }
        }

        return $highlightWords;
    }

    private function querySolrByParameters($solrParams = null, $highlightWords = "")
    {
        $startTime = time();
        $header = [];

        $solrClient = new \Solr\SolrClient($this->solrUrlBase, $this->solrCollection);
        $searchResults = $solrClient->querySolrByParameters($solrParams, $highlightWords);
        $header[DEFAULT_PROVIDER] = $searchResults['header'];

        $docs = $searchResults['results'];

        $endTime = time();

        return [
            'header' => $header,
            'docs' => $docs,
            'q' => $solrParams['q'],
            'highlightWords' => $highlightWords,
            'time' => $endTime - $startTime
        ];
    }

    private function marshupQuery($q, $highlightWords = "", $start = 0, $rows = 30, $provider = null)
    {
        $searchResults = [];
        $startTime = time();

        $header = ['baidu' => ['numFound' => 0], 'warpspeed' => ['numFound' => 0]];
        if (!empty($q)) {
            if ($provider == "baidu") {
                $metaSearcher = new \MetaSearch\MetaSearcher();
                $searchResults = $metaSearcher->searchBaidu($q, $start, $rows);

                $header[$provider] = $searchResults['header'];
                $count[$provider] = count($searchResults);
            } else if ($provider == "warpspeed") {
                $solrClient = new \Solr\SolrClient($this->solrUrlBase, $this->solrCollection);
                $searchResults = $solrClient->browse($q, $highlightWords, $start, $rows);
                $searchResults = $searchResults['results'];

                $header[$provider] = $searchResults['header'];
            } else {
                $solrClient = new \Solr\SolrClient($this->solrUrlBase, $this->solrCollection);
                $r = $solrClient->browse($q, $highlightWords, $start, $rows);
                $header["warpspeed"] = $r['header'];
                $r = $r['results'];

                $metaSearcher = new \MetaSearch\MetaSearcher();
                $r2 = $metaSearcher->searchBaidu($q, $start, $rows);
                $header["baidu"] = $r2['header'];
                $r2 = $r2['results'];

                $searchResults = array_merge($r, $r2);
            }
        }
        $endTime = time();

        $docs = $searchResults;

        return [
            'header' => $header,
            'docs' => $docs,
            'q' => $q,
            'highlightWords' => $highlightWords,
            'time' => $endTime - $startTime
        ];
    }
}
