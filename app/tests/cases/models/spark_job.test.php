<?php
/* SparkJob Test cases generated on: 2015-03-26 12:03:02 : 1427342702*/
App::import('Model', 'SparkJob');

class SparkJobTestCase extends CakeTestCase {
	var $fixtures = array('app.spark_job', 'app.crawl', 'app.user', 'app.group', 'app.seed', 'app.crawl_filter', 'app.page_entity', 'app.page_entity_field', 'app.scent_job', 'app.nutch_job', 'app.human_action', 'app.web_authorization', 'app.stop_url');

	function startTest() {
		$this->SparkJob =& ClassRegistry::init('SparkJob');
	}

	function endTest() {
		unset($this->SparkJob);
		ClassRegistry::flush();
	}

}
?>