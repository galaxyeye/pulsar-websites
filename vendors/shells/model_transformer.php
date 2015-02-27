<?php 

App::import('Lib', array('function_core', 'watermark'));

class ModelTransformerShell extends Shell {

	var $areaDistrictOwnership = array();

	var $lastPid = 25000;
	
	/**
	 * Main Model
	 *
	 * @var array
	 */
	public $uses = array(
			'Property',
			'PropertyImage',
			'Compound',
			'CompoundImage',
			'CompoundLayout',
			'MaxPropertyIndexPage',
			'MaxPropertyViewPage',
			'MaxPropertyImage',
			'MaxCompoundIndexPage',
			'MaxCompoundViewPage',
			'MaxCompoundImage'
	);

	/**
	 * Startup method for the shell
	 *
	 */
    function startup() {
	    $this->out("Transform simpage extracted webpage data to application required data model");
    }

    /**
     * Override main() for help message hook
     *
     * @access public
     */
    function main() {
    	$out  = "Transform simpage extracted webpage data to application required data model\n";
    	$out .= "\t - transform_compounds\n";
    	$out .= "\t - transform_properties\n";
    	$out .= "\t - transform_max_compound_page_images\n";
    	$out .= "\t - transform_max_compound_page_layouts\n";
    	$out .= "\t - transform_max_property_page_images\n";

    	$this->out($out);
    }

    function transform_compounds() {
    	$conditions = array('property_type like "%%Old%%"');

    	$count = $this->MaxCompoundViewPage->find('count', array('conditions' => $conditions));

    	// $count = 3;
    	$limit = 100;
    	// $limit = 2;
    	for ($i = 0; $i <= $count / $limit; ++$i) {
    		$compounds = $this->MaxCompoundViewPage->find('all', 
    				array('conditions' => $conditions, 'page' => $i, 'limit' => $limit));

    		$this->__transform_compound($compounds);
    	}
    }

    function transform_properties() {
    	$conditions = array('property_type like "%%Old%%"');

    	$this->MaxPropertyViewPage->recursive = -1;
    	$count = $this->MaxPropertyViewPage->find('count', array('conditions' => $conditions));
    	
    	// $count = $this->MaxPropertyViewPage->find('count');

    	// $count = 3;
    	$limit = 100;
    	// $limit = 2;
    	for ($i = 0; $i <= $count / $limit; ++$i) {
    		$properties = $this->MaxPropertyViewPage->find('all', array('conditions' => $conditions, 'page' => $i, 'limit' => $limit));

    		$this->__transform_property($properties);
    	}
    }

    function transform_max_compound_page_images() {
    	$count = $this->MaxCompoundViewPage->find('count');

    	$limit = 100;
    	$count = 1;
    	$limit = 4;
    	for ($i = 0; $i <= $count / $limit; ++$i) {
    		$compounds = $this->MaxCompoundViewPage->find('all', array(
    				'fields' => array('id', 'name', 'image_info'),
    				'page' => $i, 'limit' => $limit));

    		$this->__getCompoundViewImage($compounds);
    	}
    }

    function transform_max_compound_page_layouts() {
    	
    }

    function transform_max_property_page_images() {
    	$count = $this->MaxPropertyViewPage->find('count');

    	// $count = 1;
    	$limit = 100;
    	for ($i = 0; $i <= $count / $limit; ++$i) {
    		$properties = $this->MaxPropertyViewPage->find('all', array(
    				'fields' => array('id', 'name', 'image_info'),
    				'page' => $i, 'limit' => $limit));

    		$this->__getPropertyViewImage($properties);
    	}
    }

    function fix_area() {
    	$this->MaxPropertyViewPage->recursive = -1;
    	$count = $this->MaxPropertyViewPage->find('count', array('conditions' => $conditions));
    	pr($count);

    	// $count = $this->MaxPropertyViewPage->find('count');

    	// $count = 1;
    	$limit = 100;
    	// $limit = 12;
    	for ($i = 0; $i <= $count / $limit; ++$i) {
    		$maxproperties = $this->MaxPropertyViewPage->find('all', array('conditions' => $conditions, 'page' => $i, 'limit' => $limit));

    		$this->__fix_area($maxproperties);
    	}
    }

