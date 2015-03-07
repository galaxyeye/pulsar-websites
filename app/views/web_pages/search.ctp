<div class="webPages form auto-validate">
<?php echo $this->Form->create('WebPage', array('action' => 'search'));?>
	<fieldset>
 		<legend><?php __('Search Web Page'); ?></legend>
	<?php 
	  $m = array(
	  		'batchId' => "<p class='m hidden'>batchId</p>",
	  		'startKey' => "<p class='m hidden'>startKey</p>",
	  		'endKey' => "<p class='m hidden'>endKey</p>"
	  );

	  pr($webPages);

		// echo $this->Form->input('batchId', array('div' => 'input text required', 'after' => $m['batchId']));
	  echo $this->Form->input('startKey', array('div' => 'input text medium required', 'after' => $m['startKey']));
		echo $this->Form->input('endKey', array('div' => 'input text medium', 'after' => $m['endKey']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Search Web', true), array('action' => 'search')); ?></li>
	</ul>
</div>
