<?php
/* Dashboards Test cases generated on: 2015-01-26 19:01:48 : 1422273408*/
App::import('Controller', 'Dashboards');

class TestDashboardsController extends DashboardsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DashboardsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.dashboard');

	function startTest() {
		$this->Dashboards =& new TestDashboardsController();
		$this->Dashboards->constructClasses();
	}

	function endTest() {
		unset($this->Dashboards);
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