    function fix_property_type() {
    	$conditions = array('property_type like "%%Old%%"');

    	$this->MaxPropertyViewPage->recursive = -1;
    	$count = $this->MaxPropertyViewPage->find('count', array('conditions' => $conditions));

    	// $count = 1;
    	$limit = 100;
    	// $limit = 12;
    	for ($i = 0; $i <= $count / $limit; ++$i) {
    		$maxproperties = $this->MaxPropertyViewPage->find('all', array(
    				'conditions' => $conditions, 'page' => $i, 'limit' => $limit));

    		$this->__fix_property_type($maxproperties);
    	}
    }

    function fix_compounds() {
    	$count = $this->MaxCompoundViewPage->find('count');

    	// $count = 1;
    	$limit = 100;
    	// $limit = 12;
    	for ($i = 0; $i <= $count / $limit; ++$i) {
    		$maxcompounds = $this->MaxCompoundViewPage->find('all', array('page' => $i, 'limit' => $limit));

    		$this->__fix_compounds($maxcompounds);
    	}
    }

    function fix_compound_ids() {
    	$conditions = array('layout like "%%bedr%%"');

    	$this->Compound->recursive = -1;
    	$count = $this->Compound->find('count', array('conditions' => $conditions));

    	// $count = 1;
    	$limit = 100;
    	// $limit = 12;
    	for ($i = 0; $i <= $count / $limit; ++$i) {
    		$compounds = $this->Compound->find('all', array('page' => $i, 'limit' => $limit));

    		$this->__fix_compound_ids($compounds);
    	}
    }

    function sync_property_from_compound() {
    	$this->Compound->recursive = -1;
    	$count = $this->Compound->find('count');

    	$limit = 100;
//     	$count = 1;
//     	$limit = 4;
    	for ($i = 0; $i <= $count / $limit; ++$i) {
    		$compounds = $this->Compound->find('all', array(
    				'fields' => array('id', 'name_en', 'name_zh', 'property_type', 'area_id', 'district_id', 'locations', 'lat', 'lng'),
    				'page' => $i, 'limit' => $limit));

    		$this->__sync_property_from_compound($compounds);
    	}
    }

    function __sync_property_from_compound($compounds) {
		foreach ($compounds as $c) {
			$name_en = addslashes($c['Compound']['name_en']);
			$location = addslashes($c['Compound']['locations']);

			$extra_sql = '';

			if (!empty($c['Compound']['lat']) &&  !empty($c['Compound']['lng'])) {
				$extra_sql = ", `lat` = {$c['Compound']['lat']}, `lng` = {$c['Compound']['lng']}";
			}

			$sql = "update `properties` set `name_en` = '$name_en', `name_zh` = '{$c['Compound']['name_zh']}', `property_type` = '{$c['Compound']['property_type']}',"
		    	." `area_id` = {$c['Compound']['area_id']}, `district_id` = {$c['Compound']['district_id']}, `location` = '$location' $extra_sql"
	    		." where `compound_id` = {$c['Compound']['id']};";

		    $this->out($sql);

	    	$this->Property->query($sql);
		}
    }

    function __fix_compound_ids($compounds) {
    	foreach ($compounds as $compound) {
    		pr($compound);
    		$compound['Compound']['layout'] = substr($compound['Compound']['layout'], 0, 3);
    		$this->Compound->save($compound);
    		// $this->out($area_id);
    
//     		$this->Property->recursive = -1;
//     		$properties = $this->Property->find('all', array('conditions' =>
//     				array("name_en = '{$name['name_en']}' and name_zh = '{$name['name_zh']}'")
//     		));


//     		$this->Property->query("update properties set compound_id={$compound['Compound']['id']} 
// 	    		where name_en = '{$compound['Compound']['name_en']}' and name_zh = '{$compound['Compound']['name_zh']}'");
    	}
    }

    function __fix_area($maxproperties) {
    	foreach ($maxproperties as $maxproperty) {
    		$name = $this->__getName(addslashes($maxproperty['MaxPropertyViewPage']['name']));
    		// $city_id = $this->__getCityId($compound['MaxPropertyViewPage']['city']);
    		$district_id = $this->__getDistrictId($maxproperty['MaxPropertyViewPage']['district']);
    		$city_id = $this->__getCityId($district_id);
    		$area_id = $this->__getAreaId($city_id, $maxproperty['MaxPropertyViewPage']['neighborhood']);

    		// $this->out($area_id);

    		$this->Property->recursive = -1;
    		$properties = $this->Property->find('all', array('conditions' => 
    				array("name_en = '{$name['name_en']}' and name_zh = '{$name['name_zh']}'")
    		));

    		foreach ($properties as $property) {

    			$this->out($property['Property']['id']);
    			$this->out($property['Property']['compound_id']);

    			// continue;

    			if ($property['Property']['id']) {
	    			$this->Property->id = $property['Property']['id'];
	    			$this->Property->saveField('area_id', $area_id);
    			}

    			if ($property['Property']['compound_id']) {
	    			$this->Property->id = $property['Property']['compound_id'];
	    			$this->Property->saveField('area_id', $area_id);
    			}
    		}
    	}
    }

