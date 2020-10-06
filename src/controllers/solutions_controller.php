<?php
class SolutionsController extends AppController {

	var $name = 'Solutions';

	function admin_index() {
		$this->Solution->recursive = 0;
		$this->set('solutions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid solution', true), array('action' => 'index'));
		}
		$this->set('solution', $this->Solution->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Solution->create();
			if ($this->Solution->save($this->data)) {
				$this->flash(__('Solution saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid solution', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Solution->save($this->data)) {
				$this->flash(__('The solution has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Solution->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid solution', true)), array('action' => 'index'));
		}
		if ($this->Solution->delete($id)) {
			$this->flash(__('Solution deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Solution was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
