<?php
/* SeedLists Test cases generated on: 2015-01-26 18:01:43 : 1422269383*/
App::import('Controller', 'SeedLists');

class TestSeedListsController extends SeedListsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SeedListsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.seed_list', 'app.user', 'app.group', 'app.crawl', 'app.seed');

	function startTest() {
		$this->SeedLists =& new TestSeedListsController();
		$this->SeedLists->constructClasses();
	}

	function endTest() {
		unset($this->SeedLists);
		ClassRegistry::flush();
	}

}
?>