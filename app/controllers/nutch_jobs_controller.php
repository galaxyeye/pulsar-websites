<?php

App::import('Lib', 'nutch/nutch_utils');

class NutchJobsController extends AppController {

	var $name = 'NutchJobs';

	function admin_index() {
		$this->NutchJob->recursive = 0;
		$this->set('nutchJobs', $this->paginate());
	}

	function parseChecker($crawl_id = null) {
		$jobId = 0;

		if (!$crawl_id && empty($this->data)) {
			$this->Session->setFlash(__('You must specify a crawl id or submit a form.', true));
			$this->set(compact('jobId'));
			return;
		}

		if ($crawl_id && !$this->checkTenantPrivilege($crawl_id)) {
			$this->Session->setFlash(__('Privilege denied.', true));
			$this->redirect(array('/'));
		}

		$checkCrawlSeed = $crawl_id ? true : false;

		$crawl = null;
		if ($checkCrawlSeed) {
			$this->loadModel('Crawl');
			$this->Crawl->contain(array('CrawlFilter', 'Seed'));
			$crawl = $this->Crawl->read(null, $crawl_id);
			$crawl['Crawl']['test_url'] = $crawl['Seed'][0]['url'];
		}

		if (!$checkCrawlSeed && !empty($this->data)) {
			// handle arbitrary submitted url
			$crawl_id = 1000000 + rand(1, 10000);
			if (isset($this->data['NutchJob']['crawl_id'])) {
				$crawl_id = $this->data['NutchJob']['crawl_id'];
			}

			$crawl = array(
					'Crawl' => array(
							'id' => $crawl_id,
							'crawlId' => null,
							'configId' => 'default',
							'user_id' => $this->currentUser['id'],
							'test_url' => $this->data['NutchJob']['url']
					),
					'CrawlFilter' => array(
							array(
									'page_type' => 'NONE',
									'url_filter' => '',
									'text_filter' => '',
									'parse_block_filter' => ''
							)
					)
			);
		}

		$msg = "";

		// create nutch config
		$configId = $this->JobManager->createNutchConfig($crawl);
		if (empty($configId)) {
			$this->Session->setFlash(__('Can not create config id.', true));
			$this->set(compact('jobId'));
			return;
		}
		$crawl['Crawl']['configId'] = $configId;

		$msg .= "Config Id : $configId\n";

		$jobId = $this->JobManager->runParseChecker($crawl);
		if ($jobId === false || stripos($jobId, 'exception') !== false) {
			$msg = json_decode($jobId);

			$jobId = 0;
			$this->Session->setFlash(__("任务失败。。。", true));
		}
		else {
			$this->Session->setFlash(__('任务已提交，请稍候等待结果。。。', true));
		}

		$nutchClient = new NutchClient();
		$nutchConfig = $nutchClient->getNutchConfig($configId);
		$nutchConfig = filterNutchConfig($nutchConfig);

		$this->data['NutchJob'] = array(
				'crawl_id' => $crawl['Crawl']['id'],
				'jobId' => $jobId,
				'url' => $crawl['Crawl']['test_url'],
				'nutchConfig' => $nutchConfig,
				'msg' => $msg
		);
	}

	function nutchConfig($configId) {
		$nutchClient = new NutchClient();
		$nutchConfig = $nutchClient->getNutchConfig($configId);
		$nutchConfig = filterNutchConfig($nutchConfig);

		$this->set(compact('nutchConfig'));
	}

	function urlFilterChecker() {
		$jobId = 0;

		if (!empty($this->data)) {
			// pr($this->data);

			$crawl = array(
					'Crawl' => array(
							'crawlId' => null,
							'configId' => 'default',
							'test_url' => $this->data['NutchJob']['url']
					),
					'CrawlFilter' => array('url_filter' => '.+')
			);

			// $jobId = $this->JobManager->runParseChecker($crawl);
			if ($jobId === false) {
				$this->Session->setFlash(__('任务失败。。。', true));
			}
			else {
				$this->Session->setFlash(__('任务已提交，请稍候等待结果。。。', true));
			}
		}

		$this->set(compact('jobId'));
	}

	function ajax_getStatus() {
		$this->autoRender = false;

		$client = new NutchClient();
		$output = $client->getNutchStatus();

		echo $output;
	}

	function ajax_getJobInfo($jobId, $realTime = false) {
		$this->autoRender = false;

		$errno = 0;
		if (empty($jobId)) {
			$errno = 404;
		}

		if ($errno) {
			echo "{errno : $errno}";
			return;
		}

		$client = new NutchClient();
		echo $client->getjobInfo($jobId);
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
