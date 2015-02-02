<?php
/* MaxPropertyIndexPage Fixture generated on: 2013-11-10 00:11:22 : 1384014322 */
class MaxPropertyIndexPageFixture extends CakeTestFixture {
	var $name = 'MaxPropertyIndexPage';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 245),
		'rent' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'property_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'area' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'bedrooms' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'size' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'rent' => 'Lorem ipsum dolor sit amet',
			'property_id' => 'Lorem ipsum dolor sit amet',
			'area' => 'Lorem ipsum dolor sit amet',
			'bedrooms' => 'Lorem ipsum dolor sit amet',
			'size' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>