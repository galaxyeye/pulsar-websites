<?php
/* MaxPropertyViewPages Test cases generated on: 2013-11-10 02:11:50 : 1384022090*/
App::import('Controller', 'MaxPropertyViewPages');

class TestMaxPropertyViewPagesController extends MaxPropertyViewPagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MaxPropertyViewPagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.max_property_view_page', 'app.property', 'app.compound', 'app.area', 'app.district', 'app.city', 'app.user', 'app.group', 'app.compound_image', 'app.compound_layout', 'app.school', 'app.compounds_school', 'app.property_image');

	function startTest() {
		$this->MaxPropertyViewPages =& new TestMaxPropertyViewPagesController();
		$this->MaxPropertyViewPages->constructClasses();
	}

	function endTest() {
		unset($this->MaxPropertyViewPages);
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