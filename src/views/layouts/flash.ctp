<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="<?php echo $html->webroot ?>favicon.ico" />
<?php
	echo $html->css('default');
?>

<?php if (Configure::read() <= 1) { ?>
<meta http-equiv="Refresh" content="<?php echo $pause; ?>;url=<?php echo $url; ?>"/>
<?php } ?>

<style><!--
P { text-align:center; font:bold 1.1em sans-serif }
A { color:#444; text-decoration:none }
A:HOVER { text-decoration: underline; color:#44E }
--></style>

</head>
<body id="<?php echo $this->params["controller"].'-'.$this->params["action"]?>">
<div class='control'>
	<span class='webapp-data'><?php if (isset($webappData)) {echo json_encode($webappData);}?></span>
</div>
<p><a href="<?php echo $url; ?>"><?php echo $message; ?></a></p>
</body>
</html>
