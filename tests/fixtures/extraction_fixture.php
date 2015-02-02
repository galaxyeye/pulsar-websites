<?php
/* Extraction Fixture generated on: 2015-01-26 18:01:46 : 1422269026 */
class ExtractionFixture extends CakeTestFixture {
	var $name = 'Extraction';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'crawlid' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45),
		'desc' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'domain' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'url_pattern' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1024),
		'text_pattern' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'crawlid' => 'Lorem ipsum dolor sit amet',
			'desc' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'domain' => 'Lorem ipsum dolor sit amet',
			'url_pattern' => 'Lorem ipsum dolor sit amet',
			'text_pattern' => 'Lorem ipsum dolor sit amet',
			'created' => '2015-01-26 18:43:46',
			'modified' => '2015-01-26 18:43:46'
		),
	);
}
?>