<?php
/* PageEntity Test cases generated on: 2015-01-26 18:01:02 : 1422269042*/
App::import('Model', 'PageEntity');

class PageEntityTestCase extends CakeTestCase {
	var $fixtures = array('app.page_entity', 'app.page_entity_field');

	function startTest() {
		$this->PageEntity =& ClassRegistry::init('PageEntity');
	}

	function endTest() {
		unset($this->PageEntity);
		ClassRegistry::flush();
	}

}
?>