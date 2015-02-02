<?php
/* MaxCompoundViewPage Test cases generated on: 2013-11-10 00:11:58 : 1384013218*/
App::import('Model', 'MaxCompoundViewPage');

class MaxCompoundViewPageTestCase extends CakeTestCase {
	var $fixtures = array('app.max_compound_view_page');

	function startTest() {
		$this->MaxCompoundViewPage =& ClassRegistry::init('MaxCompoundViewPage');
	}

	function endTest() {
		unset($this->MaxCompoundViewPage);
		ClassRegistry::flush();
	}

}
?>