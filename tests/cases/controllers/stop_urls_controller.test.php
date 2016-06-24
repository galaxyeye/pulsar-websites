<?php
/* StopUrls Test cases generated on: 2015-03-15 12:03:55 : 1426395475*/
App::import('Controller', 'StopUrls');

class TestStopUrlsController extends StopUrlsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class StopUrlsControllerTestCase extends CakeTestCase {
	var $fixtures = array('src.stop_url', 'src.crawl', 'src.user', 'src.group', 'src.crawl_filter', 'src.seed', 'src.human_action', 'src.web_authorization');

	function startTest() {
		$this->StopUrls =& new TestStopUrlsController();
		$this->StopUrls->constructClasses();
	}

	function endTest() {
		unset($this->StopUrls);
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