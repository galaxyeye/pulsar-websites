<?php
/* Schedulings Test cases generated on: 2015-01-26 20:01:33 : 1422273693*/
App::import('Controller', 'Schedulings');

class TestSchedulingsController extends SchedulingsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SchedulingsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.scheduling');

	function startTest() {
		$this->Schedulings =& new TestSchedulingsController();
		$this->Schedulings->constructClasses();
	}

	function endTest() {
		unset($this->Schedulings);
		ClassRegistry::flush();
	}

}
?>