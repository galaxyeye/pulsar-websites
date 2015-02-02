<?php
/* Statistic Fixture generated on: 2015-01-26 19:01:12 : 1422272652 */
class StatisticFixture extends CakeTestFixture {
	var $name = 'Statistic';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

	var $records = array(
		array(
			'id' => 1
		),
	);
}
?>