<?php
/* StopUrl Test cases generated on: 2015-03-15 12:03:35 : 1426395455*/
App::import('Model', 'StopUrl');

class StopUrlTestCase extends CakeTestCase {
	var $fixtures = array('src.stop_url', 'src.crawl', 'src.user', 'src.group', 'src.crawl_filter', 'src.seed', 'src.human_action', 'src.web_authorization');

	function startTest() {
		$this->StopUrl =& ClassRegistry::init('StopUrl');
	}

	function endTest() {
		unset($this->StopUrl);
		ClassRegistry::flush();
	}

}
?>