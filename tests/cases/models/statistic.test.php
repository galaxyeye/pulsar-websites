<?php
/* Statistic Test cases generated on: 2015-01-26 19:01:14 : 1422272654*/
App::import('Model', 'Statistic');

class StatisticTestCase extends CakeTestCase {
	var $fixtures = array('app.statistic');

	function startTest() {
		$this->Statistic =& ClassRegistry::init('Statistic');
	}

	function endTest() {
		unset($this->Statistic);
		ClassRegistry::flush();
	}

}
?>