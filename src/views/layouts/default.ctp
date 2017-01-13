<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>媒体大数据分析系统</title>
    <?php echo $this->element('css', array('css' => array('foundation.min', 'wufoo', 'info-monitor'))); ?>
    <?php echo $this->element('css', array('css' => array('jquery/jquery-ui-1.11.4'))); ?>

    <style type="text/css">
		.debug.message, .debug.field {
		display: <?=(Configure::read('debug')> 0)? 'block': 'none'?>;
	}
</style>

<script type="text/javascript">
        var globalPageData = {
            "webroot": "<?=$this->Html->webroot?>",
            "prefix": "<?=isset($this->params['prefix']) ? $this->params['prefix'] : null ?>",
            "controller": "<?=$this->params['controller']?>",
            "action": "<?=$this->params['action']?>",
            "here": "<?=$this->here ?>"
        };
    </script>
</head>

<body
	id="<?php echo Inflector::variable($this->params['controller']) . Inflector::classify($this->params['action']) ?>">
	<div id="container">
		<nav id="nav">
		<h1 class="logo">
			<a href="<?=Router::url('/') ?>" title="媒体大数据">媒体大数据</a>
		</h1>
		<div class="user"><?=$currentUser['name'] ?></div>
		<ul id="menu" class="clearfix">
			<li class="item main"><a href="<?=Router::url('/') ?>">首页</a></li>
			<li class="item2 topics"><a
				href="<?=Router::url(['controller' => 'topics', 'action' => 'monitor']) ?>">主题</a>
			</li>
			<li class="item2 manage"><a
				href="<?=Router::url(['controller' => 'topics', 'action' => 'index']) ?>">管理</a>
			</li>
			<li class="item2"><a
				href="<?=Router::url(['controller' => 'users']) ?>">用户</a>
			</li>
			<li class="item2 logs"><a
				href="<?=Router::url(['controller' => 'logs']) ?>">日志</a>
			</li>
			<li class="item2 settings"><a
				href="<?=Router::url(['controller' => 'settings']) ?>">设置</a>
			</li>
			<li class="item2 search"><input class="form-control" type="text"
				value="站内搜索"></li>
			<li class="lgo"><a
				href="<?php echo Router::url(['controller' => 'users', 'action' => 'logout']) ?>">退出</a>
			</li>
		</ul>
		</nav>
		<!-- nav -->

    <?= $this->Session->flash(); ?>
    <div id="stage" class="container clearfix">
        <?=$content_for_layout ?>
    </div>
	</div>
	<img id="bottom" src="/img/bottom.png" alt="" />
	<div id="footer">
		<h1 class="logo">
			<a href="<?php echo Router::url('/') ?>">媒体大数据</a>
		</h1>
		<p>
			&middot; <strong>媒体大数据</strong> &middot; 曲速媒体大数据实验室 &middot; &middot;
		</p>
	</div>
	<!--footer-->

	<!-- JavaScript -->
<?php
if (isset ( $js ))
	echo $this->element ( 'js', array (
			'scripts_for_layout' => $scripts_for_layout 
	) );
?>

</body>
</html>
