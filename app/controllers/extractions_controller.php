<?php 
class ExtractionsController extends AppController {

	var $name = 'Extractions';

	function index() {
  	$this->paginate['Extraction'] = array('limit'=> 500, 'order' => 'Extraction.id DESC');

		$this->Extraction->recursive = 0;
		$this->set('extractions', $this->paginate(array('Extraction.user_id' => $this->currentUser['id'])));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid extraction', true));
			$this->redirect(array('action' => 'index'));
		}

		if(!$this->checkTenantPrivilege($id)) {
			$this->Session->setFlash(__('Privilege denied', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->set('extraction', $this->Extraction->read(null, $id));
	}

	function add() {
		if (isset($this->params['named']['crawl_id'])) {
			$crawlId = $this->params['named']['crawl_id'];
			$this->_addForCrawl($crawlId);
		}
		else {
			$this->_addArbitrary();
		}
	}

	function _addArbitrary() {
		if (!empty($this->data)) {
			$this->data['Extraction']['user_id'] = $this->currentUser['id'];

			$this->Extraction->create();
			if ($this->Extraction->save($this->data)) {
				$this->Session->setFlash(__('The extraction has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extraction could not be saved. Please, try again.', true));
			}
		}
		
		$crawls = $this->Extraction->Crawl->find('list');
		$this->set(compact('crawls'));
	}

	function _addForCrawl($crawlId) {
		if (!empty($this->data)) {
			$crawlId = $this->data['Extraction']['crawl_id'];

			$this->Extraction->create();
			$this->data['Extraction']['user_id'] = $this->currentUser['id'];
			if ($this->Extraction->save($this->data)) {
				$this->Session->setFlash(__('The extraction has been saved', true));
				$this->redirect(array('controller' => 'crawls', 'action' => 'view', $crawlId));
			} else {
				$this->Session->setFlash(__('The extraction could not be saved. Please, try again.', true));
			}
		}

		$this->Extraction->Crawl->recursive = -1;
		$crawl = $this->Extraction->Crawl->read(null, $crawlId);
		$this->set(compact('crawl'));
	}

	function ajax_saveRules() {
		$this->autoRender = false;

		$data = $this->params['form'];
		$result = array('errno' => 0, 'message' => '');

		$this->loadModel('Crawl');
		$this->Crawl->contain('Extraction');
		$crawl = $this->Crawl->read(null, $data['crawlId']);

		/**
		 * 1. save Extraction
		 * */
		$extraction = array(
				'Extraction' => array(
						'name' => $crawl['Crawl']['name'],
						'user_id' => $this->currentUser['id'],
						'crawl_id' => $crawl['Crawl']['id']
				)
		);

		$this->Extraction->create();
		if (!$this->Extraction->save($extraction)) {
			$result['errno'] = 1;
			$result['message'] .= "Can not save Extraction. Please, try again.";
			die(json_encode($result));
		}
		$result['extractionId'] = $this->Extraction->id;

		/**
		 * 1. save PageEntity
		 * */
		$pageEntity = array(
			'PageEntity' => array(
				'name' => $data['name'],
				'url_pattern' => '',
				'text_pattern' => '',
				'block_filter' => '',
				'extraction_id' => $this->Extraction->id,
				'user_id' => $this->currentUser['id']
			)
		);

		$this->Extraction->PageEntity->create();
		if (!$this->Extraction->PageEntity->save($pageEntity)) {
			$result['errno'] = 2;
			$result['message'] .= "Can not save PageEntity. Please, try again.";
			die(json_encode($result));
		}
		$result['pageEntityId'] = $this->Extraction->PageEntity->id;

		/**
		 * 1. save PageEntityField
		 * */
		$pageEntityFields = array('PageEntityField');
		foreach ($data['rules'] as $k => $v) {
			$pageEntityField = array(
					'name' => $k,
					'css_path' => $v,
					'extractor_class' => 'TextExtractor',
					'sql_data_type' => 'varchar(255)',
					'page_entity_id' => $this->Extraction->PageEntity->id,
					'user_id' => $this->currentUser['id']
			);

			array_push($pageEntityFields['PageEntityField'], $pageEntityField);
		}

		$this->loadModel('PageEntityField');
		$this->PageEntityField->create();
		if (!$this->PageEntityField->saveAll($pageEntityFields)) {
			$result['errno'] = 3;
			$result['message'] .= "Can not save PageEntityField. Please, try again.";
			die(json_encode($result));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid extraction', true));
			$this->redirect(array('action' => 'index'));
		}

		if (!empty($this->data)) {
			if(!$this->checkTenantPrivilege($this->data)) {
				$this->Session->setFlash(__('Privilege denied', true));
				$this->redirect(array('action' => 'index'));
			}

			if ($this->Extraction->save($this->data)) {
				$this->Session->setFlash(__('The extraction has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The extraction could not be saved. Please, try again.', true));
			}
		}

		if (empty($this->data)) {
			if(!$this->checkTenantPrivilege($id)) {
				$this->Session->setFlash(__('Privilege denied', true));
				$this->redirect(array('action' => 'index'));
			}

			$this->data = $this->Extraction->read(null, $id);
		}

		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for extraction', true));
			$this->redirect(array('action'=>'index'));
		}

		if(!$this->checkTenantPrivilege($id)) {
			$this->Session->setFlash(__('Privilege denied', true));
			$this->redirect(array('action' => 'index'));
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

	function startExtraction() {
		if (!empty($this->data)) {
			if(!$this->__checkUserPrivilege($this->data['Extraction']['id'])) {
				$this->Session->setFlash(__('Privilege denied', true));
				$this->redirect(array('action' => 'index'));
			}

			$id = $this->data['Extraction']['id'];
			$this->loadModel('Crawl');
			$crawl = $this->Crawl->read(null, $id);
			$status = $crawl['Crawl']['status'];
			if ($status != 'NOT-START') {
				$this->Session->setFlash(__('The crawl could not be saved. Please, try again.', true));
				$this->redirect(array('action' => 'index'));
			}
	
			$nutchServerUrl = "http://localhost:8182/";
			$cURL = new cURL();
	
			$this->Crawl->id = $id;
			if ($this->Crawl->saveField('status', 'CRAWLING')) {
				$this->Session->setFlash(__('The crawl has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The crawl could not be saved. Please, try again.', true));
			}
		}
	
		if (empty($this->data)) {
			$this->Session->setFlash(__('The crawl has been saved', true));
			$this->redirect(array('action' => 'index'));
		}
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
		$crawls = $this->Extraction->Crawl->find('list');
		$users = $this->Extraction->User->find('list');
		$this->set(compact('crawls', 'users'));
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
		$crawls = $this->Extraction->Crawl->find('list');
		$users = $this->Extraction->User->find('list');
		$this->set(compact('crawls', 'users'));
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
