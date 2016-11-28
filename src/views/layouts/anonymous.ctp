<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>齐物数据引擎 - 格物，齐物，用物</title>
  <?php echo $this->element('css', array('css' => array('foundation.min', 'wufoo', 'qiwu-ui2'))); ?>
  <?php echo $this->element('css', array('css' => array('jquery/jquery-ui-1.11.3/jquery-ui'))); ?>

  <style type="text/css">
    .debug.message, .debug.field {
      display: <?=(Configure::read('debug') > 0) ? 'block' : 'none' ?>;
    }
  </style>

  <script type="text/javascript">
    var globalPageData = {
      "webroot" : "<?php echo $this->Html->webroot?>",
      "controller" : "<?php echo $this->params['controller']?>",
      "action" : "<?php echo $this->params['action']?>",
      "here" : "<?php echo $this->here ?>"
    };
  </script>
</head>

<body id="<?php echo Inflector::variable($this->params['controller']).Inflector::classify($this->params['action']) ?>">
  <div id="container">

  <div id="nav">
    <h1 class="logo">
      <a href="<?php echo Router::url('/anonymous/storage_page_entities') ?>" title="Qiwu Data Engine">Qiwu Data Engine</a>
    </h1>
    <div class="user"><?php echo $currentUser['name'] ?></div>
    <ul id="menu" class="clearfix">
      <li class="item">
        <a href="<?php echo Router::url('/anonymous/storage_web_pages') ?>">Downloaded Pages</a>
      </li>
      <li class="item">
        <a href="<?php echo Router::url('/anonymous/storage_page_entities') ?>">Extracted Pages</a>
      </li>
      <li class="lgo">
        <a href="<?php echo Router::url('/users/login') ?>">Login</a>
      </li>
    </ul>
  </div><!-- nav -->

  <div id="stage">
    <?php echo $this->Session->flash(); ?>
    <?php echo $content_for_layout; ?>
  </div><!--stage-->

  </div><!--container-->

  <img id="bottom" src="/img/bottom.png" alt="" />
  <div id="footer">
    <h1 class="logo"><a href="<?php echo Router::url('/') ?>">翘曲速率</a></h1>
    <p> &middot; <strong>翘曲速率</strong> &middot; 北京翘曲速率信息科技有限公司 &middot;</p>
  </div><!--footer-->

</body>
</html>
