<?php
/* MaxCompoundIndexPage Fixture generated on: 2013-11-10 00:11:15 : 1384013175 */
class MaxCompoundIndexPageFixture extends CakeTestFixture {
	var $name = 'MaxCompoundIndexPage';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 245),
		'rent_range' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'property_type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'area' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'layout' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'rent_range' => 'Lorem ipsum dolor sit amet',
			'property_type' => 'Lorem ipsum dolor sit amet',
			'area' => 'Lorem ipsum dolor sit amet',
			'layout' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>