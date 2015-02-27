<?php 
class RemoteCommand {
	private $jobConfig;
	private $jobInfo;
	private $timeout;

	public function RemoteCommand($jobConfig) {
		$this->jobConfig = $jobConfig;
	}

	public function getJobConfig() {
		return $this->jobConfig;
	}

	public function setJobConfig($jobConfig) {
		$this->jobConfig = $jobConfig;
	}

	public function getJobInfo() {
		return $this->jobInfo;
	}

	public function setJobInfo($jobInfo) {
		$this->jobInfo = $jobInfo;
	}

	public function getTimeout() {
		return $this->timeout;
	}

	public function setTimeout($timeout) {
		$this->timeout = $timeout;
	}
}
