<?php
class HumanActionsController extends AppController {

	var $name = 'HumanActions';

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid human action', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('humanAction', $this->HumanAction->read(null, $id));
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
			$crawl_id = $this->data['HumanAction']['crawl_id'];

			$this->HumanAction->create();
			$this->data['HumanAction']['user_id'] = $this->currentUser['id'];
			if ($this->HumanAction->save($this->data)) {
				$this->Session->setFlash(__('The crawl filter has been saved', true));
				$this->redirect(array('controller' => 'crawls', 'action' => 'view', $crawl_id));
			} else {
				$this->Session->setFlash(__('The crawl filter could not be saved. Please, try again.', true));
			}
		}

		// $this->HumanAction->Crawl->recursive = -1;
		$this->HumanAction->Crawl->contain(array('HumanAction' => array('fields' => array('order'))));
		$crawl = $this->HumanAction->Crawl->read(null, $crawl_id);

		$maxOrder = 0;
		foreach ($crawl['HumanAction'] as $humanAction) {
			if ($humanAction['order'] > $maxOrder) {
				$maxOrder = $humanAction['order'];
			}
		}
		$maxOrder += 1;

		$this->set(compact('crawl', 'maxOrder'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid human action', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->HumanAction->save($this->data)) {
				$this->Session->setFlash(__('The human action has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The human action could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->HumanAction->read(null, $id);
		}
		$crawls = $this->HumanAction->Crawl->find('list');
		$this->set(compact('crawls'));
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

		$this->HumanAction->recursive = -1;
		$humanAction = $this->HumanAction->read(null, $id);
		if ($this->HumanAction->delete($id)) {
			$this->Session->setFlash(__('Human action deleted', true));
			$this->redirect(array('controller' => 'crawls', 'action'=>'view', $humanAction['HumanAction']['crawl_id']));
		}

		$this->Session->setFlash(__('Human action was not deleted', true));
		$this->redirect(array('controller' => 'crawls', 'action'=>'view', $humanAction['HumanAction']['crawl_id']));
	}

	function admin_index() {
		$this->HumanAction->recursive = 0;
		$this->set('humanActions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid human action', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('humanAction', $this->HumanAction->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->HumanAction->create();
			if ($this->HumanAction->save($this->data)) {
				$this->Session->setFlash(__('The human action has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The human action could not be saved. Please, try again.', true));
			}
		}
		$crawls = $this->HumanAction->Crawl->find('list');
		$this->set(compact('crawls'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid human action', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->HumanAction->save($this->data)) {
				$this->Session->setFlash(__('The human action has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The human action could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->HumanAction->read(null, $id);
		}
		$crawls = $this->HumanAction->Crawl->find('list');
		$this->set(compact('crawls'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for human action', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->HumanAction->delete($id)) {
			$this->Session->setFlash(__('Human action deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Human action was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
