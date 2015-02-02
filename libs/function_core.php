<?php 
	function getReadableTime($thatTime) {
		$thatTime = strtotime($thatTime);
		$today = new DateTime();
		$middleNight = strtotime(date_format($today, 'Ymd'));

		$timediff = $middleNight + DAY - $thatTime;

		if ($timediff < DAY) {
			return '今天';
		}
		else if ($timediff < DAY * 2) {
			return '昨天';
		}
		else if ($timediff < DAY * 7) {
			$thisWeek = array('1' => '星期一', '2' => '星期二', '3' => '星期三', '4' => '星期四', '5' => '星期五', '6' => '星期六', '7' => '星期天');
			$lastWeek = array('1' => '上周一', '2' => '上周二', '3' => '上周三', '4' => '上周四', '5' => '上周五', '6' => '上周六', '7' => '上周日');
			$t = date("N", strtotime('now'));
			$d = date("N", $thatTime);
			if ($t > $d) {
				return $thisWeek[$d];
			} else {
				return $lastWeek[$d];
			}
		}
		else {
			return date('n月j日', $thatTime);
		}
	}

    function getReadableTime2($time=null, $forceDate=false) {
        $now = time();
        $time = is_numeric($time) ? $time : strtotime($time);

        $interval = $now - $time;

        if ( $forceDate || $interval > 30*86400 ){
            return strftime("%Y-%m-%d %a %H:%M",$time);
        }else if ( $interval > 86400 ){
            $number = intval($interval/86400);
            return "${number}天前";
        }else if ( $interval > 3600 ){ // > 1 hour
            $number = intval($interval/3600);
            return "${number}小时前";
        }else if ( $interval >= 60 ){ // > 1 min
            $number = intval($interval/60);
            return "${number}分钟前";
        }else if ( 5 >= $interval){// < 5 second
            return "就在刚才";
        }else{ // < 1 min
            return "${interval}秒前";
        }
    }

	function genRandomString($len) {
    	$chars = array( 
        	"a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k",  
        	"l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v",  
        	"w", "x", "y", "z", "A", "B", "C", "D", "E", "F", "G",  
        	"H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",  
        	"S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",  
        	"3", "4", "5", "6", "7", "8", "9" 
    	);
		$charsLen = count($chars) - 1; 

		shuffle($chars);    // 将数组打乱 

		$output = ""; 
		for ($i=0; $i<$len; $i++) 
		{ 
			$output .= $chars[mt_rand(0, $charsLen)]; 
		}

		return $output; 
	} 
	
	/**
	 * Trim a longer string to be a shorter one
	 *
	 * @param string $name The name to trim
	 * @param int $len The required length
	 */
	function getShortName($name, $len = 10) {
		if (mb_strlen($name, 'UTF-8') > $len){
			return mb_substr($name, 0, $len, 'UTF-8').'..';
		}

		return $name;
	}

	function getFuzzyIp($ip) {
		return preg_replace('/(::ffff)*(\d+)\.(\d+)\.(\d+)\.(\d+)/i', '$2.$3.$4.*', $ip);
	}

	function trimUrl($url) {
		$len = strlen($url);

		if ($len > 0 && $url[0] == '/') {
			$url = substr($url, 1);
			$len -= 1;
		}
		
		if ($len > 0 && $url[$len - 1] == '/') {
			$url = substr($url, 0, $len - 1);
		}

		return $url;
	}

	/**
	 * Load settings for sending email
	 *
	 * @param string $emailType Indicate the message type
	 * @param Email $email The cake email instance
	 */
	function loadEmailSettings($emailType, &$email) {
		include_once(CONFIGS . 'email.php');
		$config = new EMAIL_CONFIG();
		$email->smtpOptions = $config->smtpOptions;
		foreach ($config->{$emailType} as $key => $value) {
 			$email->{$key} = $value;
		}

		if (!OPEN_MAIL) {
			$email->bcc = array('happyperegrinator@gmail.com', 'yueming1985@gmail.com');
		}
	}


	function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
		$ckey_length = 4;
		$key = md5($key);
		$keya = md5(substr($key, 0, 16));
		$keyb = md5(substr($key, 16, 16));
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

		$cryptkey = $keya.md5($keya.$keyc);
		$key_length = strlen($cryptkey);

		$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
		$string_length = strlen($string);

		$result = '';
		$box = range(0, 255);

		$rndkey = array();
		for($i = 0; $i <= 255; $i++) {
			$rndkey[$i] = ord($cryptkey[$i % $key_length]);
		}

		for($j = $i = 0; $i < 256; $i++) {
			$j = ($j + $box[$i] + $rndkey[$i]) % 256;
			$tmp = $box[$i];
			$box[$i] = $box[$j];
			$box[$j] = $tmp;
		}

		for($a = $j = $i = 0; $i < $string_length; $i++) {
			$a = ($a + 1) % 256;
			$j = ($j + $box[$a]) % 256;
			$tmp = $box[$a];
			$box[$a] = $box[$j];
			$box[$j] = $tmp;
			$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
		}
	
		if($operation == 'DECODE') {
			if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
				return substr($result, 26);
			} else {
				return '';
			}
		} else {
			return $keyc.str_replace('=', '', base64_encode($result));
		}
	}

	function daddslashes($string, $force = 1) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				unset($string[$key]);
				$string[addslashes($key)] = daddslashes($val, $force);
			}
		} else {
			$string = addslashes($string);
		}
		return $string;
	}

	/*
	 * Project Relative
	 * */
	function calc_latlng($latlng) {
	  $result = array(0, 0);

	  $latlng = explode(',', $latlng);
	  if (count($latlng) == 2) {
	    $result[0] = $latlng[0];
	    $result[1] = $latlng[1];
	  }

	  return $result;
	}

	function get_property_js_array($properties) {
	  $jsproperties = "[";

	  if (isset($properties)) {
	   foreach ($properties as $p) {
	    $id = $p['Property']['id'];
	    $compound_id = $p['Property']['compound_id'];
	    $pid = $p['Property']['pid'];
	    $name = addslashes($p['Property']['name_en'].' '.$p['Property']['name_zh']);
	    $area = addslashes($p['Area']['name']);
	    $property_type = $p['Property']['property_type'];
	    $layout = $p['Property']['layout'];
	    $rent = number_format($p['Property']['rent']);
	    $size = $p['Property']['size'];

	    $image = "/";
 	    foreach ($p['PropertyImage'] as $tmp_image) {
 	     if ($tmp_image['is_big'] == '1') {
 	      $image = addslashes($tmp_image['url']);
 	     }
 	    }

	    $jsproperties .= "{id : '{$id}', compound_id : '{$compound_id}', pid : '{$pid}', name : '{$name}', area : '{$area}', property_type : '{$property_type}', layout : '{$layout}', rent : '{$rent}', size : '{$size}', image : '{$image}'}, ";
	   }
	  }

	  $jsproperties .= "]";

	  return $jsproperties;
	}

	function print_all_search_options($option, $old_filter, $html) {
	 if (array_key_exists($option, $old_filter) && trim($old_filter[$option]) == 'null') {
	  echo "<span>All</span>";
	 }
	 else {
	  echo $html->link('All', array_merge($old_filter, array($option => 'null')));
	 }
	}

	function mark_active_article_menu($article_id, $test_id) {
	  if ($article_id == $test_id) return array('class' => 'current');
	  else return array('class' => ' ');
	}

	function mark_active_menu($controller) {
	  if (!in_array($controller, array('properties', 'compounds', 'schools'))) {
	    $controller = 'our-services';
	  }
	
	  echo "menu-$controller-active";
	}

	function mark_current_city($city_id, $currentCity) {
	  if ($city_id == $currentCity) echo 'current-city';
	}

	function check_is_chinese($s) {
		return preg_match('/[\x80-\xff]./', $s);
	}

	//提取中文和数字，去除标签
	function getChinese($string) {
		$tmpstr = '';
	
		$arr = array(1,2,3,4,5,6,7,8,9,0);
	
		$strlen = strlen($string);

		for($i = 0; $i < $strlen; $i++) {
			$str = substr($string, $i, 1);
			$str1 = trim($str);
			if(ord($str) > 0xA0 ){
				$tmpstr .= substr($string, $i, 3);
				$i = $i + 2;
			}

			if(is_numeric($str1)){
				$tmpstr.= $str1;
			}
		}

		return $tmpstr;
	}

	function find_first_chinese($s) {
		for ($i = 0; $i < strlen($s) - 1; ++$i) {
			// pr($s[$i].$s[$i + 1]);

			if (check_is_chinese($s[$i].$s[$i + 1])) {
				return $i;
			}
		}

		return false;
	}

?>
