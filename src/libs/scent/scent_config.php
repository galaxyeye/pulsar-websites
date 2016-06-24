<?php 

namespace Scent;

class ScentConfig {
	
	private $data = array(
			'configId' => 'default',
			'force' => 'false',
			'params' => array()
	);

	public function __construct($configId = "default", $params = array(), $force = false) {
		$this->data['configId'] = $configId;
		$this->data['params'] = $params;
		$this->data['force'] = $force;
	}

	public function setParam($key, $value) {
		$this->data['params'][$key] = $value;
	}

	public function getConfId() {
		return configId;
	}

	public function setConflId($configId) {
		$this->data['configId'] = $configId;
	}

	public function getForce() {
		return $this->data['force'];
	}

	public function setForce($force) {
		$this->data['force'] = $force;
	}

	public function getParams() {
		return $this->data['params'];
	}

	public function setParams($params) {
		$this->data['params'] = $params;
	}

	public function getJobClassName() {
		return $this->data['jobClassName'];
	}

	public function setJobClassName($jobClass) {
		$this->data['jobClass'] = $jobClass;
	}

	public function data() {
		return $this->data;
	}

	public function __toString() {
		$data = $this->data;
	
		if (empty($data['args'])) {
			$data['args'] = new \stdClass();
		}
	
		// return json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
		return json_encode($data);
	}
}
