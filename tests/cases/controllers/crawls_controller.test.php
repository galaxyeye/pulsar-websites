<?php
/* Crawls Test cases generated on: 2015-01-27 11:01:50 : 1422331070*/
App::import('Controller', 'Crawls');

class TestCrawlsController extends CrawlsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CrawlsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.crawl', 'app.user', 'app.group', 'app.crawl_filter', 'app.seed');

	function startTest() {
		$this->Crawls =& new TestCrawlsController();
		$this->Crawls->constructClasses();
	}

	function endTest() {
		unset($this->Crawls);
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