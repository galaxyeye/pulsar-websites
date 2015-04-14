<?php
class ExtractFeaturesController extends AppController {

	var $name = 'ExtractFeatures';

	function index() {
		$this->ExtractFeature->recursive = 0;
		$this->set('extractFeatures', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid extract feature', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('extractFeature', $this->ExtractFeature->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ExtractFeature->create();
			if ($this->ExtractFeature->save($this->data)) {
				$this->Session->setFlash(__('The extract feature has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extract feature could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid extract feature', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ExtractFeature->save($this->data)) {
				$this->Session->setFlash(__('The extract feature has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extract feature could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ExtractFeature->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for extract feature', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ExtractFeature->delete($id)) {
			$this->Session->setFlash(__('Extract feature deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Extract feature was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->ExtractFeature->recursive = 0;
		$this->set('extractFeatures', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid extract feature', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('extractFeature', $this->ExtractFeature->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->ExtractFeature->create();
			if ($this->ExtractFeature->save($this->data)) {
				$this->Session->setFlash(__('The extract feature has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extract feature could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid extract feature', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ExtractFeature->save($this->data)) {
				$this->Session->setFlash(__('The extract feature has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extract feature could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ExtractFeature->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for extract feature', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ExtractFeature->delete($id)) {
			$this->Session->setFlash(__('Extract feature deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Extract feature was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>