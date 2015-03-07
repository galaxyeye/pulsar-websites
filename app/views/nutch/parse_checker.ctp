<div class="nutch form auto-validate">
<?php echo $this->Form->create('Nutch', array('action' => 'parseChecker'));?>
	<fieldset>
 		<legend><?php __('Parse Checker'); ?></legend>
	<?php 
	  $m = array('url' => "<p class='m hidden'>目标链接</p>");
	  echo $this->hidden('configId', array('value' => $configId));
		echo $this->Form->input('url', array('div' => 'long input text required', 'after' => $m['url']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
