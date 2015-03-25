<div class="test form">
  <?php echo $this->Form->create('NutchJob', array('action' => '#')); ?>
  <fieldset>
    <legend><?php __('测试正则表达式'); ?></legend>
  <?php 
    echo $this->Form->input('regex', array('label' => '正则表达式', 'class' => 'test-urls', 'after' => '<p class="m hidden">正则表达式</p>'));
    echo $this->Form->input('test_urls', array('label' => '测试链接', 'type' => 'textarea', 'class' => 'test-urls', 'after' => '<p class="m hidden">每行一个待测链接</p>'));
    echo $this->Form->button('开始测试', array('type' => 'button', 'class' => 'start-test-regex'));
  ?>
  </fieldset>
  <?php echo $this->Form->end(); ?>
  <div class='test result'></div>
</div>

<div class="nutch_jobs form auto-validate">
<?php echo $this->Form->create('NutchJob', array('action' => 'urlFilterChecker'));?>
	<fieldset>
 		<legend><?php __('链接过滤器测试(Not implemented yet!)'); ?></legend>
 		<div>提交到爬虫服务器进行测试</div>
	<?php 
	  $m = array(
	  		'url' => "<p class='m hidden'>待测试链接，每行一个。</p>",
	  		'urlFilter' => "<p class='m hidden'>链接过滤规则，每行一个正则表达式。
	  		  <br />前缀+表示符合该模式的需要被抓取，
	  			<br />前缀-表示符合该模式的需要被排除。
	  		</p>"
	  );
	  echo $this->Form->hidden('jobId', array('value' => $jobId));
	  echo $this->Form->input('urlFilter', array('type' => 'textarea', 'div' => 'long input text required', 'after' => $m['urlFilter']));
		echo $this->Form->input('url', array('type' => 'textarea', 'div' => 'long input text required', 'after' => $m['url']));
	?>
	</fieldset>

<?php echo $this->Form->end(__('提交', true)); ?>
</div>

<div class="actions">
  <ul>
    <li><?=$this->Html->link(__('List Nutch Jobs', true), array('action' => 'index')); ?> </li>
    <li><?=$this->Html->link(__('List Active Jobs', true), array('action' => 'activeJobs')); ?> </li>
    <li><?=$this->Html->link(__('List Active Jobs（Plain View）', true), array('action' => 'plainActiveJobs')); ?> </li>
  </ul>
</div>
