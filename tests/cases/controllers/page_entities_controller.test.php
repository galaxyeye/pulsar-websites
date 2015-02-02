<?php
/* PageEntities Test cases generated on: 2015-01-26 18:01:58 : 1422269218*/
App::import('Controller', 'PageEntities');

class TestPageEntitiesController extends PageEntitiesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PageEntitiesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.page_entity', 'app.page_entity_field');

	function startTest() {
		$this->PageEntities =& new TestPageEntitiesController();
		$this->PageEntities->constructClasses();
	}

	function endTest() {
		unset($this->PageEntities);
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