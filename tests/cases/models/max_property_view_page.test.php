<?php
/* MaxPropertyViewPage Test cases generated on: 2013-11-10 02:11:20 : 1384021940*/
App::import('Model', 'MaxPropertyViewPage');

class MaxPropertyViewPageTestCase extends CakeTestCase {
	var $fixtures = array('app.max_property_view_page', 'app.property', 'app.compound', 'app.area', 'app.district', 'app.city', 'app.user', 'app.group', 'app.compound_image', 'app.compound_layout', 'app.school', 'app.compounds_school', 'app.property_image');

	function startTest() {
		$this->MaxPropertyViewPage =& ClassRegistry::init('MaxPropertyViewPage');
	}

	function endTest() {
		unset($this->MaxPropertyViewPage);
		ClassRegistry::flush();
	}

}
?>