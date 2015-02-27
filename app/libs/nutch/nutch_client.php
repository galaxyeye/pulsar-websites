<?php 

App::import('Lib', array('nutch/nutch_config'));
App::import('Lib', array('nutch/job_config'));

class NutchClient {

	private static $JobType = array (
			"INJECT" => "INJECT",
			"GENERATE" => "GENERATE",
			"FETCH" => "FETCH",
			"PARSE" => "PARSE",
			"UPDATEDB" => "UPDATEDB",
			"INDEX" => "INDEX",
			"READDB" => "READDB",
			"EXTRACT" => "EXTRACT",
			"CLASS" => "CLASS"
	);

	private static $State = array (
			"IDLE",
			"RUNNING",
			"FINISHED",
			"FAILED",
			"KILLED",
			"STOPPING",
			"KILLING",
			"ANY"
	);

	// TODO : nutch url
	private $nutchUrl = "http://localhost:8081";

	function __construct() {
	}

	public function getNutchStatus() {
		return $this->_get($this->nutchUrl."/admin");
	}

	/**
	 * @return jobId as string
	 * */
	public function executeJob($jobConfig) {
		return $this->_postJson($this->nutchUrl."/job/create", $jobConfig->__toString());
	}

	public function getjobInfo($jobId) {
		return $this->_get($this->nutchUrl."/job/".$jobId);
	}

	public function createNutchConfig($nutchConfig) {
		return $this->_postJson($this->nutchUrl."/config/create", $nutchConfig->__toString());
	}

	public function getNutchConfig($nutchConfigId) {
		return $this->_get($this->nutchUrl."/config/$nutchConfigId");
	}

	public function deleteNutchConfig($nutchConfigId) {
		return $this->_get($this->nutchUrl."/config/".$configId);
	}

	public function getNutchConfigPropert($nutchConfigId, $propertId) {
		return $this->_get($this->nutchUrl."/config/$nutchConfigId/$propertId");
	}

	public function updateConfigProperty($nutchConfigId, $propertId, $propertyValue) {
		return $this->_put($this->nutchUrl."/config/$nutchConfigId/$propertId", $propertyValue);
	}

	/*********************************************************
	  $seedList = array(
				'id' => 1,
				'name' => 'ccc',
				'seedUrls' => array(
					array(
						'id' => 1,
						'url' => 'http://www.baidu.com'
					)
				)
		);
	 *********************************************************/
	public function createSeed($seedList) {
		return $this->_postJson($this->nutchUrl."/seed/create", json_encode($seedList));
	}

	private function _get($url) {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		$output = curl_exec($ch);
		curl_close($ch);

		return $output;
	}

	private function _put($url, $data) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// TODO : what is the actual content type?
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: url-encoded',
			'Content-Length: ' . strlen($data))
		);

		$output = curl_exec($ch);
		curl_close($ch);

		$this->_debugMsg($data);
	
		return $output;
	}

	private function _postJson($url, $data) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data))
		);

		$output = curl_exec($ch);
		curl_close($ch);

		$this->_debugMsg($data);

		return $output;
	}

	private function _debugMsg($message) {
		CakeLog::write('debug', $message);
		// error_log("nutch client:\t".$message);
	}
}
