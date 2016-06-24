<?php
/* SparkJob Test cases generated on: 2015-03-26 12:03:02 : 1427342702*/
App::import('Model', 'SparkJob');

class SparkJobTestCase extends CakeTestCase {
	var $fixtures = array('src.spark_job', 'src.crawl', 'src.user', 'src.group', 'src.seed', 'src.crawl_filter', 'src.page_entity', 'src.page_entity_field', 'src.scent_job', 'src.nutch_job', 'src.human_action', 'src.web_authorization', 'src.stop_url');

	function startTest() {
		$this->SparkJob =& ClassRegistry::init('SparkJob');
	}

	function endTest() {
		unset($this->SparkJob);
		ClassRegistry::flush();
	}

}
?>