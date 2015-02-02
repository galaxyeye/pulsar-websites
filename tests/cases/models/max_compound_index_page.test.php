<?php
/* MaxCompoundIndexPage Test cases generated on: 2013-11-10 00:11:15 : 1384013175*/
App::import('Model', 'MaxCompoundIndexPage');

class MaxCompoundIndexPageTestCase extends CakeTestCase {
	var $fixtures = array('app.max_compound_index_page');

	function startTest() {
		$this->MaxCompoundIndexPage =& ClassRegistry::init('MaxCompoundIndexPage');
	}

	function endTest() {
		unset($this->MaxCompoundIndexPage);
		ClassRegistry::flush();
	}

}
?>