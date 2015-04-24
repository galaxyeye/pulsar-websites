<?php 

namespace Nutch;

\App::import('Lib', array(
	'http_client',
	'nutch/job_config',
	'nutch/nutch_config',
	'nutch/db_filter'
));

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
	private $nutchUrl = NUTCH_SERVER;

	private $httpClient;

	function __construct() {
		$this->httpClient = new \HttpClient();
	}

	public function getNutchStatus() {
		return $this->httpClient->get_content($this->nutchUrl."/admin");
	}

	/**
	 * @return jobId as string
	 * */
	public function executeJob($jobConfig) {
		return $this->httpClient->postJson($this->nutchUrl."/job/create", $jobConfig->__toString());
	}

	public function stopJob($jobId) {
		return $this->httpClient->get_content($this->nutchUrl."/job/$jobId/stop");
	}

	public function abortJob($jobId) {
		return $this->httpClient->get_content($this->nutchUrl."/job/$jobId/abort");
	}

	public function getjobs() {
		return $this->httpClient->get_content($this->nutchUrl."/job/");
	}

	public function getjobInfo($jobId) {
		return $this->httpClient->get_content($this->nutchUrl."/job/".$jobId);
	}

	public function createNutchConfig($nutchConfig) {
		return $this->httpClient->postJson($this->nutchUrl."/config/create", $nutchConfig->__toString());
	}

	public function listNutchConfig() {
		return $this->httpClient->get_content($this->nutchUrl."/config");
	}

	public function getNutchConfig($nutchConfigId) {
		return $this->httpClient->get_content($this->nutchUrl."/config/$nutchConfigId");
	}

	public function deleteNutchConfig($nutchConfigId) {
		return $this->httpClient->get_content($this->nutchUrl."/config/".$configId);
	}

	public function getNutchConfigPropert($nutchConfigId, $propertId) {
		return $this->httpClient->get_content($this->nutchUrl."/config/$nutchConfigId/$propertId");
	}

	public function updateConfigProperty($nutchConfigId, $propertId, $propertyValue) {
		return $this->httpClient->put($this->nutchUrl."/config/$nutchConfigId/$propertId", $propertyValue);
	}

	/**
	 * @property $args \Nutch\DbFilter or array
	 * */
	public function query($args) {
		if (is_object($args)) {
			$args = $args->__toString();
		}
		else if (is_array($args)) {
			$args = json_encode($args);
		}

		return $this->httpClient->postJson($this->nutchUrl."/db", $args);
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
		return $this->httpClient->postJson($this->nutchUrl."/seed/create", json_encode($seedList));
	}

	public function parseChecker($url) {
		return $this->httpClient->putJson($this->nutchUrl."/tools/parseChecker", json_encode($url));
	}

}
