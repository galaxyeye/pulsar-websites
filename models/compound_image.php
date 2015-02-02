<?php
class CompoundImage extends AppModel {
	var $name = 'CompoundImage';
	var $validate = array(
		'compound_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Compound' => array(
			'className' => 'Compound',
			'foreignKey' => 'compound_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>