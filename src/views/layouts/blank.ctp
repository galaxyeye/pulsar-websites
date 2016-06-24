<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
	if(isset($meta_keywords)) echo $html->meta('keywords', $meta_keywords);
	if(isset($meta_description)) echo $html->meta('description', $meta_description);
?>
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="<?php echo $html->webroot ?>favicon.ico" />
<style type="text/css">
	* { margin:0;padding:0 }
</style>

<?php
	// css
	if (isset($css_for_layout)){
		echo $css_for_layout;
	}
?>

</head>

<body id="<?php echo $this->params["controller"].'-'.$this->params["action"]?>">
<div class='control'>
	<span class='webapp-data'><?php if (isset($webappData)) {echo json_encode($webappData);}?></span>
</div>
<?php echo $content_for_layout; ?>
<?php 
	echo $this->element('sql_dump');
	if(isset($js)) echo $this->element('js', array('scripts_for_layout' => $scripts_for_layout));
?>
</body>
</html>
