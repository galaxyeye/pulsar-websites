<?php
/* CrawlFilters Test cases generated on: 2015-01-27 11:01:09 : 1422331089*/
App::import('Controller', 'CrawlFilters');

class TestCrawlFiltersController extends CrawlFiltersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CrawlFiltersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.crawl_filter', 'app.crawl', 'app.user', 'app.group', 'app.seed');

	function startTest() {
		$this->CrawlFilters =& new TestCrawlFiltersController();
		$this->CrawlFilters->constructClasses();
	}

	function endTest() {
		unset($this->CrawlFilters);
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