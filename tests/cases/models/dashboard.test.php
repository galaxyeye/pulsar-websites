<?php
/* Dashboard Test cases generated on: 2015-01-26 19:01:30 : 1422273390*/
App::import('Model', 'Dashboard');

class DashboardTestCase extends CakeTestCase {
	var $fixtures = array('app.dashboard');

	function startTest() {
		$this->Dashboard =& ClassRegistry::init('Dashboard');
	}

	function endTest() {
		unset($this->Dashboard);
		ClassRegistry::flush();
	}

}
?>