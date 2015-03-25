<?php
/* StopUrl Test cases generated on: 2015-03-15 12:03:35 : 1426395455*/
App::import('Model', 'StopUrl');

class StopUrlTestCase extends CakeTestCase {
	var $fixtures = array('app.stop_url', 'app.crawl', 'app.user', 'app.group', 'app.crawl_filter', 'app.seed', 'app.human_action', 'app.web_authorization');

	function startTest() {
		$this->StopUrl =& ClassRegistry::init('StopUrl');
	}

	function endTest() {
		unset($this->StopUrl);
		ClassRegistry::flush();
	}

}
?>