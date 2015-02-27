<?php 
class SeedsController extends AppController {

	var $name = 'Seeds';

	function index() {
		$crawl_id = 0;

		if (!isset($this->params['named']['crawl_id'])) {
			$this->Session->setFlash(__('You must specify a crawl id', true));
			$this->redirect(array('controller' => 'crawls', 'action' => 'index'));
		}

		$crawl_id = $this->params['named']['crawl_id'];

		$this->Seed->Crawl->recursive = -1;
		$crawl = $this->Seed->Crawl->read(null, $crawl_id);
		$this->Seed->recursive = -1;
		$seeds = $this->paginate(array('crawl_id' => $crawl_id));

		$this->set(compact('seeds', 'crawl'));
	}

	function add() {
		$crawl_id = 0;

		if (empty($this->data)) {
			if (!isset($this->params['named']['crawl_id'])) {
				$this->Session->setFlash(__('You must specify a crawl id for the page entity', true));
				$this->redirect(array('controller' => 'crawls', 'action' => 'index'));
			}

			$crawl_id = $this->params['named']['crawl_id'];
		}

		if (!empty($this->data)) {
			$crawl_id = $this->data['Seed']['crawl_id'];

			$urls = str_ireplace("\n\r", "\n", $this->data['Seed']['url']);
			$urls = trim($urls);
			$urls = explode("\n", $urls);

			$data = array('Seed' => array());
			foreach ($urls as $url) {
				array_push($data['Seed'], array(
					'url' => $url,
					'crawl_id' => $crawl_id,
					'user_id' => $this->currentUser['id'])
				);
			}

			$this->Seed->create();
			if ($this->Seed->saveAll($data['Seed'])) {
				$this->Session->setFlash(__('The seeds has been saved', true));
				$this->redirect(array('controller' => 'crawls', 'action' => 'view', $crawl_id));
			} else {
				$this->Session->setFlash(__('The seeds could not be saved. Please, try again.', true));
			}
		}

		$this->Seed->Crawl->recursive = -1;
		$crawl = $this->Seed->Crawl->read(null, $crawl_id);
		$this->set(compact('crawl'));
	}

	function ajax_add() {
		$this->autoRender = false;

		if (!empty($this->data)) {
// 			if(!$this->checkTenantPrivilege($this->data)) {
// 				echo "false";
// 			}

			$this->Seed->create();
			$this->data['Seed']['user_id'] = $this->currentUser['id'];
			if ($this->Seed->save($this->data)) {
				$this->Seed->recursive = -1;
				$seed = $this->Seed->read(null, $this->Seed->id);
				echo json_encode($seed);

				return;
			}
		}

		echo "false";
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seed', true));
			$this->redirect(array('controller' => 'crawls', 'action'=>'index'));
		}

		if(!$this->checkTenantPrivilege($id)) {
			$this->Session->setFlash(__('Privilege denied', true));
			$this->redirect(array('controller' => 'crawls', 'action' => 'index'));
		}

		$seed = $this->Seed->read(null, $id);
		if ($this->Seed->delete($id)) {
			$this->Session->setFlash(__('Seed deleted', true));
			$this->redirect(array('controller' => 'crawls', 'action'=>'view', $seed['Seed']['crawl_id']));
		}

		$this->Session->setFlash(__('Seed was not deleted', true));
		$this->redirect(array('controller' => 'crawls', 'action'=>'view', $seed['Seed']['crawl_id']));
	}

	function ajax_delete($id = null) {
		$this->autoRender = false;

		if (empty($id) || !$this->checkTenantPrivilege($id)) {
			return "false";
		}

		if (!$this->Seed->delete($id)) {
			return "false";
		}

		return $id;
	}

	function admin_index() {
  	$this->paginate['Seed'] = array('limit'=> 500, 'order' => 'Seed.id DESC');

		$this->Seed->recursive = 0;
		$this->set('seeds', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seed', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seed', $this->Seed->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Seed->create();
			if ($this->Seed->save($this->data)) {
				$this->Session->setFlash(__('The seed has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seed could not be saved. Please, try again.', true));
			}
		}
		$crawls = $this->Seed->Crawl->find('list');
		$this->set(compact('crawls'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid seed', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Seed->save($this->data)) {
				$this->Session->setFlash(__('The seed has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seed could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Seed->read(null, $id);
		}
		$crawls = $this->Seed->Crawl->find('list');
		$this->set(compact('crawls'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seed', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Seed->delete($id)) {
			$this->Session->setFlash(__('Seed deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seed was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>