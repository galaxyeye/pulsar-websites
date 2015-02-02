<?php
class Compound extends AppModel {
	var $name = 'Compound';
	var $displayField = 'name_en';
	var $validate = array(
		'name_en' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rent_unit' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'layout' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'property_type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'area_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'district_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'neighborhood' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ownership' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
		'Area' => array(
			'className' => 'Area',
			'foreignKey' => 'area_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'District' => array(
			'className' => 'District',
			'foreignKey' => 'district_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			),
		'User'
	);

	var $hasMany = array(
		'Property' => array(
			'className' => 'Property',
			'foreignKey' => 'compound_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CompoundImage' => array(
			'className' => 'CompoundImage',
			'foreignKey' => 'compound_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CompoundLayout' => array(
			'className' => 'CompoundLayout',
			'foreignKey' => 'compound_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


	var $hasAndBelongsToMany = array(
		'School' => array(
			'className' => 'School',
			'joinTable' => 'compounds_schools',
			'foreignKey' => 'compound_id',
			'associationForeignKey' => 'school_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

	// maxviewrealty translation

	var $maxviewPageLayout = array(
			'Compound' => array(
					'name_en' => '/html/body/div[5]/div/table/tr/td/h1',
					'name_zh' => '',
					'address' => '',
					'layout' => '',
					'property_type' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr/td[2]',
					'rent' => '',
					'city_id' => '/html/body/div/span/a',
					'area' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[4]/td[2]',
					'area_id' => '',
					'district' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[3]/td[2]',
					'district_id' => '',
					'ownership' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[5]/td[2]',
					'management' => '',
					'desc' => '/html/body/div[5]/div/div[4]/p',
					'features' => '/html/body/div[5]/div/div[6]/div[2]',
					'locations' => '/html/body/div[5]/div/div[8]/p',
					'facilities' => '/html/body/div[5]/div/div[10]/div[2]',
					'cid' => ''
		  )
	);

}
?>