<?php
/* AutoExtractConfig Test cases generated on: 2015-04-06 21:04:59 : 1428328079*/
App::import('Model', 'AutoExtractConfig');

class AutoExtractConfigTestCase extends CakeTestCase {
	var $fixtures = array('app.auto_extract_config');

	function startTest() {
		$this->AutoExtractConfig =& ClassRegistry::init('AutoExtractConfig');
	}

	function endTest() {
		unset($this->AutoExtractConfig);
		ClassRegistry::flush();
	}

}
?>