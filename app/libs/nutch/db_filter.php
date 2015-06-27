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
      'crawlId' => null,
  		'keysReversed' => false
  );

  public function __construct($startKey = null, $endKey = null, $urlFilter = null, $fields = null,
  		$start = 0, $limit = 100, $batchId = null, $storageCrawlId = null) {
  	$this->data['startKey'] = $startKey;
    $this->data['endKey'] = $endKey;
    $this->data['urlFilter'] = $urlFilter;
    $this->data['fields'] = $fields;
    $this->data['start'] = intval($start);
    $this->data['limit'] = intval($limit);
    $this->data['batchId'] = $batchId;

    // bad idea?
    // $this->data['crawlId'] = $storageCrawlId;
  }

  public function setStart($start) {
  	$this->data['start'] = intval($start);
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
  	$this->data['limit'] = intval($limit);
  }

  public function setBatchId($batchId) {
  	$this->data['batchId'] = $batchId;
  }

  // TODO : consider remove this
  // it's a bad idea to allocate a table for each user
  public function setCrawlId($crawlId) {
  	// $this->data['crawlId'] = $crawlId;
  }

  public function data() {
  	return $this->data;
  }

  public function __toString() {
  	// return json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  	return json_encode($this->data);
  }
}
