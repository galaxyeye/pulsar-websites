<?php 

namespace Nutch;

/**
 * @property $urlFilter string url filters seperated by "\n" or "\r\n"
 * @return array 
 * */
function splitUrlFilter($urlFilter) {
	$urlFilter = str_ireplace("+http", "http", $urlFilter);
	$urlFilter = str_ireplace("-http", "http", $urlFilter);
	$urlFilter = str_ireplace("\r\n", "\n", $urlFilter);
	$urlFilter = trim($urlFilter);

	return explode("\n", $urlFilter);
}

/**
 * @property $urlFilter string url filters seperated by "\n" or "\r\n"
 * @return string
 * */
function normalizeUrlFilter($urlFilter) {
	if (empty($urlFilter)) {
		return null;
	}

	$urlFilter = str_ireplace("\r\n", "\n", $urlFilter);
	$urlFilter = trim($urlFilter);
	$normalized = "";
	foreach(explode("\n", $urlFilter) as $f) {
		$f = normalizeUrlFilterRegex($f);

		$f = trim($f);

		if (empty($f)) {
			continue;
		}

		$ch = substr($f, 0, 1);
		if ($ch != '+' && $ch != '-') {
			$normalized .= "+";
		}
		$f = rtrim($f, "/");

		$normalized .= $f;
		$normalized .= "\n";
	}

	return rtrim($normalized, "\n");
}

/**
 * Regex format : 
 * ^http://example.com/a/b/c/(.+)/{0,1}$
 * ^http://example.com/a/b/c/(\d+)/{0,1}$
 * */
function normalizeUrlFilterRegex($regex) {	
	if (empty($regex) || !is_string($regex)) return null;

	if (!startsWith($regex, "http") && !startsWith($regex, "^http")) {
		return $regex;
	}

	$regex = ltrim($regex, "^");
	$regex = rtrim($regex, "$");
	$regex = '^'.$regex.'$';
	return $regex;
}

function regex2urlFilter($regex) {
	if (empty($regex)) return null;

	return normalizeUrlFilterRegex($regex);
}

/**
 * Regex format : 
 * ^http://domain.com/(.+)/{0,1}$
 * ^http://example.com/a/b/c/(\d+)/{0,1}$
 * */
function regex2startKey($regex) {
	if (empty($regex)) return null;

	$startKey = ltrim($regex, "^");
	$startKey = rtrim($startKey, "$");

	if (!startsWith($startKey, "http")) {
		return null;
	}

	$startKey = str_replace("://", ":\\\\", $startKey);

	$parts = explode("/", $startKey);
	$parts = array_slice($parts, 0, count($parts) - 2);
	$startKey = implode("/", $parts);

	$startKey = str_replace(":\\\\", "://", $startKey);
	return $startKey;
}

function filterNutchConfig($nutchConfig, $useWhiteList = true) {
	if (is_string($nutchConfig)) {
		$nutchConfig = json_decode($nutchConfig);
	}

	if (!$useWhiteList || empty($nutchConfig)) {
		return $nutchConfig;
	}

	$whiteList = array(
		'/^crawl*/',
		'/^fetcher*/',
		'/^file*/',
		'/^generate*/',
		'/^http*/',
		'/^index*/',
		'/^nutch*/',
		'/^generate*/',
		'/^parser*/',
		'/^solr*/',
		'/^urlfilter*/',
		'/^urlnormalizer*/',
	);

	// TODO : add a black list
	$blackList = array();

	$result = array();
	foreach ($nutchConfig as $k => $v) {
		foreach ($whiteList as $pattern) {
			if (preg_match($pattern, $k)) {
				$result[$k] = $v;
			}
		}
	}

	return $result;
}
