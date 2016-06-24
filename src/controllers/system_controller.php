<?php
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * Logoloto(tm) :  The best CPA advertisement network (http://www.logoloto.com)
 * Copyright 2009-2010, Shanghai Lanvue Network Technology Co.,Ltd. (http://www.lanvue.com)
 *
 * @filesource
 * @copyright     Copyright 2009-2010, Shanghai Lanvue Network Technology Co.,Ltd. (http://www.lanvue.com)
 */

class SystemController extends AppController {

	public $components = array('Email');

	public $helpers = array('Fck');

	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allowedActions = array('commonClearCache', 'editor', 
	    	'reportBrowserEnv', 'r',
	    	'view', 'fp', 't', 'ipv6', 'testCurl', 'olivia', 'testSMS2',
	    	'simpleUserEvent', 
	    	'simpleGetJson', 
	    	'sendTestEdmMail');
	}

	public function commonClearCache() {
		clearCache('daily_/', 'common', '');
		clearCache('hourly_/', 'common', '');
		clearCache('minute_/', 'common', '');
		clearCache('minutes2_/', 'common', '');
		clearCache('minutes5_/', 'common', '');
		clearCache('minutes10_/', 'common', '');
		die();
	}

  public function testSMS($url, $method, $postBody = false, $headers = false, $ua = 'logoloto curl') {
    $ch = curl_init();

    $request = array(
      'url' => $url,
      'method' => $method,
      'body' => $postBody,
      'headers' => $headers
    );

    curl_setopt($ch, CURLOPT_URL, $u*rl);

    if ($postBody) {
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postBody);
    }
    
    // We need to set method even when we don't have a $postBody 'DELETE'
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, true);
    if ($headers && is_array($headers)) {
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    $data = @curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $errno = @curl_errno($ch);
    $error = @curl_error($ch);
    @curl_close($ch);
    if ($errno != CURLE_OK) {
      // 
    }

    list($raw_response_headers, $response_body) = explode("\r\n\r\n", $data, 2);
    $response_header_lines = explode("\r\n", $raw_response_headers);
    array_shift($response_header_lines);
    $response_headers = array();
    foreach($response_header_lines as $header_line) {
      list($header, $value) = explode(': ', $header_line, 2);
      if (isset($response_header_array[$header])) {
        $response_header_array[$header] .= "\n" . $value;
      } else $response_header_array[$header] = $value;
    }

    $response = array('http_code' => $http_code, 'data' => $response_body, 'headers' => $headers);

    return $response;
  }

  public function floatTest() {
  	$b = '0000000000000000111111111111111101111101001001010101010011100001';
		$o = base_convert($b, 2, 10);
		var_dump($o);
	
		$o = floatval($o);
		var_dump($o);
	
		$b = base_convert($o, 10, 2);
		var_dump($b);
	
		die();
  }

  public function testSMS2() {
    App::import('Vendor', 'nusoap/lib/nusoap');
    App::import('Lib', 'sms/client');

    $mobile = '13918352990';
    $message = 'test sms';

    $statusCode = -1;
    $client = new Client(SMS_GATEWAY, SMS_SN, SMS_PASSWORD, SMS_SESSION_KEY);
    $client->setOutgoingEncoding("UTF-8");

    $statusCode = $client->login();
    if ($statusCode != null && $statusCode == "0") {
        echo $client->getBalance();
        pr($client->getEachFee());
        // $statusCode = $client->sendSMS(array($mobile), $message);
    }

    $this->autoRender = false;
    exit();
  }

	public function testSemophere() {
		$time = time();

		$semKey = ftok($_SERVER['PHP_SELF'], 't');
		$semId = sem_get($semKey);

		if (sem_acquire($semId)) {
			$this->log("[$time]1234567890!", LOG_DEBUG);
			$this->log("[$time]abcdefghijklmnopqrstuvwxyz!", LOG_DEBUG);
		}
		sem_release($semId);

		die();
	}

	public function view() {
		echo $this->Auth->password('guanwangwang');

    die();
	}

	public function testSoap() {
		$requestBody = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
	        "<msgs>\n" .
	        "    <id_user>30</id_user>\n" .
	        "    <id_channel>5</id_channel>\n" .
	        "    <id_agent>3</id_agent>\n" .
	        "    <loginName>wangjian</loginName>\n" .
	        "    <password>111111</password>\n" .
	        "    <msgType>0</msgType>\n" .
	        "    <date_order>1260785660812</date_order>\n" .
	        "    <srcId>123</srcId>\n" .
	        "    <msg>\n" .
	        "        <phone>13918352990</phone>\n" .
	        "        <content>this is a messsage sent at 2010/07/29 11:10:00, through zrnhe.com</content>\n" .
	        "    </msg>\n" .
	        "</msgs>";

		$useCURL = isset($_POST['usecurl']) ? $_POST['usecurl'] : '0';
		$client = new soapclient('http://114.80.155.22/msgWebService/services/MsgReceiveService?WSDL', true);
		$err = $client->getError();
		if ($err) {
			echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
		}
		$client->setUseCurl($useCURL);
		$result = $client->call('ReceiveMsg', array('in0' => $requestBody), '', '', false, true);

		if ($client->fault) {
			echo '<h2>Fault</h2><pre>';
			print_r($result);
			echo '</pre>';
		} else {
			$err = $client->getError();
			if ($err) {
				echo '<h2>Error</h2><pre>' . $err . '</pre>';
			} else {
				echo '<h2>Result</h2><pre>';
				print_r($result);
				echo '</pre>';
			}
		}

		echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
		echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
		echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';

		die();
	}

	public function updateCachePrizeQuantity() {
		$this->loadModel('CacheUserMatchedAd');

		$this->CacheUserMatchedAd->contain(array('Prize' => array('fields' => array('id', 'is_clone', 'prototype_id'))));

		$records = $this->CacheUserMatchedAd->find('all', 
			array (
				'fields' => array('id', 'prize_id'), 
				'conditions' => array('prize_quantity_adjusted' => 0, 'prize_id' => 7294),
				'limit' => 1
			)
		);

		$i = 0;
		$lastId = 0;
		foreach ($records as $record) {
			++$i;

			$prize_id = $prototype_id = $record['Prize']['id'];
			$quantity = $this->Prize->query("SELECT SUM(`quantity`) AS `quantity` FROM `prizes` AS `Prize`"
				." WHERE `id`=$prize_id OR `prototype_id`=$prototype_id");

			$quantity = $quantity[0][0]['quantity'];
			$sql = "UPDATE `cache_user_matched_ads` SET `prize_quantity`=$quantity, `prize_quantity_adjusted`=1"
				." WHERE `id`={$record['CacheUserMatchedAd']['id']}";
			$this->Prize->query($sql);

			$lastId = $record['CacheUserMatchedAd']['id'];
		}
	}

	public function updatePrizeWinners() {
		$this->loadModel('GmAward');
		$this->loadModel('AggregationPrizeWinner');

		$this->GmAward->contain(array(
				'Prize' => array(
					'fields' => array('id', 'name', 'price', 'prototype_id'),
					'GmAd' => array(
						'fields' => array('id', 'prototype_id'),
						'Game' => array('fields' => array('id', 'name', 'type'))),
						'Enterprise' => array(
							'fields' => array('id', 'name'),
							'EpSite' => array('fields' => array('id', 'name'))
						)
				),

				'User' => array(
					'fields' => array('id', 'email', 'name', 'avatar'),
					'Profile' => array(
						'fields' => array('id', 'gender', 'birthday'),
						'Earning' => array('fields' => array('id', 'lower_bound', 'upper_bound')),
						'Profession' => array('fields' => array('id', 'name')),
						'Education' => array('fields' => array('id', 'name')),
						'Province' => array('fields' => array('id', 'name')),
						'City' => array('fields' => array('id', 'name')),
					)
				)
		));

		$winners = $this->GmAward->find('all', array('conditions' => array('user_id' => 12437)));

//		pr($winners);
//		die();

		$gameTypes = array (
			'gm_aqs' => '快乐不倒问',
			'gm_slot_machines' => '时来运转',
			'gm_gotchas' => '乐客来找茬',
			'gm_fingers' => '乐翻天'
		);

		$i = 0;
		foreach($winners as $winner) {
			$aggregated = array('AggregationPrizeWinner' => array(
				'award_id'  => $winner['GmAward']['id'],

				'user_id'  => $winner['User']['id'],
				'user_email'  => $winner['User']['email'],
				'user_name'  => $winner['User']['name'],
				'user_avatar'  => $winner['User']['avatar'],
				'user_gender'  => $winner['User']['Profile']['gender'],
				'user_birthday'  => $winner['User']['Profile']['birthday'],

				'earning_id' => $winner['User']['Profile']['Earning']['id'],
				'earning_lower_bound' => $winner['User']['Profile']['Earning']['lower_bound'],
				'earning_upper_bound' => $winner['User']['Profile']['Earning']['upper_bound'],
				'profession_id' => $winner['User']['Profile']['Profession']['id'],
				'profession_name' => $winner['User']['Profile']['Profession']['name'],
				'education_id' => $winner['User']['Profile']['Education']['id'],
				'education_name' => $winner['User']['Profile']['Education']['name'],
				'province_id' => $winner['User']['Profile']['Province']['id'],
				'city_id' => $winner['User']['Profile']['City']['id'],
				'city_full_name' => $winner['User']['Profile']['Province']['name']
									.$winner['User']['Profile']['City']['name'],

				'gm_ad_id'  => $winner['Prize']['GmAd']['id'],
				'gm_ad_prototype_id'  => $winner['Prize']['GmAd']['prototype_id'],

				'game_id'  => $winner['Prize']['GmAd']['Game']['id'],
				'game_name'  => $winner['Prize']['GmAd']['Game']['name'],
				'game_type'  => $gameTypes[$winner['Prize']['GmAd']['Game']['type']],

				'prize_id'  => $winner['Prize']['id'],
				'prize_name'  => $winner['Prize']['name'],
				'prize_prototype_id'  => $winner['Prize']['prototype_id'] ? $winner['Prize']['prototype_id'] : $winner['Prize']['id'],
				'prize_price'  => $winner['Prize']['price'],

				'enterprise_id' => $winner['Prize']['Enterprise']['id'],
				'enterprise_name' => $winner['Prize']['Enterprise']['name'],
				'site_id' => $winner['Prize']['Enterprise']['EpSite']['id'],
				'site_name' => $winner['Prize']['Enterprise']['EpSite']['name'],

				'win_time' => $winner['GmAward']['created'],
				'status' => $winner['GmAward']['status']
			));

pr($aggregated);
die();

			$this->AggregationPrizeWinner->create();
			$this->AggregationPrizeWinner->save($aggregated);

			$this->GmAward->create();
			$this->GmAward->id = $winner['GmAward']['id'];
			$this->GmAward->saveField('aggregated', 1);
		}
		
		die();
	}

	public function fixOliviaPrizeBug($id = null) {
		$this->loadModel('Game');

		$inviter_id = 3442;

						// 给邀请人发放年卡
						$this->Game->query("START TRANSACTION");

						// 已经申请发货的季度卡就不能再转换为月卡
						$prize_id = OLIVIA_PRIZE_ID_JIDUKA;
						$this->loadModel('GmAward');
						$this->GmAward->recursive = -1;
						$count = $this->GmAward->find('count', array('conditions' => array(
							'user_id' => $inviter_id, 'prize_id' => $prize_id, 'status' => 'CREATED')));

						$prize_id = OLIVIA_PRIZE_ID_NIANKA;
						$prize_name = OLIVIA_PRIZE_NAME_NIANKA;
						$gm_ad_id = OLIVIA_DUMMY_GM_AD_ID;
						$gm_ad_package_id = OLIVIA_DUMMY_GM_AD_PACKAGE_ID;

						if ($count == 2) {
							$this->status['s'] = 2655;

							// Update status
							$this->Game->query("UPDATE `gm_awards` AS `GmAward` SET `GmAward`.`status` = 'CANCELED'"
								." WHERE `user_id`=$inviter_id AND `status`='CREATED' AND `prize_id`=".OLIVIA_PRIZE_ID_JIDUKA);
							$this->Game->query("UPDATE `aggregation_prize_winners` AS `Winner` SET `Winner`.`status` = 'CANCELED'"
								." WHERE `user_id`=$inviter_id AND `status`='CREATED' AND `prize_id`=".OLIVIA_PRIZE_ID_JIDUKA);

							$sql = "INSERT INTO `gm_awards`(`gm_ad_id`, `gm_ad_package_id`, `prize_id`, `user_id`)"
								." VALUES($gm_ad_id, $gm_ad_package_id, $prize_id, $inviter_id)";
							$this->Game->query($sql);
						}
						else {
							$this->log('Unexcepted JiDuKa for user '.$inviter_id, LOG_ALERT);
						}

						$this->Game->query("COMMIT");
		die();
	}

	public function testLoadGmAd() {
		$this->loadModel('GmAd');

		// GmAds
		$this->GmAd->contain(array(
			'Game' => array('fields' => array('id', 'name', 'type', 'status'), 
				'conditions' => array('Game.status' => array('RUNNING'))),
			'Prize' => array('fields' => array('id', 'name', 'quantity', 'level', 
				'pic_small', 'price', 'prototype_id', 'status'), 
				'conditions' => array('Prize.status' => array('WAITING', 'RUNNING', 'FINISHED'))), 
			'GmAdPackage' => array('fields' => array('id', 'status'), 
				'conditions' => array('GmAdPackage.status' => array('WAITING', 'RUNNING'))),
			'Enterprise' => array('fields' => array('logo'))
		));

		$this->gmAds = $this->GmAd->find('all', array(
			'conditions' => array('GmAd.is_clone' => 0, 'GmAd.status' => array('WAITING', 'RUNNING', 'FINISHED'), 'GmAd.id' => array(99, 100)), 
			'limit' => 10000)
		);

		pr($this->gmAds);
		die();
		Configure::write('debug', 0);
	}

	public function testCurl() {
		$this->loadModel('Curl');

		$this->Curl->url = 'http://www.logoloto.vin:8080/logoloto/ContactList?u=ivincent.zhang@gmail.com&p=pinshaluoyan';
		$this->Curl->followLocation = true;

		$res = $this->Curl->execute();

		echo($res);

		$this->autoLayout = false;
		die();
	}

	public function fp() {
		$this->loadModel('GmAd');
		$this->GmAd->recursive = -1;
		$gmAdId = 1085;
		$gmAds = $this->GmAd->find('list', array(
			'fields' => array('id'),
			'conditions' => array('or' => array('id' => $gmAdId, 'prototype_id' => $gmAdId))));

		$gmAdIds = implode(',', $gmAds);

		$this->loadModel('StatGame');
		$this->StatGame->recursive = -1;
		$data = $this->StatGame->find('all', array(
			'conditions' => array("gm_ad_id	IN ($gmAdIds)", 'action' => 'FINISHED'),
			'limit' => 10
		));
		pr($data);

		die();
	}

	public function ipv6() {
		App::import('Vendor', 'lib/ip');

		pr(getRealRemoteIp(true, 1));

		die();
	}

	public function t() {
		$info = array('a' => 1);

		App::import('Sanitize');

		$items = array(
			array(
				'title' => 'TOTI',
				'link' => 'http://www.flickr.com/photos/inspiration-/4467004245/',
				'media' => Sanitize::html('{"m":"http://farm5.static.flickr.com/4041/4467004245_86ce153151_m.jpg"}'),
				'date_taken' => '2010-03-27T19:59:31-08:00',
				'description' => 'TOTI',
			),

			array(
				'title' => 'LK',
				'link' => 'http://www.flickr.com/photos/23204424@N03/4472137313/',
				'media' => Sanitize::html('{"m":"http://farm5.static.flickr.com/4036/4472137313_c0378714f5_m.jpg"}'),
				'date_taken' => '2009-06-11T16:46:25-08:00',
				'description' => Sanitize::html('<p><a href=\"http://www.flickr.com/people/23204424@N03/\">Mr. Photographist<\/a> posted a photo:<\/p> <p><a href=\"http://www.flickr.com/photos/23204424@N03/4472137313/\" title=\"LK\"><img src=\"http://farm5.static.flickr.com/4036/4472137313_c0378714f5_m.jpg\" width=\"240\" height=\"160\" alt=\"LK\" /><\/a><\/p> '),
			)
		);

		$json = array( 
			'title' => 'Recent Uploads tagged cat', 
			'link' => 'http://www.flickr.com/photos/tags/cat/', 
			'items' => $items 
		);

		//echo json_encode($json);
		echo '('.json_encode($info).')';

		//echo Sanitize::html($json);

		Configure::write('debug', 0);
		die();
	}

	public function admin_listCreatedUsers() {
		$this->loadModel('User');

		$newUsers = $this->paginate('User', array('status' => 'CREATED'));

		$this->set('newUsers', $newUsers);
	}

	public function editor() {
	}

	public function admin_seo() {
		$this->loadModel('Prize');

		if (empty($this->data)) {
			$this->Prize->recursive = -1;
			$prizes = $this->paginate('Prize', array(
				'Prize.status' => array('CREATED', 'WAITING', 'RUNNING', 'FINISHED'),
				'Prize.is_clone' => 0
			));
			$this->set('prizes', $prizes);
		}
		else {
			$this->Prize->save($this->data);

			// Update clones
			$prize_id = $this->data['Prize']['id'];
			$page_keywords = $this->data['Prize']['page_keywords'];
			$page_description = $this->data['Prize']['page_description'];
			$sql = "UPDATE `prizes` SET `page_keywords`=$page_keywords, `page_description`=$page_description"
				." WHERE `is_clone`=1 AND `prototype_id`=$prize_id";
			$this->Prize->query($sql);

			Configure::write('debug', 0);
			$this->autoRender = false;
			exit();
		}
	}

	public function disableAdWithoutPrize() {
		$sql = "update `gm_ads` as `GmAd` set `GmAd`.`status`='CREATED' where `GmAd`.`id` not in "
			." (select `Prize`.`gm_ad_id` from `prizes` AS `Prize`)";

		$this->System->query($sql);

		echo 'finished';

		$this->autoRender = false;
		exit();
	}

	public function insert() {
		//		
//		$i = 10000;
//		for (;$i<10300;$i+=5) {
//			$session = $i.rand();
//			$time = time() - rand(HOUR * 48, HOUR * 480);
//
//			$date = date('Y-m-d H:m:s', $time);
//			$sql = "INSERT INTO `stat_games` VALUES ('$i', '$session', '$date', '1', 'gm_fingers', '1', '192.168.1.2', '/yoda/gm_fingers/', '4aaf5b5fa7ab4[0-1-71-72-74-76]1', 'http://192.168.1.254/yoda/gm_aqs/', 'IMPRESSED')";
//			$stat = $this->StatGame->query($sql);
//
//			++$i;
//			$time += 60;
//			$date = date('Y-m-d H:m:s', $time);
//			$sql = "INSERT INTO `stat_games` VALUES ('$i', '$session', '$date', '1', 'gm_fingers', '1', '192.168.1.2', '/yoda/gm_fingers/', '4aaf5b5fa7ab4[0-1-71-72-74-76]1', 'http://192.168.1.254/yoda/gm_aqs/', 'CLICKED')";
//			$stat = $this->StatGame->query($sql);
//
//			++$i;
//			$time += 60;
//			$date = date('Y-m-d H:m:s', $time);
//			$sql = "INSERT INTO `stat_games` VALUES ('$i', '$session', '$date', '1', 'gm_fingers', '1', '192.168.1.2', '/yoda/gm_fingers/', '4aaf5b5fa7ab4[0-1-71-72-74-76]1', 'http://192.168.1.254/yoda/gm_aqs/', 'ENTERED')";
//			$stat = $this->StatGame->query($sql);
//			
//			++$i;
//			$time += 60;
//			$date = date('Y-m-d H:m:s', $time);
//			$sql = "INSERT INTO `stat_games` VALUES ('$i', '$session', '$date', '1', 'gm_fingers', '1', '192.168.1.2', '/yoda/gm_fingers/', '4aaf5b5fa7ab4[0-1-71-72-74-76]1', 'http://192.168.1.254/yoda/gm_aqs/', 'STARTED')";
//			$stat = $this->StatGame->query($sql);
//			
//			
//			++$i;
//			$time += 60;
//			$date = date('Y-m-d H:m:s', $time);
//			$sql = "INSERT INTO `stat_games` VALUES ('$i', '$session', '$date', '1', 'gm_fingers', '1', '192.168.1.2', '/yoda/gm_fingers/', '4aaf5b5fa7ab4[0-1-71-72-74-76]1', 'http://192.168.1.254/yoda/gm_aqs/', 'FINISHED')";
//			$stat = $this->StatGame->query($sql);
//		}
		
	}

	public function reportBrowserEnv() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_COOKIE['logoloto[envRep]'])) {
			// only the first visit should analysis the environment
			$this->loadModel('StatBrowserEnviroment');
			$data = array(
				'ip' => getRomoteIp(),
				'user_agent' => $_SERVER['HTTP_USER_AGENT'],
				'resolution' => $this->params['form']['resolution']
			);

			if (!$this->StatBrowserEnviroment->save($data)) {
				$this->log('Log browser env info failure', LOG_ERROR);
			}
		}
		else {
			$this->log('Unexcepted access to reportBrowserEnv from '.getRomoteIp(), LOG_ALERT);
		}

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function reportClose() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->loadModel('StatAccess');
//			$data = array(
//				'controller' => $this->params['controller'],
//				'action' => $this->params['action'],
//				'ip' => getRomoteIp(),
//				'referer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null,
//				'uucookie' => $this->uniqueCookie,
//				'user_id' => $this->currentUser['id']
//			);
//
//			if (!$this->StatAccess->save($data)) {
//				$this->log('Log page close info failure', LOG_ERROR);
//			}
		}
		else {
			$this->log('Unexcepted access to reportClose from '.getRomoteIp(), LOG_ALERT);
		}

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function report() {

	}

	public function simpleJSONDecode() {
		$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

		pr(qi_json_decode($json, true));

		$this->autoRender = false;
		exit();
	}

	public function simpleJSONEncode() {
		$arr = array ('a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5);
		echo json_encode($arr);

		$this->autoRender = false;
		exit();
	}

	public function phpinfo() {
		echo phpinfo();

		Configure::Write('debug', 0);
		$this->autoRender = false;
		die();
	}

	public function sendHelloMail() {
	    loadEmailSettings('test', $this->Email);
		$this->Email->template = '__games__report_finish_game__message';
	    $this->Email->send();

	    if ($this->Email->smtpError) {
	    	echo 'Failed, check log for more';
			$this->log('Failed to send email\\n\\tDetailed information:['.$this->Email->smtpError.']', LOG_ALERT);
	    }
	    else {
	    	echo 'Test finished, check admin email for result';
	    }

	    die();
	}

	public function sendTestEdmMail() {
	    loadEmailSettings('test', $this->Email);
		$this->Email->template = '__system__test_invite_edm_mail__message';
		$this->Email->subject = '乐够乐透网邀请你注册，并送你一张价值50元上海杜莎夫人蜡像馆优惠券';
	    $this->Email->send();

	    if ($this->Email->smtpError) {
	    	echo 'Failed, check log for more';
			$this->log('Failed to send email\\n\\tDetailed information:['.$this->Email->smtpError.']', LOG_ALERT);
	    }
	    else {
	    	echo 'Test finished, check admin email for result';
	    }

	    die();
	}

	public function simpleUserEvent() { 
		$this->UserEvent->setParams(array( 
			'allow' => array('system_notify' => true, 'email_notify' => true, 'feeds' => true), 
			'actor' => $this->currentUser, 
			'recipients' => array( 
				array('User' => $this->currentUser), 
				array('User' => array('id' => 49, 'name' => 'ivincent', 'email' => 'xiaosjw@163.com')))
		));

		echo 'ok';
		$this->autoRender = false;
	}

	public function simpleGetJson() {
		
	}

	public function w() {
		$channel = array(
			'channel_id' => -1,
			'timestamp' => $_SERVER['REQUEST_TIME'],
			'info' => ''
		);

		$this->Session->write('Channel', $channel);

		die();
	}

	public function r() {
		Configure::write('debug', 1);

		if ($this->Session->check("Channel")) {
			pr($this->Session->read("Channel"));
		}

		if ($this->Session->check("Invitation")) {
			pr($this->Session->read("Invitation"));
		}

		pr($_COOKIE);

		die();
	}

	public function d() {
		Configure::write('debug', 1);

		// $this->Session->delete('Channel');

		die();
	}

	public function help() {
		
	}
}
?>
