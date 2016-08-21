<?php

App::import('Lib', ['solr/solr_client', 'meta_search/meta_searcher']);

use Icecave\Dialekt\Renderer\ExpressionRenderer;
use Icecave\Dialekt\Parser\ExpressionParser;
use MetaSearch\MetaSearcher;
use Solr\SolrClient;

class MonitorTasksController extends AppController {

	var $name = 'MonitorTasks';
	var $uses = array();

	public $providers = ['warpspeed', 'baidu'];
	private $solrUrlBase = "http://master:8983/solr"; // SOLR_URL_BASE
	private $solrCollection = "information_native_0724";

//	public function beforeRender() {
//		parent::beforeRender();
//		$this->layout = "slim";
//	}

	public function u_index($id = null, $provider = null) {
		$this->MonitorTask->recursive = 0;
		$monitorTasks = parent::paginate();

		$taskNames = [];
		foreach ($monitorTasks as $monitorTask) {
			$taskNames[] = $monitorTask['MonitorTask']['name'];
		}

		$this->set(compact('monitorTasks', 'taskNames'));

		$id = $monitorTasks[0]['MonitorTask']['id'];
		if (!$id) {
			$this->Session->setFlash(__('Invalid monitor task', true));
			$this->redirect(array('action' => 'index'));
		}
		$monitorTask = $this->MonitorTask->read(null, $id);

		$page = 1;
		if (isset($this->params['named']['page'])) {
			$page = $this->params['named']['page'];
		}
		$limit = 20;
		if (isset($this->params['named']['limit'])) {
			$limit = $this->params['named']['limit'];
		}

		$expression = $monitorTask['MonitorTask']['expression'];
		$queryResult = $this->query($expression, ($page - 1) * $limit, $limit, $provider);

		$header = $queryResult['header']['warpspeed'];
		$docs = $queryResult['docs'];
		$expression = $queryResult['expression'];
		$providers = $this->providers;

		$this->paginate($page, $limit, $header['count'], $header['numFound'], ['limit' => $limit]);
		$this->set(compact('monitorTask', 'header', 'docs', 'expression', 'providers', 'id'));
	}

	public function u_view() {
		$this->u_index();
		$this->render("u_index");
	}

	public function u_add() {
		$this->add();
	}

	public function u_edit() {
		$this->edit();
	}

	public function u_delete() {
		$this->delete();
	}

	public function index() {
		$this->MonitorTask->recursive = 0;
		$this->set('monitorTasks', parent::paginate());
	}

	public function view($id = null, $provider = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid monitor task', true));
			$this->redirect(array('action' => 'index'));
		}
		$monitorTask = $this->MonitorTask->read(null, $id);

		$page = 1;
		if (isset($this->params['named']['page'])) {
		    $page = $this->params['named']['page'];
		}
		$limit = 20;
		if (isset($this->params['named']['limit'])) {
		    $limit = $this->params['named']['limit'];
		}

		$expression = $monitorTask['MonitorTask']['expression'];
		$queryResult = $this->query($expression, ($page - 1) * $limit, $limit, $provider);

		$header = $queryResult['header']['warpspeed'];
		$docs = $queryResult['docs'];
		$expression = $queryResult['expression'];
		$providers = $this->providers;

		$this->paginate($page, $limit, $header['count'], $header['numFound'], ['limit' => $limit]);
		$this->set(compact('monitorTask', 'header', 'docs', 'expression', 'providers', 'id'));
	}

	public function add() {
		if (!empty($this->data)) {
			$this->MonitorTask->create();
			if ($this->MonitorTask->save($this->data)) {
				$this->Session->setFlash(__('The monitor task has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The monitor task could not be saved. Please, try again.', true));
			}
		}
	}

	public function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid monitor task', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MonitorTask->save($this->data)) {
				$this->Session->setFlash(__('The monitor task has been saved', true));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The monitor task could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MonitorTask->read(null, $id);
		}
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for monitor task', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MonitorTask->delete($id)) {
			$this->Session->setFlash(__('Monitor task deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Monitor task was not deleted', true));
		$this->redirect(array('action' => 'index'));
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
	    $this->params['paging']["MonitorTasks"] = $paging;
	    
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
