<?php
class FeatureBlockTextsController extends AppController {

	var $name = 'FeatureBlockTexts';

	function index() {
		$this->FeatureBlockText->recursive = 0;
		$this->set('featureBlockTexts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid feature block text', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('featureBlockText', $this->FeatureBlockText->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->FeatureBlockText->create();
			if ($this->FeatureBlockText->save($this->data)) {
				$this->Session->setFlash(__('The feature block text has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feature block text could not be saved. Please, try again.', true));
			}
		}
		$featureBlockTexts = $this->FeatureBlockText->FeatureBlockText->find('list');
		$extractFeatures = $this->FeatureBlockText->ExtractFeature->find('list');
		$this->set(compact('featureBlockTexts', 'extractFeatures'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid feature block text', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FeatureBlockText->save($this->data)) {
				$this->Session->setFlash(__('The feature block text has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feature block text could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FeatureBlockText->read(null, $id);
		}
		$featureBlockTexts = $this->FeatureBlockText->FeatureBlockText->find('list');
		$extractFeatures = $this->FeatureBlockText->ExtractFeature->find('list');
		$this->set(compact('featureBlockTexts', 'extractFeatures'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for feature block text', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FeatureBlockText->delete($id)) {
			$this->Session->setFlash(__('Feature block text deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Feature block text was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->FeatureBlockText->recursive = 0;
		$this->set('featureBlockTexts', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid feature block text', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('featureBlockText', $this->FeatureBlockText->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->FeatureBlockText->create();
			if ($this->FeatureBlockText->save($this->data)) {
				$this->Session->setFlash(__('The feature block text has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feature block text could not be saved. Please, try again.', true));
			}
		}
		$featureBlockTexts = $this->FeatureBlockText->FeatureBlockText->find('list');
		$extractFeatures = $this->FeatureBlockText->ExtractFeature->find('list');
		$this->set(compact('featureBlockTexts', 'extractFeatures'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid feature block text', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FeatureBlockText->save($this->data)) {
				$this->Session->setFlash(__('The feature block text has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feature block text could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FeatureBlockText->read(null, $id);
		}
		$featureBlockTexts = $this->FeatureBlockText->FeatureBlockText->find('list');
		$extractFeatures = $this->FeatureBlockText->ExtractFeature->find('list');
		$this->set(compact('featureBlockTexts', 'extractFeatures'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for feature block text', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FeatureBlockText->delete($id)) {
			$this->Session->setFlash(__('Feature block text deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Feature block text was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>