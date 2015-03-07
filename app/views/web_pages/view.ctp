<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Nutch UI</title>
	<style type="text/css">
		.xubox_page { width:100%; }
		.xubox_title em { font-size: large; }
		#systemPanel { 
			padding: 20px 20px 12px; background: url("/img/stripe2.png") repeat scroll 0px 0px #F8E088;
			font-size: large;
		}	
		#systemPanel div.view, #systemPanel div.form, #systemPanel div.related {
    	background: none repeat scroll 0px 0px #E5F0FF;
    	border-bottom: 1px solid #B7D58B;
    	border-right: 1px solid #B7D58B;
    	padding: 20px 18px;
    	margin-bottom: 15px;
		}
		#systemPanel dl { line-height: 2em; margin: 0em 0em; width: 100%; }
		#systemPanel dl.altrow { background: #f4f4f4; }
		#systemPanel dt { font-weight: bold; padding-left: 4px; vertical-align: top; }
		#systemPanel dd { margin-left: 8em; margin-top: -2em; vertical-align: top; }
		#systemPanel div.actions ul { margin: 0px 0; padding: 0; }
		#systemPanel div.actions li { display: inline; list-style-type: none; line-height: 2em; margin: 0 2em 0 0; white-space: nowrap; }
		#systemPanel div.actions ul li a { text-decoration: none; }
		#systemPanel div.actions ul li a:hover { text-decoration: underline; }
		#systemPanel div.actions { background: none repeat scroll 0 0 #E5F0FF; padding: 0 18px; -moz-border-radius: 20px 20px 20px 20px; margin-bottom:10px; }
		<?php if (in_array('simpleCss', $options)) : ?>
		#htmlWrapper ul,
		#htmlWrapper dl,
		#htmlWrapper h1,
		#htmlWrapper h2,
		#htmlWrapper h3,
		#htmlWrapper h4,
		#htmlWrapper h5,
		#htmlWrapper h6 { border : 1px ridge; }
		#htmlWrapper div, p { border-bottom : 1px dashed; border-left : 1px dashed; }
		<?php endif; ?>
	</style>
</head>

<body id="webPagesView">
	<div id="systemPanel">
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

		<?php $encodedUrl = simple_encode($webPage['WebPage']['url']); ?>

		<div class="actions">
			<h3><?php __('Actions'); ?></h3>
			<ul>
				<li><?php echo $this->Html->link(__('View', true), array('action' => 'view', $encodedUrl)); ?> </li>
				<li><?php echo $this->Html->link(__('View (With Simple Css)', true), array('action' => 'view', $encodedUrl, 'options' => 'simpleCss')); ?> </li>

				<li><a class='Intelligent' href="">Intelligent Analysis</a></li>
				<li><a class='disableLinks'>Disable Links</a></li>
			</ul>
		</div>
	</div>

		<div id='htmlWrapper' class='.scrapping .frame .wrap'>
		<?php 
			echo $webPage['WebPage']['content'];
		?>
		</div>
</body>
</html>

<script type="text/javascript" src="/js/jquery/jquery-1.11.2.js"></script><script type="text/javascript" src="/js/jquery/jquery-ui-1.11.3/jquery-ui.js"></script><script type="text/javascript" src="/js/jquery/jsrender.js"></script><script type="text/javascript" src="/js/common.js"></script><script type="text/javascript" src="/js/layer-v1.8.5/layer/layer.min.js"></script></script>
<script type="text/javascript">
$(document).ready(function() {
  $.layer({
    type : 1,
    // title : '弹性分布式网页集概要',
    title : "操作界面",
    border : false,
    shade : [0],
    move : ".xubox_title",
    moveType : 1,
    area: ['751px', 'auto'],
    shift: 'left', //从左动画弹出
    page : {dom : '#systemPanel'},
    // zIndex : 19891010,
    success: function(layero) {
      // layero.find('.m').show();
      // layero.find('.actions').hide();
      // alert(dump(layero));
      // registerCommonEventHander();
    }
  });
});
</script>
