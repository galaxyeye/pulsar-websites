<?php
/* Dashboard Fixture generated on: 2015-01-26 19:01:30 : 1422273390 */
class DashboardFixture extends CakeTestFixture {
	var $name = 'Dashboard';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1
		),
	);
}
?>