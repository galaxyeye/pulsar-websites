<script type="text/javascript">
try {
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-8525143-2']);
	_gaq.push(['_setDomainName', '.logoloto.com']);
	_gaq.push(['_addOrganic', 'baidu', 'wd']);
	_gaq.push(['_addOrganic', 'soso', 'w']);
	_gaq.push(['_addOrganic', 'yodao', 'q']);
	_gaq.push(['_addOrganic', 'bing', 'q']);
	_gaq.push(['_addOrganic', 'sogou', 'query']);
	_gaq.push(['_addOrganic', 'gougou', 'search']);
	_gaq.push(['_addIgnoredOrganic', '乐够乐透']);
	_gaq.push(['_addIgnoredOrganic', 'logoloto']);
	_gaq.push(['_addIgnoredOrganic', '乐够乐透网']);
	_gaq.push(['_addIgnoredOrganic', 'www.logoloto.com']);
	_gaq.push(['_trackPageview', '<?php if (isset($gaPageTrack)) {echo $gaPageTrack;}?>']);

<?php if (isset($gaUserVar)) { ?>
	_gaq.push(['_setVar', '<?php echo $gaUserVar;?>']);
<?php } ?>

<?php if (isset($user) && ($user['id'] != 0)) { ?>
	_gaq.push(['_setCustomVar', '1', 'from', '<?php echo $user['referrer'];?>', 1]);
	_gaq.push(['_setCustomVar', '5', 'user', '<?php echo $user['id'];?>', 1]);
<?php if (isset($user['gender'])) { ?>
	_gaq.push(['_setCustomVar', '2', 'gender', '<?php echo $user['gender'];?>', 1]);
	_gaq.push(['_setCustomVar', '3', 'birth', '<?php echo $user['birth'];?>', 1]);
	_gaq.push(['_setCustomVar', '4', 'salary', '<?php echo $user['salary'];?>', 1]);
<?php }} ?>

	(function() {
		var ga = document.createElement('script');
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		ga.setAttribute('async', 'true');
		document.documentElement.firstChild.appendChild(ga);
	})();
} catch(err) {}
</script>
