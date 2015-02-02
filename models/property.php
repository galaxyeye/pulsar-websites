<?php 
class Property extends AppModel {
	var $name = 'Property';
	var $displayField = 'property_id';
	var $validate = array(
		'property_id' => array(
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
			'numeric' => array(
				'rule' => array('numeric'),
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
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Compound' => array(
			'className' => 'Compound',
			'foreignKey' => 'compound_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'City',
		'District',
		'Area',
		'User'
	);

	var $hasMany = array(
		'PropertyImage' => array(
			'className' => 'PropertyImage',
			'foreignKey' => 'property_id',
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

	// maxviewrealty translation

	var $maxviewPageLayout = array(
			'Property' => array(
					'name_en' => '/html/body/div[5]/div/table/tr/td/h1',
					'name_zh' => '',
					'address' => '',
					'layout' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[3]/td[2]',
					'property_type' => '/html/body/div[5]/div/div/a[2]',
					'size' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[2]/td[2]',
					'rent' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[7]/td[2]',
					'city_id' => '/html/body/div/span/a',
					'area' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[5]/td[2]',
					'area_id' => '',
					'district' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[6]/td[2]',
					'district_id' => '',
					'ownership' => '/html/body/div[5]/div/table/tr[3]/td[2]/div/table/tr[4]/td[2]',
					'desc' => '/html/body/div[5]/div/div[4]/div/div[3]',
					'location' => '/html/body/div[5]/div/div[4]/div[3]/p',
					'is_alone' => '',
					'pid' => ''
			)
	);

}
?>