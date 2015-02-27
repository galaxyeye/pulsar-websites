<?php $this->layout = 'empty' ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
	echo $html->meta('keywords', $article['Article']['meta_keywords']);
	echo $html->meta('description', $article['Article']['meta_description']);
?>
<title><?php echo $article['Article']['meta_title'] ?></title>
<link rel="shortcut icon" href="<?php echo $html->webroot ?>favicon.ico" />
<?php echo $this->element('css', array('css' => array('default'))); ?>
</head>

<body id="nv_<?php echo $this->params["controller"]?>" class='sinorelo'>

<?php echo $this->element('common_header', array('controller' => $this->params["controller"])) ?>

<div class='wp960'>
  <div class='article z'>
    <div class='cl'>
      <div class="menu z">
        <?php echo $this->element('article_menu') ?>
      </div>

      <div class="content y">
        <p><?php echo $article['Article']['content']; ?></p>
      </div> <!-- end frame-2-1-r -->
    </div>
  </div>
</div> <!-- panel -->

<?php echo $this->element('common_footer'); ?>

</body>
</html>
