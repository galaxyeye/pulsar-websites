<?php 
	function php_compat_inet_pton($address) {
	    $r = ip2long($address);
	    if ($r !== false && $r != -1) {
	        return pack('N', $r);
	    }

	    $delim_count = substr_count($address, ':');
	    if ($delim_count < 1 || $delim_count > 7) {
	        return false;
	    }

	    $r = explode(':', $address);
	    $rcount = count($r);
	    if (($doub = array_search('', $r, 1)) !== false) {
	        $length = (!$doub || $doub == $rcount - 1 ? 2 : 1);
	        array_splice($r, $doub, $length, array_fill(0, 8 + $length - $rcount, 0));
	    }
	    $r = array_map('hexdec', $r);
	    array_unshift($r, 'n*');
	    $r = call_user_func_array('pack', $r);
	    return $r;
	}

	function php_compat_inet_ntop($in_addr){
	    switch (strlen($in_addr)) {
	        case 4:
	            list(,$r) = unpack('N', $in_addr);
	            return long2ip($r);
	        case 16:
	            $r = substr(chunk_split(bin2hex($in_addr), 4, ':'), 0, -1);
	            $r = preg_replace(
	                array('/(?::?\b0+\b:?){2,}/', '/\b0+([^0])/e'),
	                array('::', '(int)"$1"?"$1":"0$1"'),
	                $r);
	            return $r;
	    }
	    return false;
	}

	if (!function_exists('inet_ntop')) {
	    function inet_ntop($in_addr)
	    {
	        return php_compat_inet_ntop($in_addr);
	    }
	}

	if (!function_exists('inet_pton')) {  
	    function inet_pton($address) {
	        return php_compat_inet_pton($address);
	    }
	}

	// -- some other functions..

	function IsIPv6($Ip) {
		$pattern = "/^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$/";
		return preg_match($pattern, $Ip);
	}

	function IsIPv4MappedFormat($Ip) {
		$Ip = strtolower($Ip);

		$IPv6 = strpos($Ip, '::ffff:') !== false;
		if (!$IPv6) return false;

	    $Ip = substr($Ip, strrpos($Ip, ':') + 1); // Strip IPv4 Mapped notation
	    $Ip = explode('.', $Ip);

	    for ($i = 0; $i < 4; $i++) if ($Ip[$i] > 255) return false;
	    if ($i != 4) return false;

	    return true;
	}

	/**
	 * Convert an IPv4 address to IPv6
	 *
	 * @param string IP Address in dot notation (192.168.1.100)
	 * @return string IPv6 formatted address or false if invalid input
	 */
	function IPv4MappedFormatToIPv6($Ip) {
		$IPv6 = strpos($Ip, ':') !== false;
		$IPv4 = strpos($Ip, '.') > 0;

		if (!$IPv6 && !$IPv4) return false;
		if ($IPv6 && !$IPv4) return collapseIPv6Notation($Ip);

		if ($IPv6) {
		    $Ip = substr($Ip, strrpos($Ip, ':') + 1); // Strip IPv4 Mapped notation
		}
	    $Ip = array_pad(explode('.', $Ip), 4, 0);
	    if (count($Ip) > 4) return false;

	    for ($i = 0; $i < 4; $i++) if ($Ip[$i] > 255) return false;

	    $Part7 = base_convert(($Ip[0] * 256) + $Ip[1], 10, 16);
	    $Part8 = base_convert(($Ip[2] * 256) + $Ip[3], 10, 16);

	    return '::ffff:'.$Part7.':'.$Part8;
	}

	/**
	 * IPv4-Mapped IPv6 Address, eg. ::FFFF:192.168.1.1
	 *
	 *  |                80 bits               | 16 |      32 bits        |
	 *  +--------------------------------------+--------------------------+
   	 *	|0000..............................0000|FFFF|    IPv4 address     |
   	 *	+--------------------------------------+----+---------------------+
	 */
	function IPv6ToIPv4MappedFormat($Ip) {
		$IPv6 = strpos($Ip, ':') !== false;
	    $IPv4 = strpos($Ip, '.') > 0;

		if (!$IPv6) return false;
	    if ($IPv6 && $IPv4) return $Ip;

		$Ip = expandIPv6Notation($Ip);

	    $Parts = explode(':', $Ip);
	    if (count($Parts) != 8 || 
			'0' != $Parts[0] || '0' != $Parts[1] || '0' != $Parts[2] || '0' != $Parts[3] || '0' != $Parts[4] ||  
			strtolower($Parts[5]) != 'ffff') {
	    	return false;
	    }

    	$Ip = array('', '', '', '');

	    $High = base_convert($Parts[6], 16, 10);
	    $Ip[0] = floor($High / 256);
	    $Ip[1] = $High - $Ip[0] * 256;

	    $Low = base_convert($Parts[7], 16, 10);

	    $Ip[2] = floor($Low / 256);
	    $Ip[3] = $Low - $Ip[2] * 256;

	    return '::ffff:'.implode('.', $Ip);
	}

	/**
	 * Do not implement. IPv4 compatable format is deprecated according to rfc4291
	 *
	 *     |                80 bits               | 16 |      32 bits        |
     *     +--------------------------------------+--------------------------+
   	 *	   |0000..............................0000|0000|    IPv4 address     |
	 *	   +--------------------------------------+----+---------------------+
	 */
	function IPv6ToIPv4CompatableFormat($Ip) {
		return false;
	} 

	/**
	* Attempt to find the client's IP Address
	*
	* @param bool Should the IP be converted using ip2long?
	* @return string|long The IP Address
	*/
	function getRealRemoteIp($ForDatabase= false, $DatabaseParts= 2) {
		$Ip = '0.0.0.0';

		if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] != '') {
			$Ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
			$Ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != '') {
			$Ip = $_SERVER['REMOTE_ADDR'];
		}

		if (($CommaPos = strpos($Ip, ',')) > 0) {
			$Ip = substr($Ip, 0, ($CommaPos - 1));
		}

		$Ip = IPv4MappedFormatToIPv6($Ip);

		return ($ForDatabase ? IPv6ToLong($Ip, $DatabaseParts) : $Ip);
	}

	/**
	 * Replace '::' with appropriate number of ':0', for only normal IPv6 format
	 */
	function expandIPv6Notation($Ip, $FullPart = false) {
	    if (strpos($Ip, '::') !== false)
	        $Ip = str_replace('::', str_repeat(':0', 8 - substr_count($Ip, ':')).':', $Ip);

	    if (strpos($Ip, ':') === 0) $Ip = '0'.$Ip;
		if ($Ip[strlen($Ip) - 1] == ':') $Ip = $Ip.'0';

		if ($FullPart) {
			return padIPv6Notation($Ip);
		}

		return $Ip;
	}

	/**
	 * Replace ':0's with '::'
	 */
	function collapseIPv6Notation($Ip) {
	    $Ip = expandIPv6Notation($Ip, true);
		if ($Ip === '0000:0000:0000:0000:0000:0000:0000:0000') {
			return '::';
		}

		$Parts = array(					    
					   '0000:0000:0000:0000:0000:0000:0000', 
					   '0000:0000:0000:0000:0000:0000', 
					   '0000:0000:0000:0000:0000', 
					   '0000:0000:0000:0000', 
					   '0000:0000:0000',
					   '0000:0000'
					  );

		foreach ($Parts as $Part) {
			$pos = strpos($Ip, $Part);
			if ($pos !== false) {
				if ($pos == 0 || $pos == 39 - strlen($Part))
					$Ip = preg_replace('/'.$Part.'/', ':', $Ip, 1);
				else 
					$Ip = preg_replace('/'.$Part.'/', '', $Ip, 1);

				break;
			}
		}

	    return trimIPv6Notation($Ip);
	}

	function trimIPv6Notation($Ip) {
		$Parts = explode(':', $Ip);
		foreach ($Parts as $i => $v) {
			if ($v !== '') {
				$v = ltrim($v, '0');
				$Parts[$i] = $v == '' ? 0 : $v;
			}
			else {
				$Parts[$i] = '';
			}
		}
		$Ip = implode(':', $Parts);

	    return $Ip;
	}

	function padIPv6Notation($Ip) {
		$Parts = explode(':', $Ip);
		foreach ($Parts as $i => $v) {
			$len = strlen($v);
			$Parts[$i] = $len ? str_repeat('0', 4 - $len).$v : '';
		}
		$Ip = implode(':', $Parts);

	    return $Ip;
	}

	/**
	 * Convert IPv6 address to an integer
	 *
	 * Optionally split in to two parts, works only under 64bit OS
	 *
	 * @see http://stackoverflow.com/questions/420680/
	 */
	function IPv6ToLong($Ip, $DatabaseParts= 2) {
		$IPv6 = strpos($Ip, ':') !== false;
	    $IPv4 = strpos($Ip, '.') > 0;

		if (!$IPv6) return false;
		if ($IPv4) $Ip = IPv4MappedFormatToIPv6($Ip);

	    $Ip = expandIPv6Notation($Ip);
	    $Parts = explode(':', $Ip);

	    $Ip = array('', '');
	    for ($i = 0; $i < 4; $i++) $Ip[0] .= str_pad(base_convert($Parts[$i], 16, 2), 16, 0, STR_PAD_LEFT);
	    for ($i = 4; $i < 8; $i++) $Ip[1] .= str_pad(base_convert($Parts[$i], 16, 2), 16, 0, STR_PAD_LEFT);

	    if ($DatabaseParts == 2)
	            return array(base_convert($Ip[0], 2, 10), base_convert($Ip[1], 2, 10));
	    else    return base_convert($Ip[0], 2, 10) + base_convert($Ip[1], 2, 10);
	}

	function LongToIPv6($Part1, $Part2, $AllParts = false, $FullParts = false) {
		$Ip = array('', '');

		$Ip[0] = str_pad(base_convert($Part1, 10, 2), 64, 0, STR_PAD_LEFT);
		$Ip[1] = str_pad(base_convert($Part2, 10, 2), 64, 0, STR_PAD_LEFT);

		$Parts = array();
		for ($i = 0; $i < 2; $i++) {
			for ($j = 0; $j < 64; $j += 16) {
				$Parts[] = base_convert(substr($Ip[$i], $j, 16), 2, 16);
			}
		}

		$Ip = implode(':', $Parts);
		if ($AllParts) {
			return expandIPv6Notation($Ip, $FullParts);
		}
		return collapseIPv6Notation($Ip);
	}
?>
