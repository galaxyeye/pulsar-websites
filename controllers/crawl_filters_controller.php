<?php
class CrawlFiltersController extends AppController {

	var $name = 'CrawlFilters';

	function index() {
		$this->CrawlFilter->recursive = 0;
		$this->set('crawlFilters', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid crawl filter', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('crawlFilter', $this->CrawlFilter->read(null, $id));
	}

	function add() {
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

	function edit($id = null) {
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

	function delete($id = null) {
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
?>