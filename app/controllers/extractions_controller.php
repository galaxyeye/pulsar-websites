<?php
class ExtractionsController extends AppController {

	var $name = 'Extractions';

	function index() {
  	$this->paginate['Extraction'] = array('limit'=> 500, 'order' => 'Extraction.id DESC');

		$this->Extraction->recursive = 0;
		$this->set('extractions', $this->paginate(array('Extraction.user_id' => $this->currentUser['id'])));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid extraction', true));
			$this->redirect(array('action' => 'index'));
		}

		if(!$this->checkTenantPrivilege($id)) {
			$this->Session->setFlash(__('Privilege denied', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->set('extraction', $this->Extraction->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->data['Extraction']['user_id'] = $this->currentUser['id'];

			$this->Extraction->create();
			if ($this->Extraction->save($this->data)) {
				$this->Session->setFlash(__('The extraction has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extraction could not be saved. Please, try again.', true));
			}
		}

		$crawls = $this->Extraction->Crawl->find('list');
		$this->set(compact('crawls'));
	}

	function addForCrawl() {
		$crawl_id = 0;

		if (empty($this->data)) {
			if (!isset($this->params['named']['crawl_id'])) {
				$this->Session->setFlash(__('You must specify a crawl id for the extraction', true));
				$this->redirect(array('controller' => 'crawls', 'action' => 'index'));
			}
	
			$crawl_id = $this->params['named']['crawl_id'];
		}

		if (!empty($this->data)) {
			$crawl_id = $this->data['Extraction']['crawl_id'];
	
			$this->Extraction->create();
			$this->data['Extraction']['user_id'] = $this->currentUser['id'];
			if ($this->Extraction->save($this->data)) {
				$this->Session->setFlash(__('The extraction has been saved', true));
				$this->redirect(array('controller' => 'crawls', 'action' => 'view', $crawl_id));
			} else {
				$this->Session->setFlash(__('The extraction could not be saved. Please, try again.', true));
			}
		}

		$this->Extraction->Crawl->recursive = -1;
		$crawl = $this->Extraction->Crawl->read(null, $crawl_id);
		$this->set(compact('crawl'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid extraction', true));
			$this->redirect(array('action' => 'index'));
		}

		if (!empty($this->data)) {
			if(!$this->checkTenantPrivilege($this->data)) {
				$this->Session->setFlash(__('Privilege denied', true));
				$this->redirect(array('action' => 'index'));
			}

			if ($this->Extraction->save($this->data)) {
				$this->Session->setFlash(__('The extraction has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extraction could not be saved. Please, try again.', true));
			}
		}

		if (empty($this->data)) {
			if(!$this->checkTenantPrivilege($id)) {
				$this->Session->setFlash(__('Privilege denied', true));
				$this->redirect(array('action' => 'index'));
			}

			$this->data = $this->Extraction->read(null, $id);
		}

		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for extraction', true));
			$this->redirect(array('action'=>'index'));
		}

		if(!$this->checkTenantPrivilege($id)) {
			$this->Session->setFlash(__('Privilege denied', true));
			$this->redirect(array('action' => 'index'));
		}

		if ($this->Extraction->delete($id)) {
			$this->Session->setFlash(__('Extraction deleted', true));
			$this->redirect(array('action'=>'index'));
		}

		$this->Session->setFlash(__('Extraction was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function admin_index() {
		$this->Extraction->recursive = 0;
		$this->set('extractions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid extraction', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('extraction', $this->Extraction->read(null, $id));
	}

	function startExtraction() {
		if (!empty($this->data)) {
			if(!$this->__checkUserPrivilege($this->data['Extraction']['id'])) {
				$this->Session->setFlash(__('Privilege denied', true));
				$this->redirect(array('action' => 'index'));
			}

			$id = $this->data['Extraction']['id'];
			$crawl = $this->Crawl->read(null, $id);
			$status = $crawl['Crawl']['status'];
			if ($status != 'NOT-START') {
				$this->Session->setFlash(__('The crawl could not be saved. Please, try again.', true));
				$this->redirect(array('action' => 'index'));
			}
	
			$nutchServerUrl = "http://localhost:8182/";
			$cURL = new cURL();
	
			$this->Crawl->id = $id;
			if ($this->Crawl->saveField('status', 'CRAWLING')) {
				$this->Session->setFlash(__('The crawl has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crawl could not be saved. Please, try again.', true));
			}
		}
	
		if (empty($this->data)) {
			$this->Session->setFlash(__('The crawl has been saved', true));
			$this->redirect(array('action' => 'index'));
		}
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Extraction->create();
			if ($this->Extraction->save($this->data)) {
				$this->Session->setFlash(__('The extraction has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extraction could not be saved. Please, try again.', true));
			}
		}
		$crawls = $this->Extraction->Crawl->find('list');
		$users = $this->Extraction->User->find('list');
		$this->set(compact('crawls', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid extraction', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Extraction->save($this->data)) {
				$this->Session->setFlash(__('The extraction has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extraction could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Extraction->read(null, $id);
		}
		$crawls = $this->Extraction->Crawl->find('list');
		$users = $this->Extraction->User->find('list');
		$this->set(compact('crawls', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for extraction', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Extraction->delete($id)) {
			$this->Session->setFlash(__('Extraction deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Extraction was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
