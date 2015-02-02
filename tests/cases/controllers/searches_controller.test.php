<?php
/* Searches Test cases generated on: 2015-01-26 20:01:13 : 1422273853*/
App::import('Controller', 'Searches');

class TestSearchesController extends SearchesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SearchesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.search');

	function startTest() {
		$this->Searches =& new TestSearchesController();
		$this->Searches->constructClasses();
	}

	function endTest() {
		unset($this->Searches);
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