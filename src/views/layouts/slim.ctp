<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>齐物数据引擎 - 格物，齐物，用物</title>
    <?php echo $this->element('css', array('css' => array('foundation.min', 'wufoo', 'qiwu-ui2'))); ?>
    <?php echo $this->element('css', array('css' => array('jquery/jquery-ui-1.11.3/jquery-ui'))); ?>

    <script type="text/javascript">
        var globalPageData = {
            "webroot": "<?=$this->Html->webroot?>",
            // "prefix": "<?=$this->params['prefix']?>",
            "controller": "<?=$this->params['controller']?>",
            "action": "<?=$this->params['action']?>",
            "here": "<?=$this->here ?>"
        };
    </script>
</head>

<body
    id="<?php echo Inflector::variable($this->params['controller']) . Inflector::classify($this->params['action']) ?>">
<div id="container">

    <div id="nav">
        <h1 class="logo">
            <a href="<?php echo Router::url('/q') ?>" title="Search">Search</a>
        </h1>
        <div class="user"><?php echo $currentUser['name'] ?></div>
        <ul id="menu" class="clearfix">
            <li class="item2">
                <a href="<?php echo Router::url('/q') ?>">新闻和小说</a>
            </li>
            <li class="item2">
                <a href="<?php echo Router::url('/ec') ?>">电商</a>
            </li>
        </ul>
    </div><!-- nav -->

    <div id="stage">
        <?php echo $this->Session->flash(); ?>
        <?php echo $content_for_layout; ?>
    </div><!--stage-->

</div><!--container-->

<img id="bottom" src="/img/bottom.png" alt=""/>
<div id="footer">
    <h1 class="logo"><a href="<?php echo Router::url('/') ?>">翘曲速率</a></h1>
    <p> &middot; <strong>翘曲速率</strong> &middot; 北京翘曲速率信息科技有限公司 &middot;</p>
</div><!--footer-->

<!-- JavaScript -->
<?php
if (isset($js)) echo $this->element('js', array('scripts_for_layout' => $scripts_for_layout));
?>

</body>
</html>
