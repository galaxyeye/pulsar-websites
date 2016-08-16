<?php

App::import('Lib', ['solr/solr_client', 'meta_search/meta_searcher']);

use Icecave\Dialekt\Renderer\ExpressionRenderer;
use Icecave\Dialekt\Parser\ExpressionParser;
use MetaSearch\MetaSearcher;
use Solr\SolrClient;

class MonitorTasksController extends AppController {

	public $name = 'MonitorTasks';
	private $searchUrlBase = "http://master:8983/solr/information_native_0724/";

	public function beforeRender() {
		parent::beforeRender();
		$this->layout = "slim";
	}

	public function index() {
		$this->MonitorTask->recursive = 0;
		$this->set('monitorTasks', $this->paginate());
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid monitor task', true));
			$this->redirect(array('action' => 'index'));
		}
		$monitorTask = $this->MonitorTask->read(null, $id);
		// $this->set('monitorTask', $this->MonitorTask->read(null, $id));

//		$expression = $monitorTask['MonitorTask']['expression'];
//		$renderer = new ExpressionRenderer();
//		$parser = new ExpressionParser();
//		$result = $parser->parse($expression);
//		pr($renderer->render($result));

		$w = $monitorTask['MonitorTask']['expression'];
		$queryResult = $this->query($w);
		$header = $queryResult['header'];
		$docs = $queryResult['docs'];
		$w = $queryResult['w'];

		$this->set(compact('monitorTask', 'header', 'docs', 'w'));
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

	private function query($w, $provider = null) {
		$searchResults = [];
		$start = time();
		if (!empty($w)) {
			if ($provider == "baidu") {
				$metaSearcher = new \MetaSearch\MetaSearcher();
				$searchResults = $metaSearcher->searchBaidu($w);
			}
			else if ($provider == "warpspeed") {
				$solrClient = new \Solr\SolrClient($this->searchUrlBase);
				$searchResults = $solrClient->querySolr($w);
			}
			else {
				$metaSearcher = new \MetaSearch\MetaSearcher();
				$solrClient = new \Solr\SolrClient($this->searchUrlBase);

				$r = $solrClient->browse($w);
				$r2 = $metaSearcher->searchBaidu($w);

				$searchResults = array_merge($r, $r2);
			}
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

		return ['header' => $header, 'docs' => $docs, 'w' => $w];
	}
}
