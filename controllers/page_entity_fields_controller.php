<?php
class PageEntityFieldsController extends AppController {

	var $name = 'PageEntityFields';

	function index() {
		$this->PageEntityField->recursive = 0;
		$this->set('pageEntityFields', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid page entity field', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pageEntityField', $this->PageEntityField->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PageEntityField->create();
			if ($this->PageEntityField->save($this->data)) {
				$this->Session->setFlash(__('The page entity field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page entity field could not be saved. Please, try again.', true));
			}
		}
		$pageEntities = $this->PageEntityField->PageEntity->find('list');
		$this->set(compact('pageEntities'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid page entity field', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PageEntityField->save($this->data)) {
				$this->Session->setFlash(__('The page entity field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page entity field could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PageEntityField->read(null, $id);
		}
		$pageEntities = $this->PageEntityField->PageEntity->find('list');
		$this->set(compact('pageEntities'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page entity field', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PageEntityField->delete($id)) {
			$this->Session->setFlash(__('Page entity field deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Page entity field was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->PageEntityField->recursive = 0;
		$this->set('pageEntityFields', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid page entity field', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pageEntityField', $this->PageEntityField->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->PageEntityField->create();
			if ($this->PageEntityField->save($this->data)) {
				$this->Session->setFlash(__('The page entity field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page entity field could not be saved. Please, try again.', true));
			}
		}
		$pageEntities = $this->PageEntityField->PageEntity->find('list');
		$this->set(compact('pageEntities'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid page entity field', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PageEntityField->save($this->data)) {
				$this->Session->setFlash(__('The page entity field has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page entity field could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PageEntityField->read(null, $id);
		}
		$pageEntities = $this->PageEntityField->PageEntity->find('list');
		$this->set(compact('pageEntities'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page entity field', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PageEntityField->delete($id)) {
			$this->Session->setFlash(__('Page entity field deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Page entity field was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>