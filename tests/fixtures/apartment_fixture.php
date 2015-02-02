<?php
/* Property Fixture generated on: 2013-08-28 04:08:57 : 1377635637 */
class PropertyFixture extends CakeTestFixture {
	var $name = 'Property';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'property_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 45, 'key' => 'unique'),
		'compound_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'layout' => array('type' => 'integer', 'null' => false, 'default' => '3'),
		'property_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'size' => array('type' => 'integer', 'null' => true, 'default' => '120'),
		'rent' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => 10),
		'rent_unit' => array('type' => 'string', 'null' => false, 'default' => 'Month', 'length' => 45),
		'desc' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'location' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'facilities' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'location_map' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'property_id_UNIQUE' => array('column' => 'property_id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'property_id' => 'Lorem ipsum dolor sit amet',
			'compound_id' => 1,
			'layout' => 1,
			'property_type' => 'Lorem ipsum dolor sit amet',
			'size' => 1,
			'rent' => 1,
			'rent_unit' => 'Lorem ipsum dolor sit amet',
			'desc' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'location' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'facilities' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'location_map' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>