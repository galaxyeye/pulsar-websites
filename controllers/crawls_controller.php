<?php
class CrawlsController extends AppController {

	var $name = 'Crawls';

	function index() {
		$this->Crawl->recursive = 0;
		$this->set('crawls', $this->paginate(array('user_id' => $this->currentUser['id'])));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid crawl', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('crawl', $this->Crawl->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->data['Crawl']['status'] = 'CREATED';
			$this->data['Crawl']['phrase'] = 'NOT-START';
			$this->data['Crawl']['user_id'] = $this->currentUser['id'];

			pr($this->data);
			die();

			$this->Crawl->create();
			if ($this->Crawl->saveAll($this->data)) {
				$this->Session->setFlash(__('The crawl has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crawl could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid crawl', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Crawl->save($this->data)) {
				$this->Session->setFlash(__('The crawl has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crawl could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Crawl->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for crawl', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Crawl->delete($id)) {
			$this->Session->setFlash(__('Crawl deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Crawl was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function admin_index() {
		$this->Crawl->recursive = 0;
		$this->set('crawls', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid crawl', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('crawl', $this->Crawl->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Crawl->create();
			if ($this->Crawl->save($this->data)) {
				$this->Session->setFlash(__('The crawl has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crawl could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Crawl->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid crawl', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Crawl->save($this->data)) {
				$this->Session->setFlash(__('The crawl has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crawl could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Crawl->read(null, $id);
		}
		$users = $this->Crawl->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for crawl', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Crawl->delete($id)) {
			$this->Session->setFlash(__('Crawl deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Crawl was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>