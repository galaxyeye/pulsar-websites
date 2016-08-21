<?php 

namespace Nutch;

\App::import('Lib', array(
	'http_client',
	'nutch/job_config',
	'nutch/nutch_config',
	'nutch/db_filter'
));

class NutchClient {

	// TODO : nutch url
	private $nutchUrl = NUTCH_SERVER;

	private $httpClient;

	public function __construct() {
        $this->httpClient = new \HttpClient();
	}

	public function setDebugMsg($debugMsg) {
		$this->httpClient->setDebugMsg($debugMsg);
	}

	/**
	 * @return string
	 **/
	public function getStatus() {
        return $this->httpClient->get_content($this->nutchUrl."/admin");
	}

	/**
	 * @param NutchConfig $jobConfig
	 * @return object
	 **/
	public function executeJob($jobConfig) {
		return $this->httpClient->postJson($this->nutchUrl."/job/create", $jobConfig->__toString());
	}

	public function stopJob($jobId) {
		return $this->httpClient->get_content($this->nutchUrl."/job/$jobId/stop");
	}

//	public function resumeJob($jobId) {
//		return $this->httpClient->get_content($this->nutchUrl."/job/$jobId/stop");
//	}

	public function abortJob($jobId) {
		return $this->httpClient->get_content($this->nutchUrl."/job/$jobId/abort");
	}

	public function getjobs() {
		return $this->httpClient->get_content($this->nutchUrl."/job/");
	}

	/**
	 * @param $jobId string
	 * @return string
	 */
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
		return $this->httpClient->get_content($this->nutchUrl."/config/".$nutchConfigId);
	}

	public function getNutchConfigPropert($nutchConfigId, $propertId) {
		return $this->httpClient->get_content($this->nutchUrl."/config/$nutchConfigId/$propertId");
	}

	public function updateConfigProperty($nutchConfigId, $propertId, $propertyValue) {
		return $this->httpClient->put($this->nutchUrl."/config/$nutchConfigId/$propertId", $propertyValue);
	}

	/**
	 * @param DbFilter $args or array
	 * @return object
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
	/**
	 * @param array $seedList
	 * @return object
	 **/
	public function createSeed($seedList) {
		return $this->httpClient->postJson($this->nutchUrl."/seed/create", json_encode($seedList));
	}

	/**
	 * @param object $url
	 * @return object
	 **/
	public function parseChecker($url) {
		return $this->httpClient->putJson($this->nutchUrl."/tools/parseChecker", json_encode($url));
	}

}