    function __fix_property_type($maxproperties) {
    	foreach ($maxproperties as $maxproperty) {
    		$name = $this->__getName(addslashes($maxproperty['MaxPropertyViewPage']['name']));
    		// $city_id = $this->__getCityId($compound['MaxPropertyViewPage']['city']);

    		// $this->out($area_id);

    		$this->Property->recursive = -1;
    		$properties = $this->Property->find('all', array('conditions' =>
    				array("name_en = '{$name['name_en']}' and name_zh = '{$name['name_zh']}'")
    		));

    		foreach ($properties as $property) {
    			$this->out($property['Property']['id']);
    			$this->out($property['Property']['compound_id']);

    			// continue;
     			$this->Property->id = $property['Property']['id'];
     			$this->Property->saveField('property_type', 'Serviced-Apartment');

     			$this->Compound->id = $property['Property']['compound_id'];
     			$this->Compound->saveField('property_type', 'Serviced-Apartment');
    		}
    	}
    }

    function __fix_compounds($maxcompounds) {
    	foreach ($maxcompounds as $maxcompound) {
    		$name = $this->__getName(addslashes($maxcompound['MaxCompoundViewPage']['name']));

    		// $this->out($area_id);

    		$this->Compound->recursive = -1;
    		$compounds = $this->Compound->find('all', array('conditions' =>
    				array("name_en = '{$name['name_en']}' and name_zh = '{$name['name_zh']}'")
    		));

    		$this->out($name['name_en'].$name['name_zh']);
    		$this->out(count($compounds));
    		// pr($compounds);

    		foreach ($compounds as $compound) {
    			continue;

    			$this->out($compound['Compound']['id']);
    			$this->out($compound['Compound']['compound_id']);

    			$this->Compound->id = $compound['Compound']['id'];
    			$this->Compound->saveField('area_id', $area_id);
    		}
    	}
    }
    
    function trim_images() {
    	$workdir = '/home/vincent/workspace/zufang/app/webroot/img/uploads/compound_images/13-11-15';

    	$this->__visitDir($workdir);
    }

    private function __visitDir($dir) {
    	if (!is_dir($dir)) return;

    	if (($dh = opendir($dir)) === false) return;

    	$this->__traverseDir($dir, $dh);

    	closedir($dh);
    }

    private function __traverseDir($dir, $dh) {
    	// begin to traverse the directory
    	while (($file = readdir($dh)) !== false) {
    		if ($file == '.' || $file == '..') continue;

    		$fullPath = $dir  . DS . $file;

    		// pr($fullPath);

    		if(is_dir($fullPath)) {
    			// $this->__visitDir($fullPath);
    		}
    		else {
    			$this->__processImage($fullPath);
    		}
    	} // while readdir
    }

    private function __processImage($fullPath) {
    	echo $fullPath.PHP_EOL;

    	system("cp {$fullPath} {$fullPath}.jpg");

		$dest_image = $fullPath; // make sure the directory is writeable

		// $ims = getimagesize($fullPath.'.jpg');
		$img = imagecreatetruecolor(300, 175);
		$org_img = imagecreatefromjpeg($fullPath.'.jpg');
		imagecopy($img, $org_img, 0, 0, 0, 0, 300, 175);
		imagejpeg($img, $dest_image, 90);
		imagedestroy($img);

		system("rm {$fullPath}.jpg");

    	$water = new watermark();
    	$water->waterInfo($fullPath, IMAGES . 'uploads/watermark.png', 9, "", 20 );
    }

