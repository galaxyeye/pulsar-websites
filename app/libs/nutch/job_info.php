<?php 
class JobInfo {

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

	public function __toString() {
		return json_encode($this->info);
	}
}
