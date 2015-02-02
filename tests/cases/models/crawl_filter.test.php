<?php
/* CrawlFilter Test cases generated on: 2015-01-27 11:01:27 : 1422331047*/
App::import('Model', 'CrawlFilter');

class CrawlFilterTestCase extends CakeTestCase {
	var $fixtures = array('app.crawl_filter', 'app.crawl', 'app.user', 'app.group', 'app.seed');

	function startTest() {
		$this->CrawlFilter =& ClassRegistry::init('CrawlFilter');
	}

	function endTest() {
		unset($this->CrawlFilter);
		ClassRegistry::flush();
	}

}
?>