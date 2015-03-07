<div class="nutch_jobs form auto-validate">
<?php echo $this->Form->create('NutchJob', array('action' => 'urlFilterChecker'));?>
	<fieldset>
 		<legend><?php __('链接过滤器测试(Not implemented yet!)'); ?></legend>
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
<?php echo $this->Form->end(__('Submit', true)); ?>
</div>

<div class="nutch_jobs view">
	<h2><?php __('解析结果');?></h2>

	<div>
		<h3><?php __('通过测试的链接');?></h3>
		<div id="urlsPassedTest"></div>
	</div>
	<hr />
	<div>
		<h3><?php __('未通过测试的链接');?></h3>
		<div id="urlsNotPassTest"></div>
	</div>
</div>
