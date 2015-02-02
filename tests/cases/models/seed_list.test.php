<?php
/* SeedList Test cases generated on: 2015-01-26 18:01:24 : 1422269064*/
App::import('Model', 'SeedList');

class SeedListTestCase extends CakeTestCase {
	var $fixtures = array('app.seed_list', 'app.user', 'app.group', 'app.crawl', 'app.seed');

	function startTest() {
		$this->SeedList =& ClassRegistry::init('SeedList');
	}

	function endTest() {
		unset($this->SeedList);
		ClassRegistry::flush();
	}

}
?>