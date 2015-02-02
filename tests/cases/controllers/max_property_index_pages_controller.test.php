<?php
/* MaxPropertyIndexPages Test cases generated on: 2013-11-10 02:11:38 : 1384022078*/
App::import('Controller', 'MaxPropertyIndexPages');

class TestMaxPropertyIndexPagesController extends MaxPropertyIndexPagesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MaxPropertyIndexPagesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.max_property_index_page', 'app.property', 'app.compound', 'app.area', 'app.district', 'app.city', 'app.user', 'app.group', 'app.compound_image', 'app.compound_layout', 'app.school', 'app.compounds_school', 'app.property_image');

	function startTest() {
		$this->MaxPropertyIndexPages =& new TestMaxPropertyIndexPagesController();
		$this->MaxPropertyIndexPages->constructClasses();
	}

	function endTest() {
		unset($this->MaxPropertyIndexPages);
		ClassRegistry::flush();
	}

}
?>