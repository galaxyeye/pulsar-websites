<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Nutch UI</title>
	<style type="text/css">
		#htmlWrapper { position:fixed; top:150px; left:150px; margin:auto; }
		#rawPageSeperator { bolder:1px; }
	</style>
</head>

<body id="webPagesView">
		<div class="webPages view">
		<h2><?php  __('Web Page');?></h2>
			<dl><?php $i = 0; $class = ' class="altrow"';?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $webPage['WebPage']['url']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $webPage['WebPage']['title']; ?>
					&nbsp;
				</dd>
			</dl>
		</div>

		<div class="actions">
			<h3><?php __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('Search Web', true), array('action' => 'search')); ?></li>
			</ul>
		</div>

		<hr id='rawPageSeperator' />

		<div id='htmlWrapper' class='.scrapping .frame .wrap'>
		<?php 
			echo $webPage['WebPage']['content'];
		?>
		</div>
</body>
</html>
