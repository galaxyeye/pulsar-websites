<?php 
class CrawlFiltersController extends AppController {

	var $name = 'CrawlFilters';

	function add() {
		$crawl_id = 0;

		if (empty($this->data)) {
			if (!isset($this->params['named']['crawl_id'])) {
				$this->Session->setFlash(__('You must specify a crawl id for the crawl filter', true));
				$this->redirect(array('controller' => 'crawls', 'action' => 'index'));
			}

			$crawl_id = $this->params['named']['crawl_id'];
		}

		if (!empty($this->data)) {
			$crawl_id = $this->data['CrawlFilter']['crawl_id'];

			if ($this->data['CrawlFilter']['filter_mode'] == 'BASIC') {
				$textFilter = json_encode($this->data['TextFilter'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
				$blockFilter = json_encode($this->data['BlockFilter'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
			}

			$this->data['CrawlFilter']['user_id'] = $this->currentUser['id'];

			$crawlFilter = $this->CrawlFilter->tidyCrawlFilter($this->data['CrawlFilter']);
			$this->CrawlFilter->create();
			if ($this->CrawlFilter->save($crawlFilter)) {
				$this->Session->setFlash(__('The crawl filter has been saved', true));
				$this->redirect(array('controller' => 'crawls', 'action' => 'view', $crawl_id));
			} else {
				$this->Session->setFlash(__('The crawl filter could not be saved. Please, try again.', true));
			}
		}

		$this->CrawlFilter->Crawl->recursive = -1;
		$crawl = $this->CrawlFilter->Crawl->read(null, $crawl_id);
		$this->set(compact('crawl'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid crawl filter', true));
			$this->redirect(array('action' => 'index'));
		}

		if(!$this->checkTenantPrivilege($id)) {
			$this->Session->setFlash(__('Privilege denied', true));
			$this->redirect(array('controller' => 'crawls', 'action' => 'index'));
		}

		if (!empty($this->data)) {
			$this->CrawlFilter->recursive = -1;
			$crawlFilter = $this->CrawlFilter->read(null, $id);
			$crawl_id = $crawlFilter['CrawlFilter']['crawl_id'];

			$crawlFilter = $this->CrawlFilter->tidyCrawlFilter($this->data['CrawlFilter']);

			if ($this->CrawlFilter->save($crawlFilter)) {
				$this->Session->setFlash(__('The crawl filter has been saved', true));
				$this->redirect(array('controller' => 'crawls', 'action'=>'view', $crawl_id));
			} else {
				$this->Session->setFlash(__('The crawl filter could not be saved. Please, try again.', true));
			}
		}

		if (empty($this->data)) {
			$this->data = $this->CrawlFilter->read(null, $id);
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid crawl', true));
			$this->redirect(array('controller' => 'crawls', 'action' => 'index'));
		}

		if(!$this->checkTenantPrivilege($id)) {
			$this->Session->setFlash(__('Privilege denied', true));
			$this->redirect(array('controller' => 'crawls', 'action' => 'index'));
		}

		$this->set('crawlFilter', $this->CrawlFilter->read(null, $id));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for crawl filter', true));
			$this->redirect(array('controller' => 'crawls', 'action' => 'index'));
		}

		if(!$this->checkTenantPrivilege($id)) {
			$this->Session->setFlash(__('Privilege denied', true));
			$this->redirect(array('controller' => 'crawls', 'action' => 'index'));
		}

		$crawlFilter = $this->CrawlFilter->read(null, $id);
		if ($this->CrawlFilter->delete($id)) {
			$this->Session->setFlash(__('Crawl filter deleted', true));
			$this->redirect(array('controller' => 'crawls', 'action'=>'view', $crawlFilter['CrawlFilter']['crawl_id']));
		}

		$this->Session->setFlash(__('Crawl filter was not deleted', true));
		$this->redirect(array('controller' => 'crawls', 'action'=>'view', $crawlFilter['CrawlFilter']['crawl_id']));
	}

	function admin_index() {
		$this->CrawlFilter->recursive = 0;
		$this->set('crawlFilters', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid crawl filter', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('crawlFilter', $this->CrawlFilter->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->CrawlFilter->create();
			if ($this->CrawlFilter->save($this->data)) {
				$this->Session->setFlash(__('The crawl filter has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crawl filter could not be saved. Please, try again.', true));
			}
		}
		$crawls = $this->CrawlFilter->Crawl->find('list');
		$this->set(compact('crawls'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid crawl filter', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CrawlFilter->save($this->data)) {
				$this->Session->setFlash(__('The crawl filter has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crawl filter could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CrawlFilter->read(null, $id);
		}
		$crawls = $this->CrawlFilter->Crawl->find('list');
		$this->set(compact('crawls'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for crawl filter', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CrawlFilter->delete($id)) {
			$this->Session->setFlash(__('Crawl filter deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Crawl filter was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
