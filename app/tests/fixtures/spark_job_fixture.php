<?php
/* SparkJob Fixture generated on: 2015-03-26 12:03:02 : 1427342702 */
class SparkJobFixture extends CakeTestFixture {
	var $name = 'SparkJob';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'jobId' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 256),
		'args' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'state' => array('type' => 'string', 'null' => false, 'default' => 'CREATED', 'length' => 256),
		'msg' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 256),
		'raw_msg' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'crawl_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'jobId' => 'Lorem ipsum dolor sit amet',
			'type' => 'Lorem ipsum dolor sit amet',
			'args' => 'Lorem ipsum dolor sit amet',
			'state' => 'Lorem ipsum dolor sit amet',
			'msg' => 'Lorem ipsum dolor sit amet',
			'raw_msg' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'crawl_id' => 1,
			'user_id' => 1,
			'created' => '2015-03-26 12:05:02',
			'modified' => '2015-03-26 12:05:02'
		),
	);
}
?>