<?php 
namespace Nutch;

class JobInfo {

	public static $State = array(
			"IDLE" => "IDLE",
			"RUNNING" => "RUNNING",
			"FINISHED" => "FINISHED",
			"FAILED" => "FAILED",
			"KILLED" => "KILLED",
			"STOPPING" => "STOPPING",
			"KILLING" => "KILLING",
			"ANY" => "ANY",
			"CAN_NOT_CREATE" => "CAN_NOT_CREATE",
			"NOT_FOUND" => "NOT_FOUND",
			"COMPLETED" => "COMPLETED",
			"FAILED_COMPLETED" => "FAILED_COMPLETED"
	);

	private $info = array(
			'crawlId' => 'crawlId',
			'type' => 'type',
			'confId' => 'default',
			'jobClassName' => null,
			'args' => array(),

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
