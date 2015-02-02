<div class="compounds form">
<?php echo $this->Form->create('Compound', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Upload Compound'); ?></legend>
	<?php 
	  echo $this->Form->input('url');
	  echo $this->Form->input('dir');
		echo $this->Form->input('file', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
