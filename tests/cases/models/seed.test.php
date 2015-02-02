<?php
/* Seed Test cases generated on: 2015-01-27 11:01:18 : 1422330978*/
App::import('Model', 'Seed');

class SeedTestCase extends CakeTestCase {
	var $fixtures = array('app.seed', 'app.crawl', 'app.user', 'app.group', 'app.crawl_filter');

	function startTest() {
		$this->Seed =& ClassRegistry::init('Seed');
	}

	function endTest() {
		unset($this->Seed);
		ClassRegistry::flush();
	}

}
?>