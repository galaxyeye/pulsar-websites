<?php
class SeedListsController extends AppController {

	var $name = 'SeedLists';

	function index() {
		$this->SeedList->recursive = 0;
		$this->set('seedLists', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seed list', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seedList', $this->SeedList->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SeedList->create();
			if ($this->SeedList->save($this->data)) {
				$this->Session->setFlash(__('The seed list has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seed list could not be saved. Please, try again.', true));
			}
		}
		$users = $this->SeedList->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid seed list', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeedList->save($this->data)) {
				$this->Session->setFlash(__('The seed list has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seed list could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SeedList->read(null, $id);
		}
		$users = $this->SeedList->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seed list', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeedList->delete($id)) {
			$this->Session->setFlash(__('Seed list deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seed list was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->SeedList->recursive = 0;
		$this->set('seedLists', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seed list', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seedList', $this->SeedList->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SeedList->create();
			if ($this->SeedList->save($this->data)) {
				$this->Session->setFlash(__('The seed list has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seed list could not be saved. Please, try again.', true));
			}
		}
		$users = $this->SeedList->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid seed list', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeedList->save($this->data)) {
				$this->Session->setFlash(__('The seed list has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seed list could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SeedList->read(null, $id);
		}
		$users = $this->SeedList->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seed list', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeedList->delete($id)) {
			$this->Session->setFlash(__('Seed list deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seed list was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>