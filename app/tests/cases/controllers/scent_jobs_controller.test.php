<?php
/* ScentJobs Test cases generated on: 2015-03-17 09:03:50 : 1426556450*/
App::import('Controller', 'ScentJobs');

class TestScentJobsController extends ScentJobsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ScentJobsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.scent_job', 'app.page_entity', 'app.page_entity_field', 'app.user', 'app.group');

	function startTest() {
		$this->ScentJobs =& new TestScentJobsController();
		$this->ScentJobs->constructClasses();
	}

	function endTest() {
		unset($this->ScentJobs);
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

}
?>