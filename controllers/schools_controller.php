<?php
class SchoolsController extends AppController {

	var $name = 'Schools';

	var $paginate = array(
	  'School' => array(
	    'limit' => 20,
	    'order' => 'School.modified desc',
	    'contain' => array('Area', 'Compound' => array('Area', 'CompoundImage'))
	));

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
	}

	function index() {
 	  $conditions = array();
 	  foreach($this->params['named'] as $name => $value) {
	   if (in_array($name, array('sort', 'page', 'direction'))) continue;

	   if ($name == 'key') {
	     $conditions['AND']['OR'] = array("School.name_en like '%%$value%%'", "School.name_zh like '%%$value%%'");
	     break;
	   }

     if (strpos($name, 'like') && $value != 'null') $value = $value.'%%';

	   $pair = explode(",", $value);
	   if (count($pair) == 2) {
	     $conditions["School.".$name." between ? and ?"] = array($pair[0], $pair[1]);
	   }
	   else if ($value != 'null') {
	     $conditions["School.".$name] = $value;
	   }
 	  }

 	  $conditions['School.city_id'] = $this->currentCity;

		$this->School->recursive = 2;

		$school_count = $this->School->find('count', array('conditions' => $conditions, 'contain' => $this->paginate['School']['contain']));
 	  $schools = $this->paginate($conditions);

 	  $old_filter = $this->params['named'];

		$this->loadModel('Area');
		$this->Area->recursive = -1;
		$areas = $this->Area->find('list', array('conditions' => array('city_id' => $this->currentCity)));

		$this->set(compact('school_count', 'old_filter', 'schools', 'areas'));
  }

	function admin_index() {
	  $this->paginate = array('School' => array('order' => 'School.modified desc'));
		$this->School->recursive = 0;
		$this->set('schools', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid school', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->set('school', $this->School->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
		  $this->__calc_latlng();

			$this->School->create();

			App::import('Sanitize');
			if (!empty($this->data['School']['image'])) {
				if (is_uploaded_file($this->data['School']['image']['tmp_name'])){
					$f = $this->data['School']['image'];
					$path = 'uploads/school_images/'.date("ymdHis").".".end(explode(".",low($f['name']) ));
					$dest = IMAGES.$path;

					copy($f['tmp_name'], $dest);
					unlink($f['tmp_name']);

					$this->log('File has been saved as:'.$dest, LOG_DEBUG);
					$this->data['School']['image'] = Sanitize::escape($path);
				}
				else {
					unset($this->data['School']['image']);
				}
			}

			$this->School->District->recursive = -1;
			$district = $this->School->District->read(null, $this->data['School']['district_id']);

			// SEO
			$city_id = $district['District']['city_id'];
			$this->data['School']['city_id'] = $city_id;

			$replacement = array('1' => 'Shanghai', '2' => 'Beijing', '3' => 'Guangzhou');
			$this->data['School']['meta_keywords'] = str_replace('{{city}}', $replacement[$city_id], $this->data['School']['meta_keywords']);
			$this->data['School']['meta_description'] = str_replace('{{city}}', $replacement[$city_id], $this->data['School']['meta_description']);

			$this->data['School']['name_full'] = $district['District']['name_zh'].' - '.$this->data['School']['name_en'];

			if ($this->School->save($this->data)) {
				$this->Session->setFlash(__('The school has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The school could not be saved. Please, try again.', true));
			}
		}

		$districts = $this->School->District->find('list', array('fields' => array('id', 'name_zh'), 'order' => 'id'));
		$areas = $this->School->Area->find('list', array('fields' => array('id', 'name_full'), 'order' => 'id'));

		$this->set(compact('areas', 'districts'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid school', true));
			$this->redirect(array('action' => 'index'));
		}

		if (!empty($this->data)) {
			App::import('Sanitize');

			if (!empty($this->data['School']['image'])) {
				if (is_uploaded_file($this->data['School']['image']['tmp_name'])) {
					$f = $this->data['School']['image'];
					$path = 'uploads/school_images/'.date("ymdHis").".".end(explode(".",low($f['name']) ));
					$dest = IMAGES.$path;

					copy($f['tmp_name'], $dest);
					unlink($f['tmp_name']);

					$this->log('File has been saved as:'.$dest, LOG_DEBUG);
					$this->data['School']['image'] = Sanitize::escape($path);
				}
				else {
					unset($this->data['School']['image']);
				}
			}

			$this->__calc_latlng();

			$this->School->District->recursive = -1;
			$district = $this->School->District->read(null, $this->data['School']['district_id']);
			// SEO
			$city_id = $district['District']['city_id'];
			$this->data['School']['city_id'] = $city_id;

			$replacement = array('1' => 'Shanghai', '2' => 'Beijing', '3' => 'Guangzhou');
			$this->data['School']['meta_keywords'] = str_replace('{{city}}', $replacement[$city_id], $this->data['School']['meta_keywords']);
			$this->data['School']['meta_description'] = str_replace('{{city}}', $replacement[$city_id], $this->data['School']['meta_description']);
			
			$this->data['School']['name_full'] = $district['District']['name_zh'].' - '.$this->data['School']['name_en'];

			if ($this->School->save($this->data)) {
				$this->Session->setFlash(__('The school has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The school could not be saved. Please, try again.', true));
			}
		}

		if (empty($this->data)) {
			$this->data = $this->School->read(null, $id);
		}

		$districts = $this->School->District->find('list', array('fields' => array('id', 'name_zh'), 'order' => 'id'));
		$areas = $this->School->Area->find('list', array('fields' => array('id', 'name_full'), 'order' => 'id'));

		$this->set(compact('areas', 'districts'));
  }

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for school', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->School->delete($id)) {
			$this->Session->setFlash(__('School deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('School was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function __calc_latlng() {
	 $latlng = explode(',', $this->data['School']['latlng']);
	 if (count($latlng) == 2) {
	  $this->data['School']['lat'] = $latlng[0];
	  $this->data['School']['lng'] = $latlng[1];
	 }
	 unset($this->data['School']['latlng']);
	}
}
?>