<?php
/* Seeds Test cases generated on: 2015-01-26 18:01:01 : 1422269401*/
App::import('Controller', 'Seeds');

class TestSeedsController extends SeedsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SeedsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.seed', 'app.seed_list', 'app.user', 'app.group', 'app.crawl');

	function startTest() {
		$this->Seeds =& new TestSeedsController();
		$this->Seeds->constructClasses();
	}

	function endTest() {
		unset($this->Seeds);
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