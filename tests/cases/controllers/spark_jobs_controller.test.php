<?php
/* SparkJobs Test cases generated on: 2015-03-26 12:03:48 : 1427342748*/
App::import('Controller', 'SparkJobs');

class TestSparkJobsController extends SparkJobsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SparkJobsControllerTestCase extends CakeTestCase {
	var $fixtures = array('src.spark_job', 'src.crawl', 'src.user', 'src.group', 'src.seed', 'src.crawl_filter', 'src.page_entity', 'src.page_entity_field', 'src.scent_job', 'src.nutch_job', 'src.human_action', 'src.web_authorization', 'src.stop_url');

	function startTest() {
		$this->SparkJobs =& new TestSparkJobsController();
		$this->SparkJobs->constructClasses();
	}

	function endTest() {
		unset($this->SparkJobs);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>