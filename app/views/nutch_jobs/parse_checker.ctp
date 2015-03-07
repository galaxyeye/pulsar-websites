<div class="nutch_jobs form auto-validate">
<?php echo $this->Form->create('NutchJob', array('action' => 'parseChecker'));?>
	<fieldset>
 		<legend><?php __('Parse Checker'); ?></legend>
	<?php 
	  $m = array('url' => "<p class='m hidden'>目标链接</p>");
	  echo $this->Form->hidden('jobId');
	  echo $this->Form->hidden('crawl_id');
		echo $this->Form->input('url', array('div' => 'long input text required', 'after' => $m['url']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true)); ?>
</div>

<div class="nutch_jobs view">
	<h2><?php __('解析结果');?></h2>

	<div>
		<h3><?php __('符合条件的链接');?></h3>
		<div><pre id="outlinks"></pre></div>
	</div>
	<hr />
	<div>
		<h3><?php __('被过滤的链接');?></h3>
		<div><pre id="discardOutlinks"></pre></div>
	</div>
	<hr />
	<div>
		<h3><?php __('文本');?></h3>
		<div id="parseText"></div>
	</div>
	<hr />
	<div>
		<h3><?php __('配置');?></h3>
		<div id="nutchConfig">
			<pre>
				<?php pr($this->data['NutchJob']['nutchConfig']) ?>
		  </pre>
		</div>
	</div>
</div>

<?php if (!empty($this->data['NutchJob']['msg'])) : ?>
<div class='message'>
	<div class='red'>Error Message:</div>
	<pre><?php pr($this->data['NutchJob']['msg']) ?></pre>
</div>
<?php endif; ?>
