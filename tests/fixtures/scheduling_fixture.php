<?php
/* Scheduling Fixture generated on: 2015-01-26 19:01:00 : 1422273540 */
class SchedulingFixture extends CakeTestFixture {
	var $name = 'Scheduling';

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