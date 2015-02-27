<?php 
class PageEntitiesController extends AppController {

	var $name = 'PageEntities';

	function index() {
  	$this->paginate['PageEntity'] = array('limit'=> 500, 'order' => 'PageEntity.id DESC');

		$this->PageEntity->recursive = 1;
		$this->set('pageEntities', $this->paginate(array('PageEntity.user_id' => $this->currentUser['id'])));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid page entity', true));
			$this->redirect(array('action' => 'index'));
		}

		if(!$this->checkTenantPrivilege($id)) {
			$this->Session->setFlash(__('Privilege denied', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->set('pageEntity', $this->PageEntity->read(null, $id));
	}

	function add() {
		$extraction_id = 0;

		if (empty($this->data)) {
			if (!isset($this->params['named']['extraction_id'])) {
				$this->Session->setFlash(__('You must specify a extraction id for the page entity', true));
				$this->redirect(array('action' => 'index'));
			}

			$extraction_id = $this->params['named']['extraction_id'];
			$this->set('extraction', $this->PageEntity->Extraction->read(null, $extraction_id));
		}

		if (!empty($this->data)) {
			$extraction_id = $this->data['PageEntity']['extraction_id'];

			$this->PageEntity->create();
			$this->data['PageEntity']['user_id'] = $this->currentUser['id'];
			if ($this->PageEntity->save($this->data)) {
				$this->Session->setFlash(__('The page entity has been saved', true));
				$this->redirect(array('controller' => 'extractions', 'action' => 'view', $extraction_id));
			} else {
				$this->Session->setFlash(__('The page entity could not be saved. Please, try again.', true));
			}
		}

		$this->set(compact('extraction_id'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid page entity', true));
			$this->redirect(array('action' => 'index'));
		}

		if (!empty($this->data)) {
			if ($this->PageEntity->save($this->data)) {
				$this->Session->setFlash(__('The page entity has been saved', true));

				$pageEntity = $this->PageEntity->read(null, $this->data['PageEntity']['id']);
				$this->redirect(array('controller' => 'extractions', 'action' => 'view', 
						$pageEntity['PageEntity']['extraction_id']));
			} else {
				$this->Session->setFlash(__('The page entity could not be saved. Please, try again.', true));
			}
		}

		if (empty($this->data)) {
			$this->data = $this->PageEntity->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page entity', true));
			$this->redirect(array('action'=>'index'));
		}

		if(!$this->checkTenantPrivilege($id)) {
			$this->Session->setFlash(__('Privilege denied', true));
			$this->redirect(array('action' => 'index'));
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
