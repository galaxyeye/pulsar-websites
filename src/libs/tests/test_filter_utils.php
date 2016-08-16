<?php 

namespace Test;

App::import("Lib", ['filter_utils']);

function testKeyRangeFromRegex() {
	$regexes = [
		"^http://domain.com$",
		"^http://domain.com/$",
		"^http://domain.com/(.+)/{0,1}$",
		"^http://example.com/a/b/c/(\d+)/{0,1}$",
		"http://www.hahaertong.com/listshop-shanghai/(.+)",
		"http://www.hahaertong.com/shop/(\d+)"
	];

	foreach ($regexes as $regex) {
		pr($regex);
		pr(">" . normalizeUrlFilterRegex($regex));
		pr(">" . normalizeUrlFilter($regex));

		$startKey = ltrim($regex, "^");
		$startKey = rtrim($startKey, "$");
		$u = parse_url($startKey);
		pr($u);

		pr(regex2startKey($regex));
		pr(regex2endKey($regex));
		echo "<hr />";
	}

	$this->autoRender = false;
}
