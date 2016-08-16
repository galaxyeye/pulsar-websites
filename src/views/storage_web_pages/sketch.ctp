<?php $this->layout = 'empty'; ?>

<!doctype html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <title>scent block shapes</title>

  <link rel="stylesheet" type="text/css" href="/css/jquery/jquery-ui-1.11.3/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="/css/dropper.css" />
  <link rel="stylesheet" type="text/css" href="/css/storage_web_pages/sketch.css" />

  <script type="application/javascript">
    var alignedRectangles=<?=($storageWebPage['StorageWebPage']['alignedRectangles']); ?>;
    var resizedShapes=<?=($storageWebPage['StorageWebPage']['resizedShapes']); ?>;
  </script>
</head>

<body class="shapes">
<div class="control">
  <button type='button' class='hide-aligned-shapes'><?=__("Hide Aligned Shapes")?></button>
  <button type='button' class='show-aligned-shapes'><?=__("Show Aligned Shapes")?></button>
  <button type='button' class='hide-non-aligned-shapes'><?=__("Hide Non-aligned Shapes")?></button>
  <button type='button' class='show-non-aligned-shapes'><?=__("Show Non-aligned Shapes")?></button>
  <button type='button' class='show-shape-information'><?=__("Show Shape Information")?></button>
  <button type='button' class='hide-shape-information'><?=__("Hide Shape Information")?></button>
  <button type='button' class='show-all-shape-information'><?=__("Show All Shape Information")?></button>
  <button type='button' class='disable-revert-position'><?=__("Disable Revert Position")?></button>
  <button type='button' class='get-shape-selectors'><?=__("Get Shape Selectors")?></button>
</div>
<div id="systemPanel" class="hidden">
  <div class="message"></div>
</div>
<div class="canvas">
  <?=$storageWebPage['StorageWebPage']['content'] ?>
</div>
<script type="text/javascript" src="/js/jquery/jquery-1.11.2.js"></script>
<script type="text/javascript" src="/js/jquery/jquery-ui-1.11.3/jquery-ui.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script type="text/javascript" src="/js/dump.js"></script>
<script type="text/javascript" src="/js/layer-v1.8.5/layer/layer.min.js"></script>
<script type="text/javascript" src="/js/storage_web_pages/sketch.js"></script>
</body>
</html>
