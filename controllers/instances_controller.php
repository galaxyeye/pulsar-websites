<?php
class InstancesController extends AppController {

	var $name = 'Instances';

	function index() {
		$this->Instance->recursive = 0;
		$this->set('instances', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid instance', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('instance', $this->Instance->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Instance->create();
			if ($this->Instance->save($this->data)) {
				$this->Session->setFlash(__('The instance has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instance could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid instance', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Instance->save($this->data)) {
				$this->Session->setFlash(__('The instance has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instance could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Instance->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for instance', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Instance->delete($id)) {
			$this->Session->setFlash(__('Instance deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Instance was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Instance->recursive = 0;
		$this->set('instances', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid instance', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('instance', $this->Instance->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Instance->create();
			if ($this->Instance->save($this->data)) {
				$this->Session->setFlash(__('The instance has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instance could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid instance', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Instance->save($this->data)) {
				$this->Session->setFlash(__('The instance has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instance could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Instance->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for instance', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Instance->delete($id)) {
			$this->Session->setFlash(__('Instance deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Instance was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>