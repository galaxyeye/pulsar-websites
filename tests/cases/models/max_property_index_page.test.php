<?php
/* MaxPropertyIndexPage Test cases generated on: 2013-11-10 00:11:22 : 1384014322*/
App::import('Model', 'MaxPropertyIndexPage');

class MaxPropertyIndexPageTestCase extends CakeTestCase {
	var $fixtures = array('app.max_property_index_page', 'app.property', 'app.compound', 'app.area', 'app.district', 'app.city', 'app.user', 'app.group', 'app.compound_image', 'app.compound_layout', 'app.school', 'app.compounds_school', 'app.property_image');

	function startTest() {
		$this->MaxPropertyIndexPage =& ClassRegistry::init('MaxPropertyIndexPage');
	}

	function endTest() {
		unset($this->MaxPropertyIndexPage);
		ClassRegistry::flush();
	}

}
?>