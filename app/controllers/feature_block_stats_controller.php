<?php
class FeatureBlockStatsController extends AppController {

	var $name = 'FeatureBlockStats';

	function index() {
		$this->FeatureBlockStat->recursive = 0;
		$this->set('featureBlockStats', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid feature block stat', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('featureBlockStat', $this->FeatureBlockStat->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->FeatureBlockStat->create();
			if ($this->FeatureBlockStat->save($this->data)) {
				$this->Session->setFlash(__('The feature block stat has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feature block stat could not be saved. Please, try again.', true));
			}
		}
		$extractFeatures = $this->FeatureBlockStat->ExtractFeature->find('list');
		$this->set(compact('extractFeatures'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid feature block stat', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FeatureBlockStat->save($this->data)) {
				$this->Session->setFlash(__('The feature block stat has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feature block stat could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FeatureBlockStat->read(null, $id);
		}
		$extractFeatures = $this->FeatureBlockStat->ExtractFeature->find('list');
		$this->set(compact('extractFeatures'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for feature block stat', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FeatureBlockStat->delete($id)) {
			$this->Session->setFlash(__('Feature block stat deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Feature block stat was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->FeatureBlockStat->recursive = 0;
		$this->set('featureBlockStats', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid feature block stat', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('featureBlockStat', $this->FeatureBlockStat->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->FeatureBlockStat->create();
			if ($this->FeatureBlockStat->save($this->data)) {
				$this->Session->setFlash(__('The feature block stat has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feature block stat could not be saved. Please, try again.', true));
			}
		}
		$extractFeatures = $this->FeatureBlockStat->ExtractFeature->find('list');
		$this->set(compact('extractFeatures'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid feature block stat', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FeatureBlockStat->save($this->data)) {
				$this->Session->setFlash(__('The feature block stat has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feature block stat could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FeatureBlockStat->read(null, $id);
		}
		$extractFeatures = $this->FeatureBlockStat->ExtractFeature->find('list');
		$this->set(compact('extractFeatures'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for feature block stat', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FeatureBlockStat->delete($id)) {
			$this->Session->setFlash(__('Feature block stat deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Feature block stat was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>