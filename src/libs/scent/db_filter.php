<?php 

namespace Scent;

class DbFilter {

	// TODO : use fields params
  private $data = array(
      'table' => 'pageentity',
  		'tenantId' => 0,
      'startKey' => null,
  		'endKey' => null,
  		'regex' => '.+',
  		'limit' => 500,
  		'fields' => null
  );

  public function __construct($regex = null, $startKey = null, $endKey = null, $limit = 500, $table = "pageentity") {
  	$this->data['regex'] = $regex;
    $this->data['startKey'] = $startKey;
    $this->data['endKey'] = $endKey;
    $this->data['limit'] = $limit;
    $this->data['table'] = $table;
  }

  public function data() {
  	return $this->data;
  }

  public function __toString() {
  	// return json_encode($this->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  	return json_encode($this->data);
  }
}
