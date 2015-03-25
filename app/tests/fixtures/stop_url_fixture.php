<?php
/* StopUrl Fixture generated on: 2015-03-15 12:03:35 : 1426395455 */
class StopUrlFixture extends CakeTestFixture {
	var $name = 'StopUrl';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'url' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2048),
		'forbidden_point' => array('type' => 'string', 'null' => false, 'default' => 'ResourceRequested', 'length' => 45),
		'crawl_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'url' => 'Lorem ipsum dolor sit amet',
			'forbidden_point' => 'Lorem ipsum dolor sit amet',
			'crawl_id' => 1,
			'user_id' => 1
		),
	);
}
?>