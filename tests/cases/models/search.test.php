<?php
/* Search Test cases generated on: 2015-01-26 20:01:55 : 1422273835*/
App::import('Model', 'Search');

class SearchTestCase extends CakeTestCase {
	var $fixtures = array('app.search');

	function startTest() {
		$this->Search =& ClassRegistry::init('Search');
	}

	function endTest() {
		unset($this->Search);
		ClassRegistry::flush();
	}

}
?>