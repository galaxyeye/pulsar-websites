<?php 

// TODO : remove this namespace
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

function urlFilter2regex($urlFilter) {
	if (empty($urlFilter)) return null;

	$regex = ltrim($urlFilter, "+-");

	return $regex;
}

/**
 * Regex format : 
 * ^http://domain.com$
 * ^http://domain.com/$
 * ^http://domain.com/(.+)/{0,1}$
 * ^http://example.com/a/b/c/(\d+)/{0,1}$
 * ^http://example.com/q\?a=b&c=(\d+)(.*)$
 * */
function regex2startKey($regex) {
	if (empty($regex)) return null;

	$startKey = ltrim($regex, "^");
	$startKey = rtrim($startKey, "$");

	if (!startsWith($startKey, "http")) {
		return null;
	}

	$u = parse_url($startKey);

	// removed query argments
	if (!empty($u['path'])) {
	  $startKey = http_build_url($startKey, ['path' => $u['path']]);
	}
	// case : ^http://example.com/q\?a=b&c=(\d+)(.*)$ -> http://example.com/q\
	$startKey = rtrim($startKey, "\\");

	// convert "://" to ":\\\\" or anything else, we convert it back later
	$startKey = str_replace("://", ":\\\\", $startKey);

	$parts = explode("/", $startKey);
	// if more than 3 parts, it's "normal" regex
	$count = count($parts);
	if ($count >= 3) {
		// case : ^http://example.com/a/b/c/(\d+)/{0,1}$
		$parts = array_slice($parts, 0, count($parts) - 2);
		$startKey = implode("/", $parts);
	}
	else if ($count == 2) {
		// case : ^http://example.com/q?a=b&c=(\d+)(.*)$
		$startKey = implode("/", $parts);
	}
	else if ($count == 1) {
		// case : ^http://domain.com/$
		$startKey = $parts[0];
	}
	else {
		// case : ^http://domain.com$
		$startKey = $parts[0];
	}

	$startKey = str_replace(":\\\\", "://", $startKey);
	return $startKey;
}

/**
 * Regex format :
 * ^http://domain.com$
 * ^http://domain.com/$
 * ^http://domain.com/(.+)/{0,1}$
 * ^http://example.com/a/b/c/(\d+)/{0,1}$
 * ^http://example.com/q?a=b&c=(\d+)(.*)$
 * */
function regex2endKey($regex) {
	$startKey = regex2startKey($regex);
	if ($startKey == null) return null;

	$startKey = rtrim($startKey, "/");

	$startKey = str_replace("://", ":\\\\", $startKey);

	$parts = explode("/", $startKey);

	if (count($parts) > 1) {
		$endKey = $startKey . "\uFFFF";
	}
	else {
		$endKey = $startKey . "/" . "\uFFFF";
	}

	$endKey = str_replace(":\\\\", "://", $endKey);

	return $endKey;
}

function filterNutchConfig($nutchConfig, $useWhiteList = true) {
	if (is_string($nutchConfig)) {
		$nutchConfig = qi_json_decode($nutchConfig);
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
