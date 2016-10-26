<?php

App::import('Lib', ['solr/solr_client', 'meta_search/meta_searcher']);

const DEFAULT_PROVIDER = 'warpspeed';

class TopicsController extends AppController
{
    var $name = 'Topics';

    public $providers = ['warpspeed', 'baidu'];
    private $solrUrlBase = SOLR_URL_BASE;
    private $solrCollection = SOLR_COLLECTION;

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
        if (!$id) {
            $this->Session->setFlash(__('Invalid topic', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('topic', $this->Topic->read(null, $id));

        $docId = symmetric_decode($encodedUrl);
        $params = [
            'q' => "id:$docId",
            'rows' => 1
        ];
        $queryResult = $this->querySolrByParameters($params);
        $docs = $queryResult['docs'];

        // $quickView = $docs[0]['quickView'];
        // pr($docs);

        $url = isset($docs[0]['url']) ? $docs[0]['url'] : "";
        $quickView = isset($docs[0]['html_content']) ? $docs[0]['html_content'] : "";
        $this->set(compact("url", "quickView"));
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

    public function u_monitor($id = null, $query = null)
    {
        $this->Topic->recursive = -1;
        $topics = parent::paginate();

        $this->set(compact('topics'));

        if ($id == null) {
            $id = $topics[0]['Topic']['id'];
        }
        if (!$id) {
            $this->Session->setFlash(__('Invalid topic', true));
            $this->redirect(array('action' => 'index'));
        }

        $params = $this->getParams($id);

        $topic = $params['topic'];        // topic data model
        $page = $params['page'];        // page number
        $limit = $params['limit'];        // number per page
        $start = $params['start'];        // rows count to start
        $rows = $params['rows'];        // number per page
        $expression = $params['expression'];

        $solrParams['start'] = $start;
        $solrParams['rows'] = $rows;

        $q = null;
        if (!empty($expression)) {
            $q .= "$expression";
        }
        if (!empty($query)) {
            $query = symmetric_decode($query);
            $q .= " AND $query";
        }

        $solrParams['q'] = urlencode($q);

        $highlightWords = $this->getHighlightWords($expression);

        $queryResult = $this->querySolrByParameters($solrParams, $highlightWords);

        // $queryResult = $this->marshupQuery($expression, $highlightWords, ($page - 1) * $limit, $limit, $provider);

        // $queryResult = $this->dummyQueryResult;

        $header = $queryResult['header'][DEFAULT_PROVIDER];
        $docs = $queryResult['docs'];
        foreach ($docs as &$doc) {
            $doc = array_merge($this->defaultDoc, $doc);
        }
        $q = $queryResult['q'];
        $providers = $this->providers;

        // 	public function paginate($page, $limit, $current, $count, $options)
        $this->paginate($page, $limit, $header['count'], $header['numFound'], ['limit' => $limit]);
        $this->set(compact('topic', 'header', 'docs', 'q', 'providers', 'id'));
    }

    public function u_stat($id = null)
    {
        $this->Topic->recursive = -1;
        $topics = parent::paginate();

        $this->set(compact('topics'));

        if ($id == null) {
            $id = $topics[0]['Topic']['id'];
        }
        if (!$id) {
            $this->Session->setFlash(__('Invalid topic', true));
            $this->redirect(array('action' => 'index'));
        }

        $result = $this->u_statTrends($id);
        $topic = $result['topic'];
        $xdata = $result['xdata'];
        $ydata = $result['ydata'];

        $this->set(compact('topic', 'id', 'xdata', 'ydata'));
    }

    public function u_statTrends($id = null, $solrParamQ = null, $solrParams = null, $format = "php")
    {
        if ($solrParamQ == null) {
            $solrParamQ = "last_crawl_time:[NOW/DAY-30DAYS TO NOW]";
        }
        else {
            $solrParamQ = base64_decode($solrParamQ);
        }

        $defaultSolrParams = [
            "fl" => "last_crawl_time",
            "facet" => "true",
            "facet.range" => "last_crawl_time",
            "facet.range.start" => "NOW/MONTH",
            "facet.range.end" => "NOW",
            "facet.range.gap" => "%2B1DAY",
            "group" => "true",
            "group.limit" => 1,
            "group.func" => "rint(div(sum(ms(last_crawl_time),mul(8,3600000)),mul(24,3600000)))"
        ];

        if ($solrParams != null) {
            $solrParams = json_decode(base64_decode($solrParams));
            $solrParams = array_merge($solrParams, $defaultSolrParams);
        }
        else {
            $solrParams = $defaultSolrParams;
        }

        $result = $this->statCommon($id, $solrParamQ, $solrParams);
        $searchResults = $result['searchResults'];
        $searchResults['grouped'] = "ignored";
        $data = $searchResults['facet_counts']['facet_ranges']['last_crawl_time']['counts'];

        $xdata = [];
        $ydata = [];

        for ($i = 0; $i < count($data); $i += 2) {
            $date = date_parse($data[$i]);
            array_push($xdata, $date['day']);
            array_push($ydata, $data[$i + 1]);
        }

        $result['xdata'] = $xdata;
        $result['ydata'] = $ydata;

        $result['solrParamQ'] = $solrParamQ;
        $result['solrParams'] = $solrParams;

        if ($format == 'php') {
            return $result;
        }
        else if ($format == 'json') {
            $this->autoRender = false;
            return json_encode($result);
        }
    }

    public function u_statMediaDistribution($id = null, $solrParamQ = null, $solrParams = null, $format = "php") {
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

    public function u_statTrendsGroupByMedia($id = null, $solrParamQ = null, $solrParams = null, $format = "php") {
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

    public function u_statSentiment($id = null, $solrParamQ = null, $solrParams = null, $format = "php") {
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

    public function u_statAlert($id = null, $solrParamQ = null, $solrParams = null, $format = "php") {
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

    public function u_statHotWords($id = null, $solrParamQ = null, $solrParams = null, $format = "php") {
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

    public function u_statHotEvents($id = null, $solrParamQ = null, $solrParams = null, $format = "php") {
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

    public function u_statTagComparation($id = null, $solrParamQ = null, $solrParams = null, $format = "php") {
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
        $q = 'last_crawl_time:[NOW-1DAY/DAY TO *]';
        if ($expression != null) {
            $q .= " AND $expression";
        }

        $solrParams['q'] = urlencode($q);

        $response = $this->querySolrByParameters($solrParams);

        pr($response);

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

    private function statCommon($id = null, $solrParamQ = "", $solrParams = [])
    {
        $this->Topic->recursive = -1;
        $topics = parent::paginate();

        $this->set(compact('topics'));

        if ($id == null) {
            $id = $topics[0]['Topic']['id'];
        }
        if (!$id) {
            $this->Session->setFlash(__('Invalid topic', true));
            $this->redirect(array('action' => 'index'));
        }

        $params = $this->getParams($id);

        $topic = $params['topic'];        // topic data model
        $expression = $params['expression'];

        $q = "";
        if (!empty($solrParamQ)) {
            $q .= "$solrParamQ";
        }
        if (!empty($expression)) {
            $q .= " AND $expression";
        }

        $solrParams['q'] = urlencode($q);

        $solrClient = new \Solr\SolrClient($this->solrUrlBase, $this->solrCollection);
        $searchResults = $solrClient->statSolrByParameters($solrParams);

        return ['topic' => $topic, 'solrParams' => $solrParams, 'searchResults' => $searchResults];
    }

    /**
     * Get query parameters for topic
     * @param $id {int} topic id
     * @return array
     * */
    private function getParams($id = null)
    {
        $topic = $this->Topic->read(null, $id);

        $page = 1;
        if (isset($this->params['named']['page'])) {
            $page = $this->params['named']['page'];
        }
        $limit = 20;
        if (isset($this->params['named']['limit'])) {
            $limit = $this->params['named']['limit'];
        }

        $expression = $topic['Topic']['expression'];
        if (stripos($expression, ":") === false) {
            $expression = "text:($expression)";
        }

        $solrParams = [
            'topic' => $topic,

            'page' => $page,
            'limit' => $limit,

            'start' => ($page - 1) * $limit,
            'rows' => $limit,

            'expression' => $expression
        ];

        return $solrParams;
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
