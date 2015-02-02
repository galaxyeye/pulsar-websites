<?php
/* Scheduling Test cases generated on: 2015-01-26 19:01:00 : 1422273540*/
App::import('Model', 'Scheduling');

class SchedulingTestCase extends CakeTestCase {
	var $fixtures = array('app.scheduling');

	function startTest() {
		$this->Scheduling =& ClassRegistry::init('Scheduling');
	}

	function endTest() {
		unset($this->Scheduling);
		ClassRegistry::flush();
	}

}
?>