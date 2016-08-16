<?php
/* MonitorTask Fixture generated on: 2016-08-16 15:08:20 : 1471331060 */
class MonitorTaskFixture extends CakeTestFixture {
	var $name = 'MonitorTask';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'expression' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1024),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'expression' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>