<?php
class AreasController extends AppController{

	public $components = array('RequestHandler');

	public function admin_index(){
		$nextOrder = 1;
		$this->Area->recursive = 1;
		$subAreas = $this->Area->find('all', array('conditions' => array('Area.root' => '0')));

		if (!empty($subAreas)){
			$area = end($subAreas);
			$nextOrder = $area['Area']['order'] + 1;
		}

		$this->set('current', null);
		$this->set('parent', null);
		$this->set('subAreas', $subAreas);
		$this->set('nextOrder', $nextOrder);
		$this->set('layer', 1);
	}

	public function admin_view($id = null){
		if ($id == NULL || $id == 0){
			$this->redirect('error');
			exit();
		}

		$this->Area->recursive = 1;
		$this->Area->id = $id;
		$data = $this->Area->read();
		$current = $data['Area'];
		$parent = $data['Parent'];
		$subAreas = $this->Area->find('all', array('conditions' => array('Area.root' => $id)));

		$nextOrder = 1;
		if (!empty($subAreas)){
			$area = end($subAreas);
			$nextOrder = $area['Area']['order'] + 1;
		}

		$layer = 1;
		if ($current != NULL){
			$layer = $current['layer'];
		}

		$this->set('current', $current);
		$this->set('parent', $parent);
		$this->set('subAreas', $subAreas);
		$this->set('nextOrder', $nextOrder);
		$this->set('layer', $layer);
	}

	public function admin_edit($id = null){
		if ($this->RequestHandler->isAjax()){
			if (!empty($this->data)){
				echo 'hello'.$id;
			}
		}

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function admin_save(){
		if ($this->RequestHandler->isAjax()){
			if (!empty($this->params['form']) && isset($this->params['form']['id'])){
				$id = $this->params['form']['id'];
				if ($id != 0){
					// update
					$this->Area->id = $id;
					$this->Area->recursive = 0;
					$old = $this->Area->read();

					$data = array
					(
						'Area' => array
						(
							'id' => $id,
							'name' => $this->params['form']['name'],
							'root' => $old['Area']['root'],
							'children' => $old['Area']['children'],
							'layer' => $old['Area']['layer'],
							'order' => $this->params['form']['order'],
							'is_open' => $this->params['form']['is_open']
						)
					);

					$this->Area->save($data);
					$this->log('Record'.$old['Area']['name'].' has been updated.', LOG_INFO);
				}else {
					// create
					$data = array
					(
						'Area' => array
						(
							'id' => NULL,
							'name' => $this->params['form']['name'],
							'root' => $this->params['form']['root'],
							'children' => 0,
							'layer' => $this->params['form']['layer'],
							'order' => $this->params['form']['order'],
							'is_open' => $this->params['form']['is_open']
						)
					);

					// create the record.
					$this->Area->save($data);
					$newId = $this->Area->id;
					$this->log('New area record'.$data.' has been created.', LOG_INFO);

					// update parent.
					$parentId = $data['Area']['root'];
					if ($parentId != 0){
						$this->Area->id = $parentId;
						$parent = $this->Area->read();
						$this->Area->saveField('children', $parent['Area']['children'] + 1);
						$this->log('Parent for '.$data['Area']['name'].'\'s children field has been updated.', LOG_INFO);
					}

					echo $newId;
				}
			}
		}

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function admin_del(){
		$ok = $this->Acl->check($group.'/'.$user, 'AreasController/Vampire', '*');

		if ($ok){
			if ($this->RequestHandler->isAjax()){
				if (!empty($this->params['form']) && isset($this->params['form']['id'])){
					$id = $this->params['form']['id'];
	
					$this->Area->delete($id, false);
					$this->log('The area'.$id.' has been deleted.', LOG_INFO);
				}
			}
	
			Configure::Write('debug', 0);
			$this->autoRender = false;
			exit();
		}
	}

	public function loadChildren($id = null){
		if ($this->RequestHandler->isAjax()){
			$id = is_null($id) ? 0 : $id;
			$this->Area->recursive = -1;
			$data = $this->Area->find('list', array('conditions'=>array('Area.root'=>$id), 'fields'=>array('Area.id', 'Area.name')));
			echo json_encode($data);
		}

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}
}
?>
