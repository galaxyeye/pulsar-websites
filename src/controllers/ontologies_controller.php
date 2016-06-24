<?php
class OntologiesController extends AppController {

	var $name = 'Ontologies';

	function index() {
		$this->Ontology->recursive = 0;
		$this->set('ontologies', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ontology', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('ontology', $this->Ontology->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Ontology->create();
			if ($this->Ontology->save($this->data)) {
				$this->Session->setFlash(__('The ontology has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ontology could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ontology', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Ontology->save($this->data)) {
				$this->Session->setFlash(__('The ontology has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ontology could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ontology->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ontology', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Ontology->delete($id)) {
			$this->Session->setFlash(__('Ontology deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ontology was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>