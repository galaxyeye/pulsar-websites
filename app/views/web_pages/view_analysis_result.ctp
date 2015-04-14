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

		#systemPanel #pageEntityFields {
      max-height: 500px !important;
      overflow-y: scroll;
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

    <div class='webPages view css-path-collector'>
      <div class="rules">
        <div id="pageEntityFields"></div>
      </div>
      <br />
      <button type='button' class='save-extract-rule'>保存挖掘规则</button>
      <button type='button' class='clear-extract-rule'>清除挖掘规则</button>
      <button type='button' class='start-ruled-extract'>保存并挖掘</button>
    </div> <!-- css-path-collector -->

    <?php 
      $pageEntityId = $pageEntity['PageEntity']['id'];
      $encodedUrl = symmetric_encode($webPage['WebPage']['url']);
    ?>

    <div class="actions">
      <ul>
        <li><?php echo $this->Html->link(__('智能分析', true),
            ['action' => 'viewAnalysisResult', $encodedUrl, 'page_entity_id' => $pageEntityId], ['target' => '_blank']); ?> </li>
        <li><?php echo $this->Html->link(__('原始样式', true),
            ['action' => 'view', $encodedUrl, 'page_entity_id' => $pageEntityId], ['target' => '_blank']); ?> </li>
        <li><?php echo $this->Html->link(__('简洁样式', true),
            ['action' => 'view', $encodedUrl, 'page_entity_id' => $pageEntityId, 'options' => 'simpleCss'], ['target' => '_blank']); ?> </li>
      </ul>
    </div><!-- actions -->
  </div><!-- systemPanel -->

  <div id='qiwurHtmlWrapper' class='scrapping wrap'>
    <?php echo $webPage['WebPage']['content']; ?>
  </div>

  <script type="text/javascript">
  <!--
    var globalPageData = {
      "webroot" : "<?php echo $this->Html->webroot?>",
      "controller" : "<?php echo $this->params['controller']?>",
      "action" : "<?php echo $this->params['action']?>",
      "here" : "<?php echo $this->here ?>"
    };

    var webPage = <?php echo json_encode($webPage) ?>;
    var pageEntity = <?php echo json_encode($pageEntity) ?>;
  //-->
  </script>
  <script type="text/javascript" src="/js/jquery/jquery-1.11.2.js"></script>
  <script type="text/javascript" src="/js/jquery/jsrender.js"></script>
  <script type="text/javascript" src="/js/common.js"></script>
  <script type="text/javascript" src="/js/dump.js"></script>
  <script type="text/javascript" src="/js/layer-v1.8.5/layer/layer.min.js"></script>
  <script type="text/javascript" src="/js/web_pages/viewAnalysisResult.js"></script>

</body>
</html>
