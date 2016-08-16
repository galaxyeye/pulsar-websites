<?php
/* MonitorTask Test cases generated on: 2016-08-16 15:08:20 : 1471331060*/
App::import('Model', 'MonitorTask');

class MonitorTaskTestCase extends CakeTestCase {
	var $fixtures = array('src.monitor_task');

	function startTest() {
		$this->MonitorTask =& ClassRegistry::init('MonitorTask');
	}

	function endTest() {
		unset($this->MonitorTask);
		ClassRegistry::flush();
	}

}
?>