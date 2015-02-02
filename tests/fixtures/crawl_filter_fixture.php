<?php
/* CrawlFilter Fixture generated on: 2015-01-27 11:01:27 : 1422331047 */
class CrawlFilterFixture extends CakeTestFixture {
	var $name = 'CrawlFilter';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'domain_pattern' => array('type' => 'string', 'null' => false, 'default' => '.+', 'length' => 256),
		'url_pattern' => array('type' => 'string', 'null' => false, 'default' => '.+', 'length' => 1024),
		'text_pattern' => array('type' => 'string', 'null' => false, 'default' => '.+', 'length' => 2048),
		'crawl_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'domain_pattern' => 'Lorem ipsum dolor sit amet',
			'url_pattern' => 'Lorem ipsum dolor sit amet',
			'text_pattern' => 'Lorem ipsum dolor sit amet',
			'crawl_id' => 1
		),
	);
}
?>