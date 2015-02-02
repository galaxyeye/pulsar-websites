<?php
/* Instance Test cases generated on: 2015-01-26 19:01:01 : 1422273301*/
App::import('Model', 'Instance');

class InstanceTestCase extends CakeTestCase {
	var $fixtures = array('app.instance');

	function startTest() {
		$this->Instance =& ClassRegistry::init('Instance');
	}

	function endTest() {
		unset($this->Instance);
		ClassRegistry::flush();
	}

}
?>