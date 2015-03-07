<?php 
class DbFilter {

  private $data = array(
      'batchId' => null,
      'startKey' => null,
      'endKey' => null,
      'keysReversed' => false,
      'fields' => null
  );

  public function __construct($batchId, $startKey, $endKey = null, $fields = null) {
    $this->data['batchId'] = $batchId;
    $this->data['startKey'] = $startKey;
    $this->data['endKey'] = $endKey;
    $this->data['fields'] = $fields;
  }

  public function addField($field) {
  	$this->data['field'] = $field;
  }

  public function setFields($fields) {
  	$this->data['fields'] = $fields;
  }

  public function data() {
  	return $this->data;
  }

  public function __toString() {
  	// return json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  	return json_encode($this->data);
  }
}
