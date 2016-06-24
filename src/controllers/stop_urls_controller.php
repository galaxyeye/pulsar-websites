<?php
class StopUrlsController extends AppController {

	var $name = 'StopUrls';

	function index() {
		$this->StopUrl->recursive = 0;
		$this->set('stopUrls', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid stop url', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('stopUrl', $this->StopUrl->read(null, $id));
	}

	function add() {
		$crawl_id = 0;

		if (empty($this->data)) {
			if (!isset($this->params['named']['crawl_id'])) {
				$this->Session->setFlash(__('You must specify a crawl id for the human action', true));
				$this->redirect(array('controller' => 'crawls', 'action' => 'index'));
			}

			$crawl_id = $this->params['named']['crawl_id'];
		}

		if (!empty($this->data)) {
			$crawl_id = $this->data['StopUrl']['crawl_id'];

			$this->StopUrl->create();
			$this->data['StopUrl']['user_id'] = $this->currentUser['id'];
			if ($this->StopUrl->save($this->data)) {
				$this->Session->setFlash(__('The stop url has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stop url could not be saved. Please, try again.', true));
			}
		}

		$this->StopUrl->Crawl->recursive = -1;
		$crawl = $this->StopUrl->Crawl->read(null, $crawl_id);
		$this->set(compact('crawl'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid stop url', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->StopUrl->save($this->data)) {
				$this->Session->setFlash(__('The stop url has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stop url could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->StopUrl->read(null, $id);
		}
		$crawls = $this->StopUrl->Crawl->find('list');
		$users = $this->StopUrl->User->find('list');
		$this->set(compact('crawls', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for stop url', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->StopUrl->delete($id)) {
			$this->Session->setFlash(__('Stop url deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Stop url was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->StopUrl->recursive = 0;
		$this->set('stopUrls', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid stop url', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('stopUrl', $this->StopUrl->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->StopUrl->create();
			if ($this->StopUrl->save($this->data)) {
				$this->Session->setFlash(__('The stop url has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stop url could not be saved. Please, try again.', true));
			}
		}
		$crawls = $this->StopUrl->Crawl->find('list');
		$users = $this->StopUrl->User->find('list');
		$this->set(compact('crawls', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid stop url', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->StopUrl->save($this->data)) {
				$this->Session->setFlash(__('The stop url has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The stop url could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->StopUrl->read(null, $id);
		}
		$crawls = $this->StopUrl->Crawl->find('list');
		$users = $this->StopUrl->User->find('list');
		$this->set(compact('crawls', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for stop url', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->StopUrl->delete($id)) {
			$this->Session->setFlash(__('Stop url deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Stop url was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>