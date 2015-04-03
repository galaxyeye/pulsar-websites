<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Nutch UI</title>
  <link rel="stylesheet" type="text/css" href="/css/jquery/jquery-ui-1.11.3/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="/css/jquery/jquery.dropper.css" />
  <link rel="stylesheet" type="text/css" href="/css/web_pages/web_pages.css" />
  <style type="text/css">
    <?php if (in_array('simpleCss', $options)) : ?>
    #qiwurHtmlWrapper ul,
    #qiwurHtmlWrapper dl,
    #qiwurHtmlWrapper table,
    #qiwurHtmlWrapper h1,
    #qiwurHtmlWrapper h2,
    #qiwurHtmlWrapper h3,
    #qiwurHtmlWrapper h4,
    #qiwurHtmlWrapper h5,
    #qiwurHtmlWrapper h6 { border : 1px ridge; }
    #qiwurHtmlWrapper div, p { border-bottom : 1px dashed; border-left : 1px dashed; }
    #qiwurHtmlWrapper .ui-draggable-dragging { border : 1px dotted; }
    <?php else : ?>
    #qiwurHtmlWrapper ul,
    #qiwurHtmlWrapper dl,
    #qiwurHtmlWrapper table,
    #qiwurHtmlWrapper h1,
    #qiwurHtmlWrapper h2,
    #qiwurHtmlWrapper h3,
    #qiwurHtmlWrapper h4,
    #qiwurHtmlWrapper h5,
    #qiwurHtmlWrapper h6 { border : 1px ridge !important; }
    <?php endif; ?>
  </style>
  <script type="text/x-jsrender" id="extractionRulesTemplate">
  <dl>
    {{props}}
    <dt><a href='javascript:;' class='del'>x</a><span class='k'>{{>key}}</span></dt>
    <dd>
      {{>prop}}      &nbsp;
    </dd>
    {{/props}}
  </dl>
  </script>

</head>

<body id="webPagesView">
  <div id="systemPanel">
    <div class="webPages view info-box">
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
    </div><!-- info-box -->

    <?php $encodedUrl = symmetric_encode($webPage['WebPage']['url']); ?>

    <div class="actions">
      <ul>
        <li><?php echo $this->Html->link(__('查看（原始样式）', true), array('action' => 'view', $encodedUrl)); ?> </li>
        <li><?php echo $this->Html->link(__('查看（简洁样式）', true), array('action' => 'view', $encodedUrl, 'options' => 'simpleCss')); ?> </li>
      </ul>
    </div><!-- actions -->
  </div><!-- systemPanel -->

  <div id='qiwurHtmlWrapper' class='scrapping wrap'>
    <?php 
      echo $webPage['WebPage']['content'];
    ?>
  </div>

	<script type="text/javascript">
	<!--
		var globalPageData = {
		  "webroot" : "<?php echo $this->Html->webroot?>",
		  "controller" : "<?php echo $this->params['controller']?>",
		  "action" : "<?php echo $this->params['action']?>",
		  "here" : "<?php echo $this->here ?>"
		};
	//-->
	</script>
	<script type="text/javascript" src="/js/jquery/jquery-1.11.2.js"></script>
	<script type="text/javascript" src="/js/jquery/jquery-ui-1.11.3/jquery-ui.js"></script>
	<script type="text/javascript" src="/js/jquery/jsrender.js"></script>
  <script type="text/javascript" src="/js/jquery/selectorator.min.js"></script>
	<script type="text/javascript" src="/js/common.js"></script>
	<script type="text/javascript" src="/js/dump.js"></script>
	<script type="text/javascript" src="/js/layer-v1.8.5/layer/layer.min.js"></script>
	<script type="text/javascript" src="/js/web_pages/view.js"></script>

</body>
</html>
