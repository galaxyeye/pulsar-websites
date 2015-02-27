<?php
class GroupsController extends AppController {

	public function admin_index(){
		$this->set('groups', $this->Group->find('all', array('conditions' => array('parent_id' => 0))));
	}

	public function admin_view($id = null){
		if (!is_numeric($id) || !$id){
			$this->cakeError('invalidArgument');
		}

		$current = $this->Group->read(null, $id);
		$children = array();
		if (!empty($current)){
			$children = $this->Group->children($id);
		}
		$this->set(compact('current', 'children'));
	}

	public function admin_add(){
		if (empty($this->data) && 
			(!isset($this->params['named']['for']) || !is_numeric($this->params['named']['for']))){
			$this->cakeError('invalidArgument');
		}

		if (!empty($this->data)){
			if ($this->Group->save($this->data)){
				$this->flash(__('Group has been saved successfully', true), 'index');
			}
			else {
				$this->flash(__('Can not save the group', true), 'index');
			}
		}
		else {
			$parent_id = $this->params['named']['for'];
			if (0 == $parent_id){
				$root = $this->Group->read(null, $parent_id);
				if (empty($root)){
					// Add root
					$this->set('parent', array('Group' => array('id' => 0, 'name' => '')));
				}
				else{
					$this->flash(__('Root node has been added already', true), 'index');
				}
			}
			else {
				$parent = $this->Group->read(null, $parent_id);
				if (empty($parent)){
					$this->flash(__('Parent node does not exist', true), 'index');
				}
				else {
					$this->set('parent', $parent);
				}
			}
		}
	}

	public function admin_edit($id = null){
		if (empty($this->data) && !is_numeric($id)){
			$this->cakeError('invalidArgument');
		}

		if (!empty($this->data)){
			if ($this->Group->save($this->data)){
				$this->flash(__('Group has been saved successfully', true), array('action' => 'view', $this->data['Group']['parent_id']));
			}
			else{
				$this->flash(__('Group can not be saved. Please try again', true), 'index');
			}
		}

		if (empty($this->data)){
			$this->data = $this->Group->read(null, $id);
		}
	}
}
?>
