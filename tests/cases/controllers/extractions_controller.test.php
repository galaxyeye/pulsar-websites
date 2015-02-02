<?php
/* Extractions Test cases generated on: 2015-01-26 18:01:39 : 1422269199*/
App::import('Controller', 'Extractions');

class TestExtractionsController extends ExtractionsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class ExtractionsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.extraction');

	function startTest() {
		$this->Extractions =& new TestExtractionsController();
		$this->Extractions->constructClasses();
	}

	function endTest() {
		unset($this->Extractions);
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