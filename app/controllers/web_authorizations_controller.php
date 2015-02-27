<?php
class WebAuthorizationsController extends AppController {

	var $name = 'WebAuthorizations';
	// var $components = array('RequestHandler');

	function afterFilter() {
// 		if ($this->RequestHandler->isAjax()) {
// 			$this->autoLayout = false;
// 		}
	}

	function index() {
		$this->WebAuthorization->recursive = 0;
		$this->set('webAuthorizations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid web authorization', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('webAuthorization', $this->WebAuthorization->read(null, $id));
	}

	function add() {
		$crawl_id = 0;

		if (empty($this->data)) {
			if (!isset($this->params['named']['crawl_id'])) {
				$this->Session->setFlash(__('You must specify a crawl id for the page entity', true));
				$this->redirect(array('controller' => 'crawls', 'action' => 'index'));
			}

			$crawl_id = $this->params['named']['crawl_id'];
		}

		if (!empty($this->data)) {
			$crawl_id = $this->data['WebAuthorization']['crawl_id'];

			$this->WebAuthorization->create();
			$this->data['WebAuthorization']['user_id'] = $this->currentUser['id'];
			if ($this->WebAuthorization->save($this->data)) {
				$this->Session->setFlash(__('The web authorization has been saved', true));
				$this->redirect(array('controller' => 'crawls', 'action' => 'view', $crawl_id));
			} else {
				$this->Session->setFlash(__('The web authorization could not be saved. Please, try again.', true));
			}
		}

		$this->WebAuthorization->Crawl->recursive = -1;
		$crawl = $this->WebAuthorization->Crawl->read(null, $crawl_id);
		$this->set(compact('crawl'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid web authorization', true));
			$this->redirect(array('action' => 'index'));
		}

		if (!empty($this->data)) {
			if(!$this->checkTenantPrivilege($this->data)) {
				$this->Session->setFlash(__('Privilege denied', true));
				$this->redirect(array('action' => 'index'));
			}

			if ($this->WebAuthorization->save($this->data)) {				
				$this->Session->setFlash(__('The web authorization has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The web authorization could not be saved. Please, try again.', true));
			}
		}

		if (empty($this->data)) {
			$this->data = $this->WebAuthorization->read(null, $id);
		}

		$crawls = $this->WebAuthorization->Crawl->find('list');
		$this->set(compact('crawls'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for web authorization', true));
			$this->redirect(array('action'=>'index'));
		}

		$webAuthorization = $this->WebAuthorization->read(null, $id);
		if(!$this->checkTenantPrivilege($id)) {
			$this->Session->setFlash(__('Privilege denied', true));
			$this->redirect(array('controller' => 'crawls', 'action' => 'index'));
		}

		if ($this->WebAuthorization->delete($id)) {
			$this->Session->setFlash(__('Web authorization deleted', true));
			$this->redirect(array('controller' => 'crawls', 'action' => 'view', $webAuthorization['WebAuthorization']['crawl_id']));
		}

		$this->Session->setFlash(__('Web authorization was not deleted', true));
		$this->redirect(array('controller' => 'crawls', 'action' => 'view', $webAuthorization['WebAuthorization']['crawl_id']));
	}

	function admin_index() {
		$this->WebAuthorization->recursive = 0;
		$this->set('webAuthorizations', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid web authorization', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('webAuthorization', $this->WebAuthorization->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->WebAuthorization->create();
			if ($this->WebAuthorization->save($this->data)) {
				$this->Session->setFlash(__('The web authorization has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The web authorization could not be saved. Please, try again.', true));
			}
		}
		$crawls = $this->WebAuthorization->Crawl->find('list');
		$this->set(compact('crawls'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid web authorization', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->WebAuthorization->save($this->data)) {
				$this->Session->setFlash(__('The web authorization has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The web authorization could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->WebAuthorization->read(null, $id);
		}
		$crawls = $this->WebAuthorization->Crawl->find('list');
		$this->set(compact('crawls'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for web authorization', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->WebAuthorization->delete($id)) {
			$this->Session->setFlash(__('Web authorization deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Web authorization was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>