    function __transform_property($properties) {
    	foreach ($properties as $property) {
    		// pr($compound);

    		$this->Property->create();
    		$this->Compound->create();

    		$name = $this->__getName(addslashes($property['MaxPropertyViewPage']['name']));
    		// $city_id = $this->__getCityId($compound['MaxPropertyViewPage']['city']);
    		$district_id = $this->__getDistrictId($property['MaxPropertyViewPage']['district']);
    		$city_id = $this->__getCityId($district_id);
    		//    		pr($name);
    
    		$this->Compound->recursive = -1;
//     		$shortName = substr($name['name_en'], 0, 5);
//     		$compound = $this->Compound->find('first', array('conditions' => array("name_en like '%%{$shortName}%%'")));
    		$compound_id = 0;
    		if (!empty($compound)) $compound_id = $compound['Compound']['id'];
    		$is_alone = $compound_id ? 0 : 1;

    		//     		pr($compound_id);
    		//     		pr($compound);
    		//     		continue;
    
    		$property['MaxPropertyViewPage']['property_type'] = 'Old House';
    		
    		$data = array('Property' => array(
    				'pid' => $this->__calc_pid($district_id, $property['MaxPropertyViewPage']['property_type']),
    				'name_en' => $name['name_en'],
    				'name_zh' => $name['name_zh'],
    				'ownership' => $property['MaxPropertyViewPage']['ownership'],
    				'address' => '{{address}}',
    				'layout' => intval($property['MaxPropertyViewPage']['layout']),
    				'property_type' => $property['MaxPropertyViewPage']['property_type'],
    				'size' => intval($property['MaxPropertyViewPage']['size']),
    				'rent' => intval(preg_replace('/¥|,/i', '', $property['MaxPropertyViewPage']['rent'])),
    				'desc' => $property['MaxPropertyViewPage']['featured_description'],
    				'locations' => $property['MaxPropertyViewPage']['location'],
    				'city_id' => $city_id,
    				'district_id' => $district_id,
    				'area_id' => 0,
    				'status' => 'Published',
    				'is_alone' => $is_alone,
    				'user_id' => 5,
    				'compound_id' => $compound_id
    		));

    		if ($is_alone) {
    			$data['Compound'] = $data['Property'];
    			$data['Compound']['cid'] = 'C'.$data['Property']['pid'];
    			$data['Compound']['rent_lower'] = $data['Property']['rent'];
    			$data['Compound']['rent_upper'] = $data['Property']['rent'];
    			$data['Compound']['status'] = 'Hidden';
    		}

    		pr($data);

    		// continue;

    		$this->Compound->save($data);

    		if ($this->Compound->id) {
    			$data['Property']['compound_id'] = $this->Compound->id;
    		}
    		$this->Property->save($data);

    		// images
    		$maxPropertyImages = $this->MaxPropertyImage->find('all',
    				array('conditions' => array('max_property_view_id' => $property['MaxPropertyViewPage']['id'])));

    		$this->PropertyImage->create();
    		$data = array();
    		foreach ($maxPropertyImages as $maxPropertyImage) {
    			$data[]['PropertyImage'] = array(
    					'is_big' => 0,
    					'url' => $maxPropertyImage['MaxPropertyImage']['url'],
    					'property_id' => $this->Property->id
    			);
    		}
    		$data[0]['PropertyImage']['is_big'] = 1;

    		// pr($data);
    		$this->PropertyImage->saveAll($data);
    	}
    }

    function __transform_compound($compounds) {
    	foreach ($compounds as $compound) {
    		// pr($compound);

    		$this->Compound->create();

    		$name = $this->__getName(addslashes($compound['MaxCompoundViewPage']['name']));
    		// $city_id = $this->__getCityId($compound['MaxCompoundViewPage']['city']);
    		$district_id = $this->__getDistrictId($compound['MaxCompoundViewPage']['district']);
    		$city_id = $this->__getCityId($district_id);
    		// pr($name);

//     		$indexData = $this->MaxCompoundIndexPage->find('first',
//     				array('conditions' => array("name like '%%{$name['name_en']}%%'")));
    		// pr($indexData);

//    		$regs = array();
//    		$text = $indexData['MaxCompoundIndexPage']['rent_range'];
//     		preg_match("/¥(\d+)-(\d+)\/month, (\w+|Serviced Apartment), (\w+)/i", $text, $regs);
    
//     		if (count($regs) < 4) {
//     			$this->out("Compound to be fixed: {$name['name_en']}, $text");
//     			continue;
//     		}

    		$data = array('Compound' => array(
    				'cid' => $this->__calc_cid($district_id, $compound['MaxCompoundViewPage']['property_type']),
    				'name_en' => $name['name_en'],
    				'name_zh' => $name['name_zh'],
    				'rent_lower' => '',
    				'rent_upper' => '',
    				'layout' => '',
    				'property_type' => $compound['MaxCompoundViewPage']['property_type'],
    				'address' => '{{address}}',
    				'city_id' => $city_id,
    				'district_id' => $district_id,
    				'area_id' => $this->__getAreaId($city_id, $compound['MaxCompoundViewPage']['district']),
    				'ownership' => $this->__getOwnership($compound['MaxCompoundViewPage']['ownership']),
    				'desc' => $compound['MaxCompoundViewPage']['featured_description'],
    				'features' => $compound['MaxCompoundViewPage']['features'],
    				'locations' => $compound['MaxCompoundViewPage']['location'],
    				'facilities' => $compound['MaxCompoundViewPage']['facility'],
    				'status' => 'Published',
    				'is_alone' => 1,
    				'user_id' => 5,
    		));

    		$this->Compound->recursive = -1;
    		$exist = $this->Compound->find('count', array('conditions' => 
    				array("name_en = '{$name['name_en']}' and name_zh = '{$name['name_zh']}'")));
    		
    		if ($exist) {
    			$this->out("Compound {$name['name_en']} exist");
    			$this->Compound->query("update compounds set is_alone=0 where name_en = '{$name['name_en']}' and name_zh = '{$name['name_zh']}'");

    			continue;
    		}
    		else {
    			$this->out("Compound {$name['name_en']} not exist");
    		}

    		$this->Compound->save($data);

    		// images
    		$maxCompoundImages = $this->MaxCompoundImage->find('all',
    				array('conditions' => array('max_compound_view_id' => $compound['MaxCompoundViewPage']['id'])));

    		$this->CompoundImage->create();
    		$data = array();
    		foreach ($maxCompoundImages as $maxCompoundImage) {
    			$data[]['CompoundImage'] = array(
    					'is_big' => 0,
    					'url' => $maxCompoundImage['MaxCompoundImage']['url'],
    					'compound_id' => $this->Compound->id
    			);
    		}
    		$data[0]['CompoundImage']['is_big'] = 1;

//    		pr($data);
    		$this->CompoundImage->saveAll($data);
    		//     		$text = $compound['MaxCompoundViewPage']['main_layout'];
    		//     		preg_match_all("/<tr>.+>\s+(\d+)/i", $text, $regs, PREG_SET_ORDER);
    
    		$this->CompoundLayout->create();
    		$data = $this->__getLayout($this->Compound->id, $compound['MaxCompoundViewPage']['main_layout']);
//    		pr($data);
    		$this->CompoundLayout->saveAll($data);
    
    		//    		pr($regs);
    	}
    
    	// pr($data);
    
    	// $this->Compound->saveAll($data);
    }

    function __getCompoundViewImage($compounds) {
    	$base = 'http://www.maxviewrealty.com';
    	$data = array();

    	$i = 0;
    	foreach ($compounds as $compound) {
    		$name = $compound['MaxCompoundViewPage']['name'];
    		$image_info = $compound['MaxCompoundViewPage']['image_info'];
    		$max_compound_view_id = $compound['MaxCompoundViewPage']['id'];

    		$imageLinks = $this->__getLinks($image_info);

    		foreach ($imageLinks as $link) {
    			++$i;

    			$link = $base.preg_replace('/\\\/i', '\/', $link);

    			$today = date("y-m-d");
    			$path = "uploads/compound_images/{$today}";
    			if (!file_exists(IMAGES . $path)) mkdir(IMAGES . $path);

    			$now = date("ymdHis");
    			$file = end(explode("/", low($link)));
    			$postfix = end(explode(".", low($file)));

    			$path .= "/{$now}-{$i}.{$postfix}";
    			$dest = IMAGES . $path;

    			$cmd = "wget {$link}";
    			$cmd2 = "cp {$file} {$dest}";
    			$cmd3 = "rm {$file}";

    			system($cmd);
    			system($cmd2);
    			system($cmd3);

    			$data[] = array('MaxCompoundImage' => array('url' => $path, 'max_compound_view_id' => $max_compound_view_id));
    		}
    	}

    	// pr($data);

    	$this->MaxCompoundImage->saveAll($data);
    }

