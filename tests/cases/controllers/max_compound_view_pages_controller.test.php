<?php
/* MaxCompoundViewPages Test cases generated on: 2013-11-10 02:11:24 : 1384022064*/
App::import('Controller', 'MaxCompoundViewPages');

class TestMaxCompoundViewPagesController extends MaxCompoundViewPagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MaxCompoundViewPagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.max_compound_view_page');

	function startTest() {
		$this->MaxCompoundViewPages =& new TestMaxCompoundViewPagesController();
		$this->MaxCompoundViewPages->constructClasses();
	}

	function endTest() {
		unset($this->MaxCompoundViewPages);
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