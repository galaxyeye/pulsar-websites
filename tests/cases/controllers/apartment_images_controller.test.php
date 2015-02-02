<?php
/* PropertyImages Test cases generated on: 2013-08-27 22:08:36 : 1377614316*/
App::import('Controller', 'PropertyImages');

class TestPropertyImagesController extends PropertyImagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PropertyImagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.property_idmage', 'app.apartment', 'app.compound', 'app.area', 'app.compound_layout', 'app.compound_image', 'app.school', 'app.compounds_school');

	function startTest() {
		$this->PropertyImages =& new TestPropertyImagesController();
		$this->PropertyImages->constructClasses();
	}

	function endTest() {
		unset($this->PropertyImages);
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