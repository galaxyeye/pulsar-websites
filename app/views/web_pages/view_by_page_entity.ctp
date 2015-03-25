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

  <script type="text/x-jsrender" id="pageEntityFieldsTemplate">
  <dl>
    {{for}}
      <dt><a href='javascript:;' class='del red'>x</a><span class='k'>{{:name}}</span></dt>
      <dd>
        {{:css_path}}
      </dd>
    {{/for}}
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
			<button type='button' class='start-extract-rule'>开始制定挖掘规则</button>
    </div><!-- info-box -->

    <div class='webPages view css-path-collector hidden'>
      <form action="#" class='extract-field-name'>
          <div class="dropped dropper" title="字段名：将需要抽取的字段名拖拽到这里">
            <div class="dropper-dropzone">字段名：将需要抽取的字段名拖拽到这里</div>
            <input class="dropper-input" multiple="" type="text">
          </div>
      </form>
			<br />
      <form action="#" class='extract-field-value'>
          <div class="dropped dropper" title="字段值：将需要抽取的字段值拖拽到这里">
            <div class="dropper-dropzone">字段值：将需要抽取的字段值拖拽到这里</div>
            <input class="dropper-input" type="text">
          </div>
      </form>
			<br />
			<div class="text input required hidden">
				<label for="entityName">实体名称</label>
	      <input id="entityName" class="entity" value="<?php echo $pageEntity['PageEntity']['name']?>">
      </div>
			<br />
			<p class='dropper-message'></p>

			<div id="pageEntityFields" class="webPages view"></div>
			<br />
			<button type='button' class='save-extract-rule'>保存挖掘规则</button>
			<button type='button' class='clear-extract-rule'>清除挖掘规则</button>
    </div> <!-- css-path-collector -->

    <?php 
    	$pageEntityId = $pageEntity['PageEntity']['id'];
    	$encodedUrl = symmetric_encode($webPage['WebPage']['url']);
    ?>

    <div class="actions">
      <ul>
        <li><a href='javascript:;' class='active-draggable'>允许拖拽</a></li>
        <li><a href='javascript:;' class='deactive-draggable'>停止拖拽</a></li>
        <li><a href='javascript:;' class='hide-info-box'>隐藏信息框</a></li>
        <li><a href='javascript:;' class='show-info-box'>显示信息框</a></li>
      </ul>
      <ul>
        <li><?php echo $this->Html->link(__('查看（原始样式）', true), 
        		array('action' => 'view', $encodedUrl, 'page_entity_id' => $pageEntityId)); ?> </li>
        <li><?php echo $this->Html->link(__('查看（简洁样式）', true), 
        		array('action' => 'view', $encodedUrl, 'page_entity_id' => $pageEntityId, 
        				'options' => 'simpleCss')); ?> </li>
        <li><a class='intelligent' href="javascript:;">智能分析</a></li>
      </ul>
    </div><!-- actions -->
  </div><!-- systemPanel -->

  <div id='qiwurHtmlWrapper' class='scrapping wrap hidden'>
    <?php 
      echo $webPage['WebPage']['content'];
    ?>
  </div>
</body>
</html>

<script type="text/javascript">
<!--
	var globalPageData = {
	  "webroot" : "<?php echo $this->Html->webroot?>",
	  "controller" : "<?php echo $this->params['controller']?>",
	  "action" : "<?php echo $this->params['action']?>",
	  "here" : "<?php echo $this->here ?>"
	};

	var pageEntity = <?php echo json_encode($pageEntity) ?>;
//-->
</script>
<script type="text/javascript" src="/js/jquery/jquery-1.11.2.js"></script>
<script type="text/javascript" src="/js/jquery/jquery-ui-1.11.3/jquery-ui.js"></script>
<script type="text/javascript" src="/js/jquery/jsrender.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script type="text/javascript" src="/js/dump.js"></script>
<script type="text/javascript" src="/js/layer-v1.8.5/layer/layer.min.js"></script>
<script type="text/javascript" src="/js/web_pages/view_by_page_entity.js"></script>
