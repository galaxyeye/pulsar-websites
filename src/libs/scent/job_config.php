<?php 
namespace Scent;

class JobConfig {

  private $data = array(
      'crawlId' => 'crawlId',
      'type' => 'type',
      'confId' => 'default',
      'jobClassName' => null,
      'args' => array()
  );

  public function __construct($crawlId, $type, $confId = "default", $jobClassName = null) {
    $this->data['crawlId'] = $crawlId;
    $this->data['type'] = $type;
    $this->data['confId'] = $confId;
    $this->data['jobClassName'] = $jobClassName;
  }

  public function setArgument($key, $value) {
    $this->data['args'][$key] = $value;
  }

  public function getCrawlId() {
    return crawlId;
  }

  public function setCrawlId($crawlId) {
    $this->data['crawlId'] = $crawlId;
  }

  public function getType() {
    return $this->data['type'];
  }

  public function setType($type) {
    $this->data['type'] = $type;
  }

  public function getConfId() {
    return $this->data['confId'];
  }

  public function setConfId($confId) {
    $this->data['confId'] = $confId;
  }

  public function getArgs() {
    return $this->data['args'];
  }

  public function setArgs($args) {
    $this->data['args'] = $args;
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
