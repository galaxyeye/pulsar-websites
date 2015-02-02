<div class="properties form">
<?php echo $this->Form->create('Property', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Upload Property'); ?></legend>
	<?php 
	  echo $this->Form->input('url');

		echo $this->Form->input('file', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
