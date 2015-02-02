<?php
/* PageEntityField Test cases generated on: 2015-01-26 18:01:13 : 1422269053*/
App::import('Model', 'PageEntityField');

class PageEntityFieldTestCase extends CakeTestCase {
	var $fixtures = array('app.page_entity_field', 'app.page_entity');

	function startTest() {
		$this->PageEntityField =& ClassRegistry::init('PageEntityField');
	}

	function endTest() {
		unset($this->PageEntityField);
		ClassRegistry::flush();
	}

}
?>