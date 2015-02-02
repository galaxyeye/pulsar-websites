<?php
class EnquiriesController extends AppController {

	var $name = 'Enquiries';

	var $paginate = array('Enquiry' => array('order' => 'created desc'));

	public function beforeFilter() {
	 parent::beforeFilter();
	
	 $this->Auth->allow('index', 'view', 'arrange', 'add');
	}

	function index() {
		$this->Enquiry->recursive = 0;
		$this->set('enquiries', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid enquiry', true));
			$this->redirect(array('action' => 'add'));
		}
		$this->set('enquiry', $this->Enquiry->read(null, $id));
	}

	function arrange() {
	  // pr($_COOKIE);

	  // pr($this->data);
	  $this->add();
	}

	function add() {
		if (!empty($this->data)) {

		 $this->Enquiry->create();

		 if (isset($this->data['Enquiry']['budget_lower'])) $this->data['Enquiry']['budget'] = $this->data['Enquiry']['budget_lower'].' - '.$this->data['Enquiry']['budget_upper'];
		 if (isset($this->data['Enquiry']['house_type']) && !empty($this->data['Enquiry']['house_type'])) $this->data['Enquiry']['house_type'] = implode(',', $this->data['Enquiry']['house_type']);
		 if (isset($this->data['Enquiry']['furnishings']) && !empty($this->data['Enquiry']['furnishings'])) $this->data['Enquiry']['furnishings'] = implode(',', $this->data['Enquiry']['furnishings']);
		 if (isset($this->data['Enquiry']['property_ids']) && !empty($this->data['Enquiry']['property_ids'])) $this->data['Enquiry']['property_ids'] = implode(',', $this->data['Enquiry']['property_ids']);

		 if ($this->Enquiry->save($this->data)) {
			 $this->Session->setFlash(__('The enquiry has been saved', true));
			 $this->redirect(array('action' => 'view', $this->Enquiry->id));
		 } else {
		   $this->Session->setFlash(__('The enquiry could not be saved. Please, try again.', true));
		 }
		}

		$this->loadModel('Area');
		$this->Area->recursive = -1;
		$areas1 = $this->Area->find('list', array('conditions' => array('city_id' => 1)));
		$areas2 = $this->Area->find('list', array('conditions' => array('city_id' => 2)));
		$areas3 = $this->Area->find('list', array('conditions' => array('city_id' => 3)));

		$this->set(compact('areas1', 'areas2', 'areas3'));
	}

	function admin_index() {
		$this->Enquiry->recursive = 0;
		$this->set('enquiries', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid enquiry', true));
			$this->redirect(array('action' => 'index'));
		}

		$enquiry = $this->Enquiry->read(null, $id);

		$arranged_properties2 = array();
		if (!empty($enquiry['Enquiry']['property_ids'])) {
		  $this->loadModel('Property');
		  $this->Property->recursive = -1;
		  $arranged_properties2 = $this->Property->find('all', array('conditions' => array('id' => explode(',', $enquiry['Enquiry']['property_ids']))));
		}

		$this->set(compact('enquiry', 'arranged_properties2'));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Enquiry->create();
			if ($this->Enquiry->save($this->data)) {
				$this->Session->setFlash(__('The enquiry has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The enquiry could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_markRead($id = null) {
		if ($this->Enquiry->saveField('status', 'Read')) {
	    $this->Session->setFlash(__('The enquiry has been saved', true));
	    $this->redirect(array('action' => 'index'));
	  }
	  else {
	    $this->Session->setFlash(__('The enquiry could not be saved. Please, try again.', true));
	  }

	  $this->redirect(array('action' => 'index'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid enquiry', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Enquiry->save($this->data)) {
				$this->Session->setFlash(__('The enquiry has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The enquiry could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Enquiry->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for enquiry', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Enquiry->delete($id)) {
			$this->Session->setFlash(__('Enquiry deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Enquiry was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>