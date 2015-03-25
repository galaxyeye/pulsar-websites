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
