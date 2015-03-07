<?php 

function normalizeUrlFilter($urlFilter) {
	if (empty($urlFilter)) {
		return null;
	}

	$urlFilter = str_ireplace("\r\n", "\n", $urlFilter);
	$normalized = "";
	foreach(explode("\n", $urlFilter) as $f) {
		$ch = substr($f, 0, 1);
		if ($ch != '+' && $ch != '-') {
			$normalized .= "+";
		}

		$normalized .= $f;
		$normalized .= "\n";
	}

	return $normalized;
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
