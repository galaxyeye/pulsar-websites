<?php
/* Statistics Test cases generated on: 2015-01-26 19:01:34 : 1422272674*/
App::import('Controller', 'Statistics');

class TestStatisticsController extends StatisticsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class StatisticsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.statistic');

	function startTest() {
		$this->Statistics =& new TestStatisticsController();
		$this->Statistics->constructClasses();
	}

	function endTest() {
		unset($this->Statistics);
		ClassRegistry::flush();
	}

}
?>