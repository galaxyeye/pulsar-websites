<?php
class LandlordsController extends AppController {

	var $name = 'Landlords';
	
	var $paginate = array('Landlord' => array('order' => 'created desc'));

	public function beforeFilter() {
	 parent::beforeFilter();
	
	 $this->Auth->allow('index', 'view', 'add');
	}

	function index() {
		$this->Landlord->recursive = 0;
		$this->set('landlords', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid landlord', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->set('landlord', $this->Landlord->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Landlord->create();
			if ($this->Landlord->save($this->data)) {
				$this->Session->setFlash(__('The landlord has been saved', true));
				$this->redirect(array('action' => 'view', $this->Landlord->id));
			} else {
				$this->Session->setFlash(__('The landlord could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_index() {
		$this->Landlord->recursive = 0;
		$this->set('landlords', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid landlord', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('landlord', $this->Landlord->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Landlord->create();
			if ($this->Landlord->save($this->data)) {
				$this->Session->setFlash(__('The landlord has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The landlord could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_mark_read($id = null) {
	 if (!$id && empty($this->data)) {
	  $this->Session->setFlash(__('Invalid landlord', true));
	  $this->redirect(array('action' => 'index'));
	 }

	 $this->Landlord->updateField('read', 1);
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid landlord', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Landlord->save($this->data)) {
				$this->Session->setFlash(__('The landlord has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The landlord could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Landlord->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for landlord', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Landlord->delete($id)) {
			$this->Session->setFlash(__('Landlord deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Landlord was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>