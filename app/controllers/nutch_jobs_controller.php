<?php
class NutchJobsController extends AppController {

	var $name = 'NutchJobs';

	function index() {
		$this->NutchJob->recursive = 0;
		$this->set('nutchJobs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid nutch job', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('nutchJob', $this->NutchJob->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->NutchJob->create();
			if ($this->NutchJob->save($this->data)) {
				$this->Session->setFlash(__('The nutch job has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The nutch job could not be saved. Please, try again.', true));
			}
		}
		$crawls = $this->NutchJob->Crawl->find('list');
		$users = $this->NutchJob->User->find('list');
		$this->set(compact('crawls', 'users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid nutch job', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->NutchJob->save($this->data)) {
				$this->Session->setFlash(__('The nutch job has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The nutch job could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->NutchJob->read(null, $id);
		}
		$crawls = $this->NutchJob->Crawl->find('list');
		$users = $this->NutchJob->User->find('list');
		$this->set(compact('crawls', 'users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for nutch job', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->NutchJob->delete($id)) {
			$this->Session->setFlash(__('Nutch job deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Nutch job was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function admin_index() {
		$this->NutchJob->recursive = 0;
		$this->set('nutchJobs', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid nutch job', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('nutchJob', $this->NutchJob->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->NutchJob->create();
			if ($this->NutchJob->save($this->data)) {
				$this->Session->setFlash(__('The nutch job has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The nutch job could not be saved. Please, try again.', true));
			}
		}
		$crawls = $this->NutchJob->Crawl->find('list');
		$users = $this->NutchJob->User->find('list');
		$this->set(compact('crawls', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid nutch job', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->NutchJob->save($this->data)) {
				$this->Session->setFlash(__('The nutch job has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The nutch job could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->NutchJob->read(null, $id);
		}
		$crawls = $this->NutchJob->Crawl->find('list');
		$users = $this->NutchJob->User->find('list');
		$this->set(compact('crawls', 'users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for nutch job', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->NutchJob->delete($id)) {
			$this->Session->setFlash(__('Nutch job deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Nutch job was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	private function _inject($crawlId) {
		$this->_executeRemoteCrawlCommand($crawlId, 'INJECT');
	}
	
	private function _executeRemoteCrawlCommand($crawlId, $jobType) {
		$this->Crawl->contain(array('Seed' => array('fields' => array('id', 'url'))));
		$crawl = $this->Crawl->read(null, $crawlId);
	
		$lastJobStatus = $crawl['Crawl']['job_status'];
		$status = $this->_checkJobStatus($lastJobStatus, $jobType);
	
		if ($status !== false) {
			$executor = new RemoteCmdExecutor();
			$jobId = $executor->executeRemoteCommand($crawl['Crawl'], $jobType);
	
			$this->log("job id : $jobId", 'info');
	
			if ($jobId !== false) {
				$this->_updateCrawlStatus($crawlId, $jobId, $jobType, $status[0], $status[1]);
			}
	
			return $jobId;
		}
	
		return false;
	}
	
	private function _checkJobStatus($lastStatus, $jobType) {
		global $crawlStatusChangeMap;
		global $jobType2Status;
	
		$expectedNextStatus = $crawlStatusChangeMap[$lastStatus];
		$desiredNewStatus = $jobType2Status[$jobType];
	
		if ($expectedNextStatus === $desiredNewStatus) {
			return array($lastStatus, $desiredNewStatus);
		}
	
		$this->log("Bad status: $expectedNextStatus exprected
				while $desiredNewStatus desired", "debug");
	
		return false;
	}
}
