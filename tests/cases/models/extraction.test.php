<?php
/* Extraction Test cases generated on: 2015-01-26 18:01:46 : 1422269026*/
App::import('Model', 'Extraction');

class ExtractionTestCase extends CakeTestCase {
	var $fixtures = array('app.extraction');

	function startTest() {
		$this->Extraction =& ClassRegistry::init('Extraction');
	}

	function endTest() {
		unset($this->Extraction);
		ClassRegistry::flush();
	}

}
?>