<?php 

namespace Nutch;

function splitUrlFilter($urlFilter) {
	$urlFilter = str_ireplace("+http", "http", $urlFilter);
	$urlFilter = str_ireplace("-http", "http", $urlFilter);
	$urlFilter = str_ireplace("\r\n", "\n", $urlFilter);
	$urlFilter = trim($urlFilter);

	return explode("\n", $urlFilter);
}

function normalizeUrlFilter($urlFilter) {
	if (empty($urlFilter)) {
		return null;
	}

	$urlFilter = str_ireplace("\r\n", "\n", $urlFilter);
	$urlFilter = trim($urlFilter);
	$normalized = "";
	foreach(explode("\n", $urlFilter) as $f) {
		$f = trim($f);

		if (empty($f)) {
			continue;
		}

		$ch = substr($f, 0, 1);
		if ($ch != '+' && $ch != '-') {
			$normalized .= "+";
		}

		$normalized .= $f;
		$normalized .= "\n";
	}

	return trim($normalized, "\n");
}

function normalizeUrlFilterRegex($regex) {
	if ($regex[0] != '^') $regex = '^'.$regex;
	if ($regex[strlen($regex) - 1] != '$') $regex = $regex.'$';
	return $regex;
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
