<?php 
class CrawlFilter extends AppModel {
	var $name = 'CrawlFilter';
	var $validate = array(
		'page_type' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'url_filter' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'crawl_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
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
		'Crawl' => array(
			'className' => 'Crawl',
			'foreignKey' => 'crawl_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	function tidyCrawlFilter($crawlFilter) {

		foreach (array('url_filter', 'text_filter', 'block_filter') as $field) {
			$isset = isset($crawlFilter[$field]);
			if ($isset && false !== stripos($crawlFilter[$field], "QiwurInputTemplate")) {
				unset($crawlFilter[$field]);
			}
		}

// 		global $urlFilterTemplate, $textFilterTemplate, $blockFilterTemplate;
// 		foreach (array('url_filter', 'text_filter', 'block_filter') as $field) {
// 			if (0 == compareIgnoreSpace($crawlFilter['url_filter'], $urlFilterTemplate)) {
// 				unset($crawlFilter[$field]);
// 			}
// 		}

		return $crawlFilter;
	}
}