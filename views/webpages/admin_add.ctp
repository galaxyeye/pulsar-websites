<div class="webpages form">
<?php echo $this->Form->create('Webpage', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Upload Webpage'); ?></legend>
	<?php 
	  echo $this->Form->input('url');

		echo $this->Form->input('file', array('type' => 'file'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Webpages', true), array('action' => 'index'));?></li>
	</ul>
</div>