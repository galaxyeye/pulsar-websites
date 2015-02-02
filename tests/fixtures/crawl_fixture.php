<?php
/* Crawl Fixture generated on: 2015-01-27 11:01:57 : 1422331017 */
class CrawlFixture extends CakeTestFixture {
	var $name = 'Crawl';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'desc' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'round' => array('type' => 'integer', 'null' => false, 'default' => '1'),
		'batchid' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'phrase' => array('type' => 'string', 'null' => true, 'default' => 'READY', 'length' => 45),
		'status' => array('type' => 'string', 'null' => false, 'default' => 'CREATED', 'length' => 45),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'finished' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'desc' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'round' => 1,
			'batchid' => 'Lorem ipsum dolor sit amet',
			'phrase' => 'Lorem ipsum dolor sit amet',
			'status' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1,
			'created' => '2015-01-27 11:56:57',
			'finished' => '2015-01-27 11:56:57'
		),
	);
}
?>