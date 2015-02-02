<?php
class PageEntitiesController extends AppController {

	var $name = 'PageEntities';

	function index() {
		$this->PageEntity->recursive = 0;
		$this->set('pageEntities', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid page entity', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pageEntity', $this->PageEntity->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PageEntity->create();
			if ($this->PageEntity->save($this->data)) {
				$this->Session->setFlash(__('The page entity has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page entity could not be saved. Please, try again.', true));
			}
		}
		$pageEntities = $this->PageEntity->PageEntity->find('list');
		$this->set(compact('pageEntities'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid page entity', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PageEntity->save($this->data)) {
				$this->Session->setFlash(__('The page entity has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page entity could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PageEntity->read(null, $id);
		}
		$pageEntities = $this->PageEntity->PageEntity->find('list');
		$this->set(compact('pageEntities'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page entity', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PageEntity->delete($id)) {
			$this->Session->setFlash(__('Page entity deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Page entity was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->PageEntity->recursive = 0;
		$this->set('pageEntities', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid page entity', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pageEntity', $this->PageEntity->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->PageEntity->create();
			if ($this->PageEntity->save($this->data)) {
				$this->Session->setFlash(__('The page entity has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page entity could not be saved. Please, try again.', true));
			}
		}
		$pageEntities = $this->PageEntity->PageEntity->find('list');
		$this->set(compact('pageEntities'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid page entity', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PageEntity->save($this->data)) {
				$this->Session->setFlash(__('The page entity has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The page entity could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PageEntity->read(null, $id);
		}
		$pageEntities = $this->PageEntity->PageEntity->find('list');
		$this->set(compact('pageEntities'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page entity', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PageEntity->delete($id)) {
			$this->Session->setFlash(__('Page entity deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Page entity was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>