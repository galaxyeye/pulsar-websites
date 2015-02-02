<?php
/* PageEntityField Fixture generated on: 2015-01-26 18:01:13 : 1422269053 */
class PageEntityFieldFixture extends CakeTestFixture {
	var $name = 'PageEntityField';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1024),
		'desc' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'extractor_class' => array('type' => 'string', 'null' => false, 'default' => 'TextExtractor', 'length' => 1024),
		'css_path' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1024),
		'text_extract_regex' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'text_validate_regex' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'sql_data_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1024),
		'page_entity_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'desc' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'extractor_class' => 'Lorem ipsum dolor sit amet',
			'css_path' => 'Lorem ipsum dolor sit amet',
			'text_extract_regex' => 'Lorem ipsum dolor sit amet',
			'text_validate_regex' => 'Lorem ipsum dolor sit amet',
			'sql_data_type' => 'Lorem ipsum dolor sit amet',
			'page_entity_id' => 1
		),
	);
}
?>