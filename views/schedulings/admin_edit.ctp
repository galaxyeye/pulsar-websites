<div class="schedulings form">
<?php echo $this->Form->create('Scheduling');?>
	<fieldset>
 		<legend><?php __('Admin Edit Scheduling'); ?></legend>
	<?php
		echo $this->Form->input('id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Scheduling.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Scheduling.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Schedulings', true), array('action' => 'index'));?></li>
	</ul>
</div>