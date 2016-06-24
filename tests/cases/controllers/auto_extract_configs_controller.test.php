<?php
/* AutoExtractConfigs Test cases generated on: 2015-04-06 21:04:23 : 1428328103*/
App::import('Controller', 'AutoExtractConfigs');

class TestAutoExtractConfigsController extends AutoExtractConfigsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class AutoExtractConfigsControllerTestCase extends CakeTestCase {
	var $fixtures = array('src.auto_extract_config');

	function startTest() {
		$this->AutoExtractConfigs =& new TestAutoExtractConfigsController();
		$this->AutoExtractConfigs->constructClasses();
	}

	function endTest() {
		unset($this->AutoExtractConfigs);
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