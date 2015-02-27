<?php
class PageEntityFieldsController extends AppController {

	var $name = 'PageEntityFields';

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid page entity field', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->set('pageEntityField', $this->PageEntityField->read(null, $id));
	}

	function add() {
		$page_entity_id = 0;
		$crawl_id = 0;

		if (empty($this->data)) {
			if (!isset($this->params['named']['page_entity_id']) || !isset($this->params['named']['crawl_id'])) {
				$this->Session->setFlash(__('You must specify page entity id and crawl id for the field', true));
				$this->redirect(array('controller' => 'page_entities', 'action' => 'index'));
			}

			$page_entity_id = $this->params['named']['page_entity_id'];
			$crawl_id = $this->params['named']['crawl_id'];
		}

		if (!empty($this->data)) {
			$page_entity_id = $this->data['PageEntityField']['page_entity_id'];
			$crawl_id = $this->data['PageEntityField']['crawl_id'];

			$this->PageEntityField->create();
			$this->data['PageEntityField']['user_id'] = $this->currentUser['id'];
			if ($this->PageEntityField->save($this->data)) {
				$this->Session->setFlash(__('The page entity field has been saved', true));

				if ($crawl_id != 0) {
					$this->redirect(array('controller' => 'crawls', 'action' => 'view', $crawl_id));
				}
				else {
					$this->redirect(array('controller' => 'page_entities', 'action' => 'view', $page_entity_id));
				}
			} else {
				$this->Session->setFlash(__('The page entity field could not be saved. Please, try again.', true));
			}
		}

		$this->PageEntityField->PageEntity->recursive = -1;
		$pageEntity = $this->PageEntityField->PageEntity->read(null, $page_entity_id);
		$this->set(compact('pageEntity', 'crawl_id'));
	}

	function edit($id = null) {
		$crawl_id = 0;

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('You must specify crawl id for the field', true));
			$this->redirect(array('controller' => 'page_entities', 'action' => 'index'));
		}

		if (empty($this->data)) {
			if(!$this->checkTenantPrivilege($id)) {
				$this->Session->setFlash(__('Privilege denied', true));
				$this->redirect(array('controller' => 'page_entities', 'action' => 'index'));
			}

			if (!isset($this->params['named']['crawl_id'])) {
				$this->Session->setFlash(__('You must specify crawl id for the field', true));
				$this->redirect(array('controller' => 'page_entities', 'action' => 'index'));
			}

			$crawl_id = $this->params['named']['crawl_id'];
		}

		if (!empty($this->data)) {
			if(!$this->checkTenantPrivilege($this->data)) {
				$this->Session->setFlash(__('Privilege denied', true));
				$this->redirect(array('controller' => 'page_entities', 'action' => 'index'));
			}

			$crawl_id = $this->data['PageEntityField']['crawl_id'];

			if ($this->PageEntityField->save($this->data)) {
			  $this->Session->setFlash(__('The page entity field has been saved', true));
				$this->redirect(array('controller' => 'crawls', 'action' => 'view', $crawl_id));
			} else {
				$this->Session->setFlash(__('The page entity field could not be saved. Please, try again.', true));
				$this->redirect(array('controller' => 'crawls', 'action' => 'view', $crawl_id));
			}
	  }

		if (empty($this->data)) {
			$this->data = $this->PageEntityField->read(null, $id);
			$this->set('crawl_id', $crawl_id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for page entity field', true));
			$this->redirect(array('controller' => 'page_entities', 'action' => 'index'));
		}

		$pageEntityField = $this->PageEntityField->read(null, $id);
		$pageEntityId = $pageEntityField['PageEntityField']['page_entity_id'];
		if ($this->PageEntityField->delete($id)) {
			$this->Session->setFlash(__('Page entity field deleted', true));
		  $this->redirect(array('controller' => 'page_entities', 'action' => 'view', $pageEntityId));
		}

		$this->Session->setFlash(__('Page entity field was not deleted', true));
		$this->redirect(array('controller' => 'page_entities', 'action' => 'index'));
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