    function __getPropertyViewImage($properties) {
    	$base = 'http://www.maxviewrealty.com';
    	$data = array();

    	$i = 0;
    	foreach ($properties as $property) {
    		$name = $property['MaxPropertyViewPage']['name'];
    		$image_info = $property['MaxPropertyViewPage']['image_info'];
    		$max_property_view_id = $property['MaxPropertyViewPage']['id'];

    		$imageLinks = $this->__getLinks($image_info);

    		foreach ($imageLinks as $link) {
    			++$i;

    			$link = $base.preg_replace('/\\\/i', '\/', $link);

    			$today = date("y-m-d");
    			$path = "uploads/property_images/{$today}";
    			if (!file_exists(IMAGES . $path)) mkdir(IMAGES . $path);

    			$now = date("ymdHis");
    			$file = end(explode("/", low($link)));
	    		$postfix = end(explode(".", low($file)));

	    		$path .= "/{$now}-{$i}.{$postfix}";
				$dest = IMAGES . $path;

				$cmd = "wget {$link}";
				$cmd2 = "cp {$file} {$dest}";
				$cmd3 = "rm {$file}";

				system($cmd);
				system($cmd2);
				system($cmd3);

				$data[] = array('MaxPropertyImage' => array('url' => $path, 'max_property_view_id' => $max_property_view_id));
    		}
    	}

    	// pr($data);

    	$this->MaxPropertyImage->saveAll($data);
    }

    function __getLinks($html) {
    	$links = array();
    	$regs = array ();

    	preg_match_all("/src\s*=\s*[\'\"]?([+:%\/\?~=&;\\\(\),._a-zA-Z0-9-]*)(#[.a-zA-Z0-9-]*)?[\'\" ]?(\s*rel\s*=\s*[\'\"]?(nofollow)[\'\"]?)?/i", 
    		$html, $regs, PREG_SET_ORDER);

    	foreach ($regs as $val) {
			$links[] = $val[1];
    	}

    	return $links;
    }

    function __getName($text) {
    	$name = array('name_en' => $text, 'name_zh' => '');

    	$text = preg_replace('/\|/i', '', $text);

    	$pos = find_first_chinese($text);

    	if ($pos !== false) {
    		$name['name_en'] = trim(mb_substr($text, 0, $pos));
    		$name['name_zh'] = substr($text, $pos);
    	}

    	return $name;
    }

    function __getCityId($district_id) {
    	if ($district_id >= 1000) return 2;
    	if ($district_id >= 10000) return 3;

    	return 1;
    }

    var $areas = array();
    function __getAreaId($city_id, $area) {
    	if (!empty($areas)) return $areas;

    	// area id
    	$this->Compound->Area->recursive = -1;
    	$this->areas = $this->Compound->Area->find('list', array('city_id' => $city_id));
    	$this->areas = array_combine(array_values($this->areas), array_keys($this->areas));

    	if (key_exists($area, $this->areas)) {
    		return $this->areas[$area];
    	}

    	return 0;
    }

    var $districts = array();
    function __getDistrictId($district) {
    	if (!empty($districts)) return $districts;

    	// district id
    	// area id
    	$this->Compound->District->recursive = -1;
    	$this->districts = $this->Compound->District->find('list');
    	$this->districts = array_combine(array_values($this->districts), array_keys($this->districts));

    	if (key_exists($district, $this->districts)) {
    		return $this->districts[$district];
    	}

    	return 0;
	}

	function __getOwnership($ownership) {
		$ownershipMap = array('' => 'None', 'private owned' => 'Individual',
				'developer owned' => 'Developer', 'developer owened' => 'Developer',
				'developer and private owned' => 'Other', 'developer & private owned' => 'Other');

		if (key_exists($ownership, $ownershipMap)) {
			return $ownershipMap[$ownership];
		}

		return 'Other';
	}

	function __getLayout($compound_id, $main_layout) {
		$data = array();

		$dom = htmlqp($main_layout);

		foreach ($dom->find('tr') as $rows) {
			$cols = $rows->find('td');

			$size = trim($cols->get(0)->nodeValue);
			if (strlen($size) < 3 || $size == 'Size(sqm)') continue;

			$data[]['CompoundLayout'] = array('compound_id' => $compound_id,
					'size' => $size,
					'layout' => $cols->get(1)->nodeValue,
					'rent_desc' => $cols->get(2)->nodeValue
			);
		}

		return $data;
	}

    function __calc_cid($district_id, $property_type) {
    	return 'C'.$this->__calc_pid($district_id, $property_type);
    }

    function __calc_pid($district_id, $property_type) {
    	$c = 'SH';

    	if ($district_id >= 1000) $c = 'BJ';
    	if ($district_id >= 10000) $c = 'GZ';

    	$short_type_name = array('Apartment' => 'A', 
    			'Serviced-Apartment' => 'S', 'Old House' => 'O', 'Villa' => 'V', 'Courtyard' => 'C');

    	if (key_exists($property_type, $short_type_name)) {
    		$t = $short_type_name[$property_type];
    	}
    	else {
    		$t = 'Z';
    	}

    	$this->lastPid += 1;
    	return $c.$t.$this->lastPid;
    }
}
