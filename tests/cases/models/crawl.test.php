<?php
/* Crawl Test cases generated on: 2015-01-27 11:01:58 : 1422331018*/
App::import('Model', 'Crawl');

class CrawlTestCase extends CakeTestCase {
	var $fixtures = array('app.crawl', 'app.user', 'app.group', 'app.crawl_filter', 'app.seed');

	function startTest() {
		$this->Crawl =& ClassRegistry::init('Crawl');
	}

	function endTest() {
		unset($this->Crawl);
		ClassRegistry::flush();
	}

}
?>