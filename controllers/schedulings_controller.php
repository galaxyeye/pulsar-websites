<?php
class SchedulingsController extends AppController {

	var $name = 'Schedulings';

	function index() {
		$this->Scheduling->recursive = 0;
		$this->set('schedulings', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid scheduling', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('scheduling', $this->Scheduling->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Scheduling->create();
			if ($this->Scheduling->save($this->data)) {
				$this->Session->setFlash(__('The scheduling has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The scheduling could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid scheduling', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Scheduling->save($this->data)) {
				$this->Session->setFlash(__('The scheduling has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The scheduling could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Scheduling->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for scheduling', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Scheduling->delete($id)) {
			$this->Session->setFlash(__('Scheduling deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Scheduling was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Scheduling->recursive = 0;
		$this->set('schedulings', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid scheduling', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('scheduling', $this->Scheduling->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Scheduling->create();
			if ($this->Scheduling->save($this->data)) {
				$this->Session->setFlash(__('The scheduling has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The scheduling could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid scheduling', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Scheduling->save($this->data)) {
				$this->Session->setFlash(__('The scheduling has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The scheduling could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Scheduling->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for scheduling', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Scheduling->delete($id)) {
			$this->Session->setFlash(__('Scheduling deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Scheduling was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>