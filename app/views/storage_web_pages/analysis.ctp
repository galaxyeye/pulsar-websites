<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>齐物数据引擎 - 格物，齐物，用物</title>
  <link rel="stylesheet" type="text/css" href="/css/web_pages/web_pages.css" />
  <style type="text/css">
		table.table {
		  border: 1px solid #A0BF7C;
		  border-collapse: collapse;
		  empty-cells: show;
		}

		table.table tr td, table.table tr th {
		  border-bottom: 1px dotted #A0BF7C;
		  border-right: 1px dotted #A0BF7C;
		}
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

<body id="storageWebPagesView">
  <div id="systemPanel">
    <div class="storageWebPages view info-box">
      <h2><?php  __('Page Information');?></h2>
      <dl><?php $i = 0; $class = ' class="altrow"';?>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
          <?php echo $storageWebPage['StorageWebPage']['url']; ?>
          &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class;?>>
          <?php echo $storageWebPage['StorageWebPage']['title']; ?>
          &nbsp;
        </dd>
      </dl>
    </div><!-- info-box -->

    <div class='storageWebPages view css-path-collector'>
      <h3>Auto Generated Extract Rules</h3>
      <div class="rules">
        <div id="pageEntityFields"></div>
      </div>
      <br />
      <button type='button' class='save-extract-rule'><?=__("Save")?></button>
      <button type='button' class='start-ruled-extract'><?=__("Save & Go")?></button>
      <button type='button' class='manual-add-rules'><?=__("Manual Analysis")?></button>
    </div> <!-- css-path-collector -->
  </div><!-- systemPanel -->

  <div id='qiwurHtmlWrapper' class='scrapping wrap'>
    <?php echo $storageWebPage['StorageWebPage']['content']; ?>
  </div>

  <?php 
    $pageEntityId = $pageEntity['PageEntity']['id'];
    $encodedUrl = symmetric_encode($storageWebPage['StorageWebPage']['url']);
  ?>

  <script type="text/javascript">
  <!--
    var globalPageData = {
      "webroot" : "<?php echo $this->Html->webroot?>",
      "controller" : "<?php echo $this->params['controller']?>",
      "action" : "<?php echo $this->params['action']?>",
      "here" : "<?php echo $this->here ?>"
    };

    var encodedUrl = "<?=$encodedUrl ?>";
    var webPage = <?=json_encode($storageWebPage) ?>;
    var pageEntity = <?=json_encode($pageEntity) ?>;
  //-->
  </script>
  <script type="text/javascript" src="/js/jquery/jquery-1.11.2.js"></script>
  <script type="text/javascript" src="/js/jquery/jquery-ui-1.11.3/jquery-ui.js"></script>
  <script type="text/javascript" src="/js/jquery/jsrender.js"></script>
  <script type="text/javascript" src="/js/common.js"></script>
  <script type="text/javascript" src="/js/dump.js"></script>
  <script type="text/javascript" src="/js/layer-v1.8.5/layer/layer.min.js"></script>
  <script type="text/javascript" src="/js/storage_web_pages/analysis.js"></script>

</body>
</html>
