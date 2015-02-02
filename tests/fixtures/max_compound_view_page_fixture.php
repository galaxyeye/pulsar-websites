<?php
/* MaxCompoundViewPage Fixture generated on: 2013-11-10 00:11:58 : 1384013218 */
class MaxCompoundViewPageFixture extends CakeTestFixture {
	var $name = 'MaxCompoundViewPage';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'property_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'completion_date' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'district' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'neighborhood' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'ownership' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'featured_description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'features' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'location' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'facility' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'main_layout' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'property_type' => 'Lorem ipsum dolor sit amet',
			'completion_date' => 'Lorem ipsum dolor sit amet',
			'district' => 'Lorem ipsum dolor sit amet',
			'neighborhood' => 'Lorem ipsum dolor sit amet',
			'ownership' => 'Lorem ipsum dolor sit amet',
			'featured_description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'features' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'location' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'facility' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'main_layout' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);
}
?>