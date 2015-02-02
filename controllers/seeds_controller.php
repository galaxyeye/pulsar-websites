<?php
class SeedsController extends AppController {

	var $name = 'Seeds';

	function index() {
		$this->Seed->recursive = 0;
		$this->set('seeds', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seed', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seed', $this->Seed->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Seed->create();
			if ($this->Seed->save($this->data)) {
				$this->Session->setFlash(__('The seed has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seed could not be saved. Please, try again.', true));
			}
		}
		$seedLists = $this->Seed->SeedList->find('list');
		$this->set(compact('seedLists'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid seed', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Seed->save($this->data)) {
				$this->Session->setFlash(__('The seed has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seed could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Seed->read(null, $id);
		}
		$seedLists = $this->Seed->SeedList->find('list');
		$this->set(compact('seedLists'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seed', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Seed->delete($id)) {
			$this->Session->setFlash(__('Seed deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seed was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Seed->recursive = 0;
		$this->set('seeds', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seed', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seed', $this->Seed->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Seed->create();
			if ($this->Seed->save($this->data)) {
				$this->Session->setFlash(__('The seed has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seed could not be saved. Please, try again.', true));
			}
		}
		$seedLists = $this->Seed->SeedList->find('list');
		$this->set(compact('seedLists'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid seed', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Seed->save($this->data)) {
				$this->Session->setFlash(__('The seed has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seed could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Seed->read(null, $id);
		}
		$seedLists = $this->Seed->SeedList->find('list');
		$this->set(compact('seedLists'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seed', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Seed->delete($id)) {
			$this->Session->setFlash(__('Seed deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seed was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>