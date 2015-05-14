<?php 
  global $httpCodes;
	$httpCodes = array(
			100 => 'Continue',
			101 => 'Switching Protocols',
			102 => 'Processing',
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			207 => 'Multi-Status',
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			306 => 'Switch Proxy',
			307 => 'Temporary Redirect',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			418 => 'I\'m a teapot',
			422 => 'Unprocessable Entity',
			423 => 'Locked',
			424 => 'Failed Dependency',
			425 => 'Unordered Collection',
			426 => 'Upgrade Required',
			449 => 'Retry With',
			450 => 'Blocked by Windows Parental Controls',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported',
			506 => 'Variant Also Negotiates',
			507 => 'Insufficient Storage',
			509 => 'Bandwidth Limit Exceeded',
			510 => 'Not Extended'
	);

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
    }
    else if ( $interval > 86400 ){
      $number = intval($interval/86400);
      return "${number}天前";
    }
    else if ( $interval > 3600 ){ // > 1 hour
      $number = intval($interval/3600);
      return "${number}小时前";
    }
    else if ( $interval >= 60 ){ // > 1 min
      $number = intval($interval/60);
      return "${number}分钟前";
    }
    else if ( 5 >= $interval){// < 5 second
      return "就在刚才";
    }
    else{ // < 1 min
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
      if(ord($str) > 0xA0 ) {
        $tmpstr .= substr($string, $i, 3);
        $i = $i + 2;
      }

      if(is_numeric($str1)) {
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

  /**
   * Fix option JSON_BIGINT_AS_STRING not implemented bug
   * */
  function qi_json_decode($json, $assoc = null, $depth = 10, $options = null) {
  	$obj = null;

	  if (false && version_compare(PHP_VERSION, '5.4.0', '>=') && !(defined('JSON_C_VERSION') && PHP_INT_SIZE > 4)) {
	  	/** In PHP >=5.4.0, qi_json_decode() accepts an options parameter, that allows you
	  	 * to specify that large ints (like Steam Transaction IDs) should be treated as
	  	 * strings, rather than the PHP default behaviour of converting them to floats.
	  	 */
	  	$obj = json_decode($json, $assoc, $depth, JSON_BIGINT_AS_STRING);
	  } else {
	  	/** Not all servers will support that, however, so for older versions we must
	  	 * manually detect large ints in the JSON string and quote them (thus converting
	  	 *them to strings) before decoding, hence the preg_replace() call.
	  	 */
	  	$max_int_length = strlen((string) PHP_INT_MAX) - 1;
	  	$json_without_bigints = preg_replace('/:\s*(-?\d{'.$max_int_length.',})/', ': "$1"', $json);
	  	$obj = json_decode($json_without_bigints, $assoc, $depth);
	  }

	  return $obj;
  }

  /**
   * 简单对称加密算法之加密
   * @param String $string 需要加密的字串
   * @param String $skey 加密EKY
   * @author Anyon Zou <zoujingli@qq.com>
   * @date 2013-08-13 19:30
   * @update 2014-10-10 10:10
   * @return String
   */
  function symmetric_encode($string = '', $skey = 'bIuTrY6') {
    if (empty($string)) {
      return '';
    }

    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
      $key < $strCount && $strArr[$key].=$value;
    return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
  }

  /**
   * 简单对称加密算法之解密
   * @param String $string 需要解密的字串
   * @param String $skey 解密KEY
   * @author Anyon Zou <zoujingli@qq.com>
   * @date 2013-08-13 19:30
   * @update 2014-10-10 10:10
   * @return String
   */
  function symmetric_decode($string = '', $skey = 'bIuTrY6') {
    if (empty($string)) {
      return '';
    }

    $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
      $key <= $strCount && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
    return base64_decode(join('', $strArr));
  }

  function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
  }

  function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
  }

  function strContains($haystack, $needle) {
    return empty($needle) || false !== strpos($haystack, $needle);
  }

  function striContains($haystack, $needle) {
  	return empty($needle) || false !== stripos($haystack, $needle);
  }
  
  function removeTail($haystack, $needle) {
    if (empty($needle)) return $haystack;

    $pos = strpos($haystack, $needle);
    if ($pos !== false) {
      $s = substr($haystack, 0, $pos);
      return $s;
    }

    return $haystack;
  }

  function strContainsAny($haystack, $array) {
    foreach ($array as $s) {
      if (strContains($haystack, $s)) {
        return true;
      }
    }

    return false;
  }

  function compareIgnoreSpace($str1, $str2) {
    $str1 = preg_replace('/\s+/', ' ', $str1);
    $str2 = preg_replace('/\s+/', ' ', $str2);

    return strcasecmp($str1, $str2);
  }

  function groupUrls($urls) {
    if (is_string($urls)) {
      $urls = str_replace("://", ":\\\\", trim($urls));
      $urls = str_replace("\r\n", "\n", $urls);
      $urls = explode("\n", $urls);
    }
    sort($urls);

    $urlGroups = array();
    foreach($urls as &$url) {
      $url = rtrim($url, "/");
      $prefix = substr($url, 0, strrpos($url, "/"));

      $words = explode("/", $url);
      $count = count($words);
      $lastWord = $words[$count - 1];

      $key = $count.$prefix;
      if (strContains($lastWord, "page")) {
        $key .= "page";
      }

      if (!isset($urlGroups[$key])) {
        $urlGroups[$key] = array();
      }

      array_push($urlGroups[$key], $url);
    }

    $urlGroups2 = array();
    foreach (array_keys($urlGroups) as $key) {
      $urls = $urlGroups[$key];
      $count = count($urls);
       $regex = generatorSimpleRegex($urls);
       $urlGroups2[$count] = array('regex' => $regex, 'urls' => $urls);
    }

    krsort($urlGroups2, SORT_NUMERIC);
    return $urlGroups2;
  }

  function generatorSimpleRegex($urls) {
    if (is_string($urls)) {
      $urls = str_replace("://", ":\\\\", trim($urls));
      $urls = str_replace("\r\n", "\n", $urls);
      $urls = explode("\n", $urls);
    }

    $maxWords = 0;
    foreach($urls as &$url) {
      $url = explode("/", $url);
      $maxWords = max($maxWords, count($url));
    }

    $solutions = array();
    for ($i = 0; $i < $maxWords; ++$i) {
      $solution = $urls[0][$i];

      $isSame = true;
      for ($j = 0; $j < count($urls); ++$j) {
        if (!isset($urls[$j][$i])) {
          $isSame = false;
  
          if (!is_array($solution)) {
            $solution = array();
            $message = array('type' => 'end', 'index' => '?');
            array_push($solution, $message);
          }
  
          $message = array('type' => 'end', 'index' => $i);
          array_push($solution, $message);
        }
        else if ($urls[$j][$i] != $solution) {
          $isSame = false;

          if (!is_array($solution)) {
            $message = array('type' => 'different', 'i' => $i, 'j' => $j, 'word' => $solution);
            $solution = array();
            array_push($solution, $message);
          }
  
          $message = array('type' => 'different', 'i' => $i, 'j' => $j, 'word' => $urls[$j][$i]);
          array_push($solution, $message);
        }
      } // for
  
      array_push($solutions, $solution);
    } // for

    foreach ($solutions as &$solution) {
      if (is_array($solution)) {
        $words = array();
        foreach ($solution as $s) {
          array_push($words, $s['word']);
        }

        if (areNumeric($words)) {
          $solution = "(\\d+)";
        }
//         else if (areDate($words)) {
//           // $solution = "(\\d+)";
//         }
        else if (arePage($words)) {
          $solution = "(.{0,10}page.+)";
        }
//         else if (areWords($words)) {
//         }
        else {
          $solution = "(.+)";
        }
      }
    }

    $regex = "^";
    $regex .= implode("/", $solutions);
    $regex = str_replace(":\\\\", "://", $regex);
    $regex .= "/{0,1}";
    $regex .= "$";

    return $regex;
  }

  function areNumeric($words) {
    $r = true;
    foreach ($words as $word) {
      if (!is_numeric($word)) {
          $r = false;
          return $r;
      }
    }
    return $r;
  }

  function arePage($words) {
    foreach ($words as $word) {
      if (false === stripos($word, 'page')) {
        return false;
      }
    }
    return true;
  }

  function areWords($words) {
    return true;
  }

  function recurse_copy($src, $dst) {
    $dir = opendir($src);

    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
      if (( $file != '.' ) && ( $file != '..' )) {
        if ( is_dir($src . '/' . $file) ) {
          recurse_copy($src . '/' . $file,$dst . '/' . $file);
        }
        else {
          copy($src . '/' . $file,$dst . '/' . $file);
        }
      }
    }

    closedir($dir);
  }

  function get_tld($url) {
    $info = parse_url($url);
    $host = $info['host'];

    $host_names = explode(".", $host);
    $bottom_host_name = $host_names[count($host_names)-2] . "." . $host_names[count($host_names)-1];

    return $bottom_host_name;
  }

  if (!function_exists("http_build_url")) {
    function http_build_url($url, $options) {
      $parts = parse_url($url);
      $href = $parts['scheme'] . '://';
      if (isset($parts ['user'] ) && isset($parts ['pass'] )) {
        $href .= $parts ['user'] . ':' . $parts ['pass'] . '@';
      }

      $href .= $parts ['host'];
      if (isset($parts ['port'] )) {
        $href .= ':' . $parts ['port'];
      }

      $href .= $options['path'];

      return $href;
    }
  }

  function getResponseStatus($code = 200, $customMessage = '', $data = null) {
  	global $httpCodes;

    $result = [
        'code' => $code,
        'message' => $httpCodes[$code],
        'customMessage' => $customMessage,
        'data' => $data
    ];

    return $result;
  }

  function getResponseStatusJson($code = 200, $customMessage = "", $data = null) {
    $result = getResponseStatus($code, $customMessage, $data);
    return json_encode($result);
  }
