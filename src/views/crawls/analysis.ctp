<?php echo $this->element('crawls/subnav') ?>

<?php $this->viewVars['css_for_layout'] = $html->css('flowstep.css'); ?>

<script type="text/javascript">
<!--
  var stepNo = <?php echo $stepNo?>;
//-->
</script>

<?php 
  $steps = array(
      array('name' => '输入种子链接', 'status' => 'step-cur', 'time' => '', 'pos' => 'step-first'),
      array('name' => '选择链接模式', 'status' => '', 'time' => '', 'pos' => ''),
      array('name' => '启动爬虫', 'status' => '', 'time' => '', 'pos' => ''),
      array('name' => '启动挖掘引擎', 'status' => '', 'time' => '', 'pos' => ''),
      array('name' => '查看结果', 'status' => '', 'time' => '', 'pos' => 'step-last')
  );
?>
<div class="flowstep">
  <ul class="flowstep-5">
    <?php 
      $i = 0;
      foreach ($steps as $s) : 
      ++$i;
    ?>
    <li class="<?php echo $s['pos'] ?>">
      <div class="<?php echo ($i < $stepNo) ? 'step-done' : ($i == $stepNo ? 'step-cur' : '') ?>">
        <div class="step-name"><?php echo $s['name'] ?></div>
        <div class="step-no"><?php echo ($i > $stepNo) ? $i : '' ?></div>
        <div class="step-time">
          <div class="step-time-wraper"><?php echo $s['time'] ?></div>
        </div>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
</div>

<?php 
if ($stepNo == 1) {
  $vars = compact('stepNo');
  echo $this->element('crawls/analysis/step1', $vars);
}
else if ($stepNo == 2) {
	$vars = compact('stepNo', 'seed', 'outlinks');
	echo $this->element('crawls/analysis/step2', $vars);
}
else if ($stepNo == 3) {
  $vars = compact('stepNo', 'crawl');
	echo $this->element('crawls/analysis/step3', $vars);
}
else if ($stepNo == 4) {
  $vars = compact('stepNo', 'crawl');
	echo $this->element('crawls/analysis/step4', $vars);
}
else if ($stepNo == 5) {
  $vars = compact('stepNo', 'pageEntity');
	echo $this->element('crawls/analysis/step5', $vars);
}
