<?php
class ExtractionsController extends AppController {

	var $name = 'Extractions';

	function index() {
		$this->Extraction->recursive = 0;
		$this->set('extractions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid extraction', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('extraction', $this->Extraction->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Extraction->create();
			if ($this->Extraction->save($this->data)) {
				$this->Session->setFlash(__('The extraction has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extraction could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
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
	}

	function delete($id = null) {
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
?>