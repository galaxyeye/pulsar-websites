<?php
/* PageEntityFields Test cases generated on: 2015-01-26 18:01:15 : 1422269235*/
App::import('Controller', 'PageEntityFields');

class TestPageEntityFieldsController extends PageEntityFieldsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PageEntityFieldsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.page_entity_field', 'app.page_entity');

	function startTest() {
		$this->PageEntityFields =& new TestPageEntityFieldsController();
		$this->PageEntityFields->constructClasses();
	}

	function endTest() {
		unset($this->PageEntityFields);
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