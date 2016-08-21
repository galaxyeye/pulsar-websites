<?php

App::import('Lib', ['solr/solr_client', 'meta_search/meta_searcher']);

class TopicsController extends AppController {

	var $name = 'Topics';

	public $providers = ['warpspeed', 'baidu'];
	private $solrUrlBase = "http://master:8983/solr"; // SOLR_URL_BASE
	private $solrCollection = "information_native_0724";

	/**
	 * @var HttpClient
	 * */
	private $httpClient;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->httpClient = new \HttpClient();
	}

	function u_index() {
		$this->Topic->recursive = 0;
		$this->set('topics', parent::paginate());
	}

	function u_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid topic', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('topic', $this->Topic->read(null, $id));
	}

	function u_quickView($id, $encodedUrl = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid topic', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('topic', $this->Topic->read(null, $id));

		$url = symmetric_decode($encodedUrl);
		$queryResult = $this->query("url:$url", 0, 1);
		$docs = $queryResult['docs'];
		// $quickView = $docs[0]['quickView'];
		$quickView = isset($docs[0]['content']) ? $docs[0]['content'] : "";
		$this->set(compact("quickView", "url"));
	}

	function u_add() {
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

	function u_edit($id = null) {
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
	
	function u_edit2($id = null) {
	}

	function u_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for topic', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Topic->delete($id)) {
			$this->Session->setFlash(__('Topic deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Topic was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	public function u_monitor($id = null, $provider = null) {
		$this->Topic->recursive = 0;
		$topics = parent::paginate();

		$this->set(compact('topics'));

		if ($id == null) {
			$id = $topics[0]['Topic']['id'];
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid topic', true));
			$this->redirect(array('action' => 'index'));
		}
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
		$queryResult = $this->query($expression, ($page - 1) * $limit, $limit, $provider);

		$header = $queryResult['header']['warpspeed'];
		$docs = $queryResult['docs'];
		$expression = $queryResult['expression'];
		$providers = $this->providers;

		$this->paginate($page, $limit, $header['count'], $header['numFound'], ['limit' => $limit]);
		$this->set(compact('topic', 'header', 'docs', 'expression', 'providers', 'id'));
	}

	/**
	 *
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
		$this->params['paging']["Topics"] = $paging;

		if (!in_array('Paginator', $this->helpers) && !array_key_exists('Paginator', $this->helpers)) {
			$this->helpers[] = 'Paginator';
		}
	}

	private function query($expression, $start = 0, $rows = 30, $provider = null) {
		$searchResults = [];
		$startTime = time();

		$header = ['baidu' => ['numFound' => 0], 'warpspeed' => ['numFound' => 0]];
		if (!empty($expression)) {
			if ($provider == "baidu") {
				$metaSearcher = new \MetaSearch\MetaSearcher();
				$searchResults = $metaSearcher->searchBaidu($expression, $start, $rows);

				$header[$provider] = $searchResults['header'];
				$count[$provider] = count($searchResults);
			}
			else if ($provider == "warpspeed") {
				$solrClient = new \Solr\SolrClient($this->solrUrlBase, $this->solrCollection);
				$searchResults = $solrClient->browse($expression, $start, $rows);
				$searchResults = $searchResults['results'];

				$header[$provider] = $searchResults['header'];
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
