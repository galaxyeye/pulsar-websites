<?php 

namespace Scent;

\App::import('Lib', array(
	'http_client',
	'scent/job_config',
	'scent/scent_config'
));

class ScentClient {

	private $scentUrl = SCENT_SERVER;

	private $httpClient;

	function __construct() {
		$this->httpClient = new \HttpClient();
	}

	public function getScentStatus() {
		return $this->httpClient->get_content($this->scentUrl."/admin");
	}

	/**
	 * @property $args \Scent\DbFilter, json encoded string or an array
	 * */
	public function query($args) {
		if (is_object($args)) {
			$args = $args->__toString();
		}
		else if (is_array($args)) {
			$args = json_encode($args);
		}

		return $this->httpClient->postJson($this->scentUrl."/db", $args);
	}

	public function extract($args) {
		return $this->httpClient->postJson($this->scentUrl."/scent/extract", json_encode($args));
	}

	/**
	 * @return jobId as string
	 * */
	public function executeJob($jobConfig) {
		return $this->httpClient->postJson($this->scentUrl."/job/create", $jobConfig->__toString());
	}

	public function getjobInfo($jobId) {
		return $this->httpClient->get_content($this->scentUrl."/job/".$jobId);
	}

	public function createScentConfig($scentConfig) {
		return $this->httpClient->postJson($this->scentUrl."/config/create", $scentConfig->__toString());
	}

	public function getScentConfig($scentConfigId) {
		return $this->httpClient->get_content($this->scentUrl."/config/$scentConfigId");
	}

	public function deleteScentConfig($scentConfigId) {
		return $this->httpClient->get_content($this->scentUrl."/config/".$configId);
	}

	public function getScentConfigPropert($scentConfigId, $propertId) {
		return $this->httpClient->get_content($this->scentUrl."/config/$scentConfigId/$propertId");
	}

	public function updateConfigProperty($scentConfigId, $propertId, $propertyValue) {
		return $this->httpClient->put($this->scentUrl."/config/$scentConfigId/$propertId", $propertyValue);
	}
}
