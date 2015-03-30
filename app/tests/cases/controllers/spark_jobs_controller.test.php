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
	var $fixtures = array('app.spark_job', 'app.crawl', 'app.user', 'app.group', 'app.seed', 'app.crawl_filter', 'app.page_entity', 'app.page_entity_field', 'app.scent_job', 'app.nutch_job', 'app.human_action', 'app.web_authorization', 'app.stop_url');

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