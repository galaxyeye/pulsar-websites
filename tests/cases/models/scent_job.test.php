<?php
/* ScentJob Test cases generated on: 2015-03-17 09:03:31 : 1426556431*/
App::import('Model', 'ScentJob');

class ScentJobTestCase extends CakeTestCase {
	var $fixtures = array('src.scent_job', 'src.page_entity', 'src.page_entity_field', 'src.user', 'src.group');

	function startTest() {
		$this->ScentJob =& ClassRegistry::init('ScentJob');
	}

	function endTest() {
		unset($this->ScentJob);
		ClassRegistry::flush();
	}

}
?>