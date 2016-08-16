<?php 
namespace Nutch;

\App::import('Lib', 'nutch/nutch');

class JobInfo {

  private $info = array(
      'id' => 'id',
      'jobSequence' => 'jobSequence',
      'crawlId' => 'crawlId',
      'type' => 'type',
      'confId' => 'default',
      'jobClassName' => null,
      'args' => array(),
      'status' => array(),
      'process' => 0.0,

      'state' => 'state',
      'msg' => 'msg',
      'crawlId' => null,
      'result' => array()
  );

  public function __construct($crawlId, $type, $confId = "default", $jobClassName = null) {
    $this->info['crawlId'] = $crawlId;
    $this->info['type'] = $type;
    $this->info['confId'] = $confId;
    $this->info['jobClassName'] = $jobClassName;
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
