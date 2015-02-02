<?php
/* MaxCompoundIndexPages Test cases generated on: 2013-11-10 02:11:10 : 1384022050*/
App::import('Controller', 'MaxCompoundIndexPages');

class TestMaxCompoundIndexPagesController extends MaxCompoundIndexPagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MaxCompoundIndexPagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.max_compound_index_page');

	function startTest() {
		$this->MaxCompoundIndexPages =& new TestMaxCompoundIndexPagesController();
		$this->MaxCompoundIndexPages->constructClasses();
	}

	function endTest() {
		unset($this->MaxCompoundIndexPages);
		ClassRegistry::flush();
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