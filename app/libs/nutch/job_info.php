<?php 
namespace Nutch;

class JobState {
	const __default = self::ANY;
	const IDLE = 'IDLE';
	const RUNNING = 'RUNNING';
	const FINISHED = 'FINISHED';
	const FAILED = 'FAILED';
	const KILLED = 'KILLED';
	const STOPPING = 'STOPPING';
	const KILLING = 'KILLING';
	const ANY = 'ANY';
	const CAN_NOT_CREATE = 'CAN_NOT_CREATE';
	const NOT_FOUND = 'NOT_FOUND';
	const COMPLETED = 'COMPLETED';
	const FAILED_COMPLETED = 'FAILED_COMPLETED';
}

/**
 * TODO : it seems no use
 * */
class JobInfo {

	private $info = array(
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
