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
?>
<?php
class CommonController extends AppController {

	public function beforeFilter() {
	  parent::beforeFilter();
		$this->Auth->allowedActions = array('*');
	}

	public function listCities($provinceId) {
		$this->loadModel('Area');
		$cityOption = $this->Area->find('list', array('fields' => array('id', 'name'), 'conditions' => array('root' => $provinceId)));

		echo json_encode($cityOption);

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function click($timestamp, $controller, $action, $argu = '') {
		$status = array('tip' => array(), 'messages' => array(), 'timestamp' => $_SERVER['REQUEST_TIME']);

		// 只有登录会员有效
		if ($this->currentUser['id'] == 0) {
		    return ;
		}

		// 提醒功能
		// 根据不同情况返回不同tip，为了防止多个会员同时使用同一台电脑时出现消息系统故障，cookie名带上会员名
		$cookieName = TOOL_BAR_COOKIE_NAME.$this->currentUser['id'];
		$toolBarCookie = $this->Cookie->read($cookieName);
		$tipInfo = array();
		parse_str($toolBarCookie, $tipInfo);

		$msg = '';
		$msgReady = false;
		$lastMsgId = isset($tipInfo['msgid']) ? $tipInfo['msgid'] : '';
		if (!isset($tipInfo['lstMsgT'])) $tipInfo['lstMsgT'] = 0;

		// First visit tag
		$frt = $this->Cookie->read('frttag');

		if (isset($tipInfo['fts'])) {
    		// 提醒功能第一部分：刚刚注册，新手引导

    		// fts : fresh tutorial step
		    if ($tipInfo['fts'] == 'activate' && $controller == 'profiles' && $action == 'basic') {
    		  	// 激活成功，引导用户填写个人资料
    			$msg = "你需要完善你的资料才能参与游戏。完善资料后，你将获得".USER_FIRST_PROFILE_LEDOU."颗乐豆。";

    			// last message
    			$tipInfo['msgid'] = 'fts-activate';
		    }
		    else if ($tipInfo['fts'] == 'profile' && $controller == 'profiles') {
		    	// Only the first time filling the consignee can this message appear, once

		        // 个人资料填写完毕，提醒完善收货地址
    			$msg = "你完善了个人资料，并且获得了".USER_FIRST_PROFILE_LEDOU."颗乐豆。为了保证奖品顺利送到你手中，请完善你的收货信息，系统将再送你".USER_FIRST_DEST_LEDOU."颗乐豆。";
    			$tipInfo['msgid'] = 'fts-profile';

			    if (date('Ymd') <= '20100709') {
			        // 优惠券
    			}
		    }
		    else if ($tipInfo['fts'] == 'consignee' && $controller == 'profiles') {
		    	// Only the first time filling the consignee can this message appear, once

    			$msg = "恭喜你完善了收货地址，并获得".USER_FIRST_DEST_LEDOU."颗乐豆。赶紧";
			    $msg .= "<a href='{$this->base}/games'>参与游戏</a>";
    			$msg .= "获取你喜欢的奖品吧。";

    			$tipInfo['msgid'] = 'fts-consignee';

    			// 新手引导结束
    			unset($tipInfo['fts']);
            }

            $msgReady = true;

            // 同一个提醒，必须至少间隔5分钟
            if ($lastMsgId == $tipInfo['msgid']) {
                if (isset($tipInfo['lstMsgT']) && $_SERVER['REQUEST_TIME'] - $tipInfo['lstMsgT'] < TIP_TIME_INTERVAL) {
                    $msgReady = false;
                }
            }

            // 新手上路，只有第一天提醒
			if ($tipInfo['lstMsgT'] != 0 && $_SERVER['REQUEST_TIME'] - $tipInfo['lstMsgT'] > DAY) {
				unset($tipInfo['fts']);
				$msgReady = false;
			}
		}
		else if (empty($frt) && 
			(
				($controller == 'default' && $action == 'index2')
				|| 
				($controller == 'games' && $action == 'index')
				|| 
				($controller == 'prizes')
			)
		) {
		    // 提醒功能第二部分：在这台电脑上第一次登录，向用户提示玩法

			$msg = "你知道吗？你只需要玩游戏就有机会免费领取各种奖品哦！";
			$msg .= "<a href='{$this->base}/pages/help' target='_blank'>查看详情>></a>";
			$tipInfo['msgid'] = 'frt';
    		$msgReady = true;

			// First Introduction
			$this->Cookie->write('frttag', 1, false, '10 years');
		}
		else if ($_SERVER['REQUEST_TIME'] - $tipInfo['lstMsgT'] > TIP_TIME_INTERVAL){
		    // 提醒功能第三部分：每日提醒。每次请求提醒信息时，仅显示第一个未显示的提醒。
		    // 如果有多个提醒，两次提醒时间之间不得低于5分钟

			// 开始 ：延迟发货的提醒
			if (false) {
				if (!$msgReady && !isset($tipInfo['deli2']) && $msg == '') {
					$msg = "由于物流配送价格变化，上海本地的到付费用由原来的5.5—7.5元调整到6.5—8.5元，特此提醒！";
					$msg .= "<a href='{$this->base}/pages/help_logistics' target='_blank'>查看详情>></a>";

					$tipInfo['msgid'] = 'deli2';
					$tipInfo['deli2'] = 1;

					$msgReady = true;
				}
			}
			// 结束 ： 延迟发货的提醒

		    // 开始 : 用户登录后，如果没有完善个人资料，则提醒完善个人资料，每天提醒一次
		    if (!$msgReady && !isset($tipInfo['pit'])) {
   			    $this->loadModel('Profile');
				$profile = $this->Profile->find('first', array(
			    	'fields' => array('essential_modified'),
			    	'conditions' => array('user_id' => $this->currentUser['id'])));

		    	if (!empty($profile) && empty($profile['Profile']['essential_modified'])) {
					$msg = "你还没有填写你的个人资料，只有完善了资料才有机会获大奖哦。点击";
					$msg .= "<a href='{$this->base}/profiles/basic' target='_blank'>这里</a>";
					$msg .= "完善个人资料。";

					// Check Out Tip
					$tipInfo['msgid'] = 'pit';
					$tipInfo['pit'] = 1;

					$msgReady = true;
		    	}
		    }
		    // 结束 ：用户登录后，如果没有完善个人资料，则提醒完善个人资料

		    // 开始 : 用户登录后，如果没有完善收货地址，则提醒完善收货地址，每天提醒一次
		    if (!$msgReady && !isset($tipInfo['dit'])) {
   			    $this->loadModel('UserDest');
				$count = $this->UserDest->find('count', 
					array('conditions' => array(
						'user_id' => $this->currentUser['id'], 'is_hidden' => 0
				)));

				if ($count == 0 && empty($profile['Profile']['essential_modified'])) {
					if (false && date('Ymd') <= '20100601') {
						$msg = "为了确保奖品能及时发送到你手中，请完善你的收货地址。现在完善收货地址，立即获得杜莎夫人优惠券一张。点击";
					}
					else {
						$msg = "为了确保奖品能及时发送到你手中，请完善你的收货地址。点击";
					}

					$msg .= "<a href='{$this->base}/profiles/dest' target='_blank'>这里</a>";
					$msg .= "完善收货地址。";

					// Dest Tip
					$tipInfo['msgid'] = 'dit';
					$tipInfo['dit'] = 1;

					$msgReady = true;
		    	}
		    }
		    // 开始 : 用户登录后，如果没有完善收货地址，则提醒完善收货地址，每天提醒一次

			// 开始 ： 未申请发货的提醒，每天提醒一次
			if (!$msgReady && !isset($tipInfo['chk']) && (
					($controller == 'default' && $action == 'index2')
					|| 
					($controller == 'games' && $action == 'index')
					|| 
					($controller == 'prizes' && $action == 'index')
					|| 
					($controller == 'profiles' && $action == 'basic')
				)) {
				$this->loadModel('Winner');
				$this->Winner->recursive = -1;
				$prize = $this->Winner->find('first', array(
				    'fields' => array('id', 'prize_id', 'prize_name', 'prize_price'),
					'conditions' => array(
						'user_id' => $this->currentUser['id'], 
						'status' => 'CREATED'),
				    'order' => 'id desc'
				));

				if (!empty($prize)) {
					$msg = "你获得了价值<span style='color:#F00; font-weight:bold;'>{$prize['Winner']['prize_price']}</span>元的";
					$msg .= "<a href='{$this->base}/prizes/view/{$prize['Winner']['prize_id']}' target='_blank'>{$prize['Winner']['prize_name']}</a>";
					$msg .= "一份，点击<a href='{$this->base}/my_prizes/fresh'>这里</a>申请发货。";

					// Check Out Tip
					$tipInfo['msgid'] = 'chk';
					$tipInfo['chk'] = 1;

					$msgReady = true;
				}
			}
			// 结束 ：未申请发货的提醒

			// 开始 ： 已经发货但尚未确认收货的提醒，离发货日期一周后每天提醒一次，并且每天只检查一次
			if (!$msgReady && !isset($tipInfo['cfm']) && $_SERVER['REQUEST_TIME'] - $tipInfo['lstMsgT'] > 7 * DAY) {
  				$this->loadModel('Winner');
  				$this->Winner->recursive = -1;
  				$prize = $this->Winner->find('first', array(
  				    'fields' => array('id', 'prize_id', 'prize_name', 'prize_price', 'modified'),
  					'conditions' => array(
  						'user_id' => $this->currentUser['id'], 
  						'status' => 'ONBOARD'),
  				    'order' => 'id desc'
  				));

  				if (!empty($prize)) {
  				    if ($_SERVER['REQUEST_TIME'] - strtotime($prize['Winner']['modified']) > TIP_CONFIRM_TIME) {
    					$msg = "我们已为你发出奖品";
    					$msg .= "<a href='{$this->base}/prizes/view/{$prize['Winner']['prize_id']}' target='_blank'>{$prize['Winner']['prize_name']}</a>";
    					$msg .= "，请<a href='{$this->base}/my_prizes/fresh'>确认收货</a>。如有疑问，请";
    					$msg .= "<a href='{$this->base}/pages/service'>联系客服人员</a>。";
    					$msg .= "（查看<a href='{$this->base}/pages/help_logistics'>物流配送说明</a>）";
  
    					// Confirm prize received
    					$tipInfo['msgid'] = 'cfm';
    
    					$msgReady = true;
  				    }
			    }
			}
			// Check ONLY ONCE everyday
			$tipInfo['cfm'] = 1;
			// 结束 ：未申请发货的提醒

			// 开始 ：乐豆不足的提醒, 每天提醒一次
			if (!$msgReady && !isset($tipInfo['ld']) && $msg == '' &&
				(($controller == 'gm_fingers' && $action == 'view')
					|| ($controller == 'gm_gotchas' && $action == 'view')
					|| ($controller == 'gm_aqs' && $action == 'view')
					|| ($controller == 'games' && $action == 'index')
				)
			) {
				$ledou = $this->currentUser['point'];
				if ($ledou <= 10) {
					$msg = "你的乐豆已经很少了，快去";
					$msg .= "<a href='{$this->base}/gain' target='_blank'>赚乐豆</a>";
					$msg .= "吧！";

					// Ledou Status Tip
					$tipInfo['msgid'] = 'ld';
					$tipInfo['ld'] = 1;

					$msgReady = true;
				}
			}
			// 结束 ： 乐豆不足的提醒
		}

		if ($msgReady && $msg != '') {
			$status['tip'] = array(uniqid('msg_') => $msg);
			// Last Message Time
			$tipInfo['lstMsgT'] = $_SERVER['REQUEST_TIME'];
		}

		if (false) {
			$msg = "因年底清仓，请中奖会员于12月9日之前申请发货，逾期则视为放弃奖品，详情请见";
			$msg .= "<a href='{$this->base}/portals/notice/26' target='_blank'>这里</a>";

			$status['tip'] = array(uniqid('msg_') => $msg);
			// Last Message Time
			$tipInfo['lstMsgT'] = $_SERVER['REQUEST_TIME'];
		}

		$toolBarCookie = "";
		$i = 0;
		foreach ($tipInfo as $k => $v) {
			if ($i++ != 0) {
				$toolBarCookie .= "&";
			}

			$toolBarCookie .= "$k=$v";
		}

		$this->Cookie->write($cookieName, $toolBarCookie, false, '1 day');

		// 系统通知：至少1分钟更新一次
		if ($_SERVER['REQUEST_TIME'] - $tipInfo['lstMsgT'] > 1 * MINUTE) {
			$this->loadModel('Message');
			$this->Message->recursive = -1;
			$messages = $this->Message->find('all', array(
				'fields' => array('id', 'subject', 'has_read'), 
				'conditions' => array('to_id' => $this->currentUser['id'], 'is_notice' => 'Y'))
			);

			$i = 0;
			$unreadMsgCount = 0;
			foreach ($messages as $message) {
				if ($message['Message']['has_read'] == 'N') {
					++$unreadMsgCount;
				}

				// messages数量最多10条
				if (++$i > 10) {
					break;
				}

				$status['messages'][uniqid('msg_')] = "<a href='{$this->base}/messages/read/{$message['Message']['id']}' target='_blank'>{$message['Message']['subject']}</a>";
			}

			$status['unreadMsgCount'] = $unreadMsgCount;
		}

		echo json_encode($status);

		Configure::Write('debug', 0);
		$this->autoRender = false;
		exit();
	}

	public function kissyPictureUpload() {
		Configure::Write('debug', 0);
		$this->autoRender = false;

		//if ($this->currentUser['id'] == 0) {
			//echo json_encode(array(1, '请先登录'));
			//exit();
		//}

		if($_FILES['imgFile']['error'] > 0) {
			switch($_FILES['file']['error']) {
				case 1:
					echo json_encode(array(1, '文件大小超过服务器限制'));
				break;
				case 2:
					echo json_encode(array(1, '文件太大！'));
				break;
				case 3:
					echo json_encode(array(1, '文件只加载了一部分！'));
				break;
				case 4:
					echo json_encode(array(1, '文件加载失败！'));
				break;
			}

			exit();
		}

		if($_FILES['imgFile']['size'] > 1000000){
			echo json_encode(array(1, '文件过大！'));
			exit();
		}

		App::import('Sanitize');
		if (!empty($_FILES['imgFile']) && is_uploaded_file($_FILES['imgFile']['tmp_name'])){
			$f = $_FILES['imgFile'];
			$path = 'uploads/kissy/'.$this->currentUser['id'].'-'.date("ymdHis").".".end(explode(".", $f['name'] ));
			$dest = IMAGES.$path;

		  	copy($f['tmp_name'], $dest);
     		unlink($f['tmp_name']);

			echo json_encode(array(0, $this->webroot.'img/'.$path));
			$this->log('File has been saved as:'.$dest, LOG_DEBUG);
		}
		else {
			echo json_encode(array(1, '文件加载失败！'));
		}

		exit();
	}
	
	public function bmap() {
		
	}

	public function bmarker() {
		$orderIds = isset($this->params['named']['orderIds']) ? $this->params['named']['orderIds'] : '';
		$this->loadModel('Geo');
		$geos = $this->Geo->find('all', array('conditions' => array(
			'order_id' => array_unique(explode(',', $orderIds)))));

		$this->set(compact('geos'));
	}

	// 上传并切割图片
	public function ajaxPictureUpload($op = null, $type=null) {
		Configure::Write('debug', 0);
		$this->autoRender = false;
		
		switch ($op)
		{
			//上传图片
			case "upload":
				if ($type == null) break;
				$path = ''; //上传路径
				switch ($type) {
					case 'portal_ad': $path = 'uploads/portals/portalad_pic/'; break;
				}
				
				if(!file_exists(IMAGES.$path))
				{
					//检查是否有该文件夹，如果没有就创建，并给予最高权限
					mkdir(IMAGES."$path", 0700);
				}//END IF
		
				//允许上传的文件格式
				$tp = array("image/gif","image/pjpeg","image/jpeg","image/png");
				//检查上传文件是否在允许上传的类型
				if(!in_array($_FILES["filename"]["type"],$tp))
				{
					echo "格式不对";
					exit;
				}//END IF
		
				if($_FILES["filename"]["name"])
				{
					$file1=$this->_randStr(3,'all');
					$file2 = $path.time()."_".$file1;
					$flag=1;
				}//END IF
				$filename=$file2.".".end(explode(".", $_FILES["filename"]["name"])) ;
				if($flag) $result=move_uploaded_file($_FILES["filename"]["tmp_name"],IMAGES.$filename);
				//特别注意这里传递给move_uploaded_file的第一个参数为上传到服务器上的临时文件
				if($result)
				{
					echo "{msg:'文件上传成功!!!',filename:'".$filename."'}";
				}
				else
				{
					echo "{msg:'文件上传失败!!!'}";
				}
				break;
		
				//编辑图片
			case "edit":
				$x1=$_POST['x1'];
				$x2=$_POST['x2'];
				$y1=$_POST['y1'];
				$y2=$_POST['y2'];
				$w=$_POST['width'];
				$h=$_POST['height'];
				$filename=$_POST['filename'];
				
				$editfilename=$this->_cutImg($filename,$x1,$x2,$y1,$y2,$w,$h);
				echo  '{"msg":"文件编辑成功","filename":"'.$editfilename.'"}';
				break;
		
			default:
				echo "{erro:'系统错误！！！'}";
				break;
		
		}
	}
	
	//裁剪图片
	private function _cutImg($o_file,$x1,$x2,$y1,$y2,$w,$h) {
		$file=basename($o_file);//文件
		$ext=end(explode(".", $file));//扩展名
		$filename=basename($file,$ext);//文件名

		$filelen=strlen($file);
		$path=substr($o_file,0,strlen(($o_file))-$filelen);//文件夹

		$newfile=$path."edit_".$file;//新文件名

		header('Content-type: image/jpeg');
		list($width, $height) = getimagesize(IMAGES.$o_file);

		$part_width = $x2-$x1;
		$part_height = $y2-$y1;

		$image_n = imagecreatetruecolor($w, $h);
		$image = imagecreatefromjpeg(IMAGES.$o_file);

		imagecopyresampled($image_n, $image, 0, 0, $x1, $y1, $w, $h, $part_width, $part_height);

		//输出文件
		imagejpeg($image_n, IMAGES.$newfile, 85);

		return $newfile;
	}

	//获取随机字符
	private function _randStr($len,$format) {
		switch($format) {
			case 'ALL':
				$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; break;
			case 'CHAR':
				$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; break;
			case 'NUMBER':
				$chars='0123456789'; break;
			default :
				$chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				break;
		}
		mt_srand((double)microtime()*1000000*getmypid());
		$password="";
		while(strlen($password)<$len)
		$password.=substr($chars,(mt_rand()%strlen($chars)),1);
		return $password;
	}
}
?>
