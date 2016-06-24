<?php 

// TODO : remove this namespace
namespace Test;

function testKeyRangeFromRegex() {
	$regexes = [
			"^http://domain.com$",
			"^http://domain.com/$",
			"^http://domain.com/(.+)/{0,1}$",
			"^http://example.com/a/b/c/(\d+)/{0,1}$",
			"^http://example.com/q?a=b&c=(\d+)(.*)$"
	];

	foreach ($regexes as $regex) {
		pr($regex);

		$startKey = ltrim($regex, "^");
		$startKey = rtrim($startKey, "$");
		$u = parse_url($startKey);
		pr($u);

		pr(\Nutch\regex2startKey($regex));
		pr(\Nutch\regex2endKey($regex));
		echo "<hr />";
	}
}
