<?php
/* Setting Fixture generated on: 2015-01-26 18:01:49 : 1422269149 */
class SettingFixture extends CakeTestFixture {
	var $name = 'Setting';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'skey' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'svalue' => array('type' => 'string', 'null' => false, 'length' => 512),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'skey' => 'Lorem ipsum dolor sit amet',
			'svalue' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>