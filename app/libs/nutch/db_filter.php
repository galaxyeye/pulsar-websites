<?php 

namespace Nutch;

class DbFilter {

  private $data = array(
      'startKey' => null,
      'endKey' => null,
  		'urlFilter' => '.+',
      'fields' => null,
  		'start' => 0,
  		'limit' => 100,
      'batchId' => null,
      'keysReversed' => false
  );

  public function __construct($startKey = null, $endKey = null, $urlFilter = null, $fields = null,
  		$limit = 100, $batchId = null) {
    $this->data['startKey'] = $startKey;
    $this->data['endKey'] = $endKey;
    $this->data['urlFilter'] = $urlFilter;
    $this->data['fields'] = $fields;
    $this->data['limit'] = $limit;
    $this->data['batchId'] = $batchId;
  }

  public function setStart($start) {
  	$this->data['start'] = $start;
  }

  public function setStartKey($startKey) {
  	$this->data['startKey'] = $startKey;
  }

  public function setEndKey($endKey) {
  	$this->data['endKey'] = $endKey;
  }

  public function setUrlFilter($rulRegex) {
  	$this->data['urlFilter'] = $rulRegex;
  }

  public function setFields($fields) {
  	$this->data['fields'] = $fields;
  }

  public function setLimit($limit) {
  	$this->data['limit'] = $limit;
  }

  public function setBatchId($batchId) {
  	$this->data['batchId'] = $batchId;
  }

  public function data() {
  	return $this->data;
  }

  public function __toString() {
  	// return json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  	return json_encode($this->data);
  }
}
