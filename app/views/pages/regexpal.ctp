<?php $this->layout = 'empty'; ?>

<!DOCTYPE html>
<!--
	RegexPal 0.1.4f
	(c) 2007-2014 Steven Levithan <http://stevenlevithan.com>
	Dual-licensed under MPL 2 and LGPL 3
-->
<html>
<head>
	<meta charset="utf-8"/>
	<title>Regex Tester</title>
	<link href="/css/regexpal.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div id="header">
		<h1><a href="./"><span class="t1">Regex</span><span class="t2">Pal</span>
			<span id="version">0.1.4</span>
			<span id="subtitle">&mdash; a JavaScript regular expression tester</span></a>
		</h1>
		<ul id="nav">
			<li><a href="http://www.regexbuddy.com/cgi-bin/affref.pl?aff=SteveL" title="Upgrade to RegexBuddy by Just Great Software">RegexBuddy</a></li>
			<li><a href="https://play.google.com/store/apps/details?id=com.andkorsh.regexpal" title="Get the free RegexPal for Android by Andrew Korshunov">Android</a></li>
			<li><a href="http://www.amazon.com/dp/1449319432/?tag=slfb-20" title="Buy Regular Expressions Cookbook, by Jan Goyvaerts and Steven Levithan">Regex Book</a></li>
			<li><a href="http://blog.stevenlevithan.com/archives/regexpal">Blog</a></li>
		</ul>
	</div>

	<div id="options">
		<ul>
			<li class="hidden"><input id="flagG" type="checkbox" checked="checked"/><label for="flagG">Global</label> <span class="flag">(g)</span></li>
			<li><input id="flagI" type="checkbox"/><label for="flagI">Case insensitive</label> <span class="flag">(i)</span></li>
			<li><input id="flagM" type="checkbox"/><label for="flagM">^$ match at line breaks</label> <span class="flag">(m)</span></li>
			<li><input id="flagS" type="checkbox"/><label for="flagS">Dot matches all</label> <span class="flag">(s<span class="plain">; via <a href="http://xregexp.com/">XRegExp</a></span>)</span></li>
			<li class="optGroup" id="quickReferenceDropdown">Quick Reference</li>
			<li class="optGroup" id="optionsDropdown">Options
				<ul>
					<li><input id="highlightSyntax" type="checkbox" checked="checked"/><label for="highlightSyntax">Highlight regex syntax</label></li>
					<li><input id="highlightMatches" type="checkbox" checked="checked"/><label for="highlightMatches">Highlight matches</label></li>
					<li><input id="invertMatches" type="checkbox"/><label for="invertMatches" title="Highlight any text not matched by the regex">Invert results</label></li>
				</ul>
			</li>
		</ul>
	</div>

	<div id="quickReference" class="hidden">
		<h2>JavaScript Regex Quick Reference</h2>
		<img class="pin" src="/img/regexpal/pin.gif" alt="pin" title="pin"/>
		<img class="close" src="/img/regexpal/close.gif" alt="close" title="close"/>
		<table cellspacing="0" summary="Regular expressions reference">
			<tbody>
				<tr>
					<td><code>.</code></td>
					<td>Any character except newline.</td>
				</tr>
				<tr class="altBg">
					<td><code>\.</code></td>
					<td>A period (and so on for <code>\*</code>, <code>\(</code>, <code>\\</code>, etc.)</td>
				</tr>
				<tr>
					<td><code>^</code></td>
					<td>The start of the string.</td>
				</tr>
				<tr class="altBg">
					<td><code>$</code></td>
					<td>The end of the string.</td>
				</tr>
				<tr>
					<td><code>\d</code>,<code>\w</code>,<code>\s</code></td>
					<td>A digit, word character <code>[A-Za-z0-9_]</code>, or whitespace.</td>
				</tr>
				<tr class="altBg">
					<td><code>\D</code>,<code>\W</code>,<code>\S</code></td>
					<td>Anything except a digit, word character, or whitespace.</td>
				</tr>
				<tr>
					<td><code>[abc]</code></td>
					<td>Character a, b, or c.</td>
				</tr>
				<tr class="altBg">
					<td><code>[a-z]</code></td>
					<td>a through z.</td>
				</tr>
				<tr>
					<td><code>[^abc]</code></td>
					<td>Any character except a, b, or c.</td>
				</tr>
				<tr class="altBg">
					<td><code>aa|bb</code></td>
					<td>Either aa or bb.</td>
				</tr>
				<tr>
					<td><code>?</code></td>
					<td>Zero or one of the preceding element.</td>
				</tr>
				<tr class="altBg">
					<td><code>*</code></td>
					<td>Zero or more of the preceding element.</td>
				</tr>
				<tr>
					<td><code>+</code></td>
					<td>One or more of the preceding element.</td>
				</tr>
				<tr class="altBg">
					<td><code>{<em>n</em>}</code></td>
					<td>Exactly <em>n</em> of the preceding element.</td>
				</tr>
				<tr>
					<td><code>{<em>n</em>,}</code></td>
					<td><em>n</em> or more of the preceding element.</td>
				</tr>
				<tr class="altBg">
					<td><code>{<em>m</em>,<em>n</em>}</code></td>
					<td>Between <em>m</em> and <em>n</em> of the preceding element.</td>
				</tr>
				<tr>
					<td><code>??</code>,<code>*?</code>,<code>+?</code>,<br/><code>{<em>n</em>}?</code>, etc.</td>
					<td>Same as above, but as few as possible.</td>
				</tr>
				<tr class="altBg">
					<td><code>(</code><em>expr</em><code>)</code></td>
					<td>Capture <em>expr</em> for use with <code>\1</code>, etc.</td>
				</tr>
				<tr>
					<td><code>(?:</code><em>expr</em><code>)</code></td>
					<td>Non-capturing group.</td>
				</tr>
				<tr class="altBg">
					<td><code>(?=</code><em>expr</em><code>)</code></td>
					<td>Followed by <em>expr</em>.</td>
				</tr>
				<tr>
					<td><code>(?!</code><em>expr</em><code>)</code></td>
					<td>Not followed by <em>expr</em>.</td>
				</tr>
			</tbody>
		</table>
		<p><a href="https://developer.mozilla.org/en/Core_JavaScript_1.5_Reference/Global_Objects/RegExp#Special_characters_in_regular_expressions">Near-complete reference</a></p>
	</div>

	<div id="body">
		<div id="search" class="smartField">
			<textarea cols="100" rows="3" tabindex="1" spellcheck="false">Write your regex here. Its syntax will be highlighted automatically.</textarea>
		</div>
		<div id="input" class="smartField">
			<textarea cols="100" rows="10" tabindex="2" spellcheck="false">Write your test data here. Matches alternate between yellow and blue.</textarea>
		</div>
	</div>

	<div id="footer" class="small">
		<p><strong>Need more power?</strong> Get <a href="http://www.regexbuddy.com/cgi-bin/affref.pl?aff=SteveL" class="bold">RegexBuddy</a>, a powerful regex tester that inspired RegexPal.<br/>Round out your mastery over regex with <a href="http://www.regexmagic.com/cgi-bin/affref.pl?aff=SteveL" class="bold">RegexMagic</a> and <a href="http://www.powergrep.com/cgi-bin/affref.pl?aff=SteveL" class="bold">PowerGREP</a>.</p>
		<p id="copyright">
			<!--<a href="javascript:RegexPal.permalink();" id="permalink">Permalink</a> &mdash;-->
			&copy; 2014 <a href="http://blog.stevenlevithan.com/">Steven Levithan</a>.
			Powered by <a href="http://xregexp.com/">XRegExp</a> and <a href="http://stevenlevithan.com/regex/colorizer/">Regex Colorizer</a>.
		</p>
	</div>

	<script src="/js/regexpal/xregexp.js"></script>
	<script src="/js/regexpal/helpers.js"></script>
	<script src="/js/regexpal/regexpal.js"></script>

</body>
</html>
