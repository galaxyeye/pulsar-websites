<?php
class SparkJobsController extends AppController {

	var $name = 'SparkJobs';

	function index() {
		$this->SparkJob->recursive = 0;
		$this->set('sparkJobs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid spark job', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('sparkJob', $this->SparkJob->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SparkJob->create();
			if ($this->SparkJob->save($this->data)) {
				$this->Session->setFlash(__('The spark job has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The spark job could not be saved. Please, try again.', true));
			}
		}
		$crawls = $this->SparkJob->Crawl->find('list');
		$users = $this->SparkJob->User->find('list');
		$this->set(compact('crawls', 'users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid spark job', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SparkJob->save($this->data)) {
				$this->Session->setFlash(__('The spark job has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The spark job could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SparkJob->read(null, $id);
		}
		$crawls = $this->SparkJob->Crawl->find('list');
		$users = $this->SparkJob->User->find('list');
		$this->set(compact('crawls', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for spark job', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SparkJob->delete($id)) {
			$this->Session->setFlash(__('Spark job deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Spark job was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>