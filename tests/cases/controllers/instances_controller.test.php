<?php
/* Instances Test cases generated on: 2015-01-26 19:01:19 : 1422273319*/
App::import('Controller', 'Instances');

class TestInstancesController extends InstancesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class InstancesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.instance');

	function startTest() {
		$this->Instances =& new TestInstancesController();
		$this->Instances->constructClasses();
	}

	function endTest() {
		unset($this->Instances);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

	function testAdminIndex() {

	}

	function testAdminView() {

	}

	function testAdminAdd() {

	}

	function testAdminEdit() {

	}

	function testAdminDelete() {

	}

}
?>