<div class="seeds form">
<?php echo $this->Form->create('Seed');?>
	<fieldset>
 		<legend><?php __('Edit Seed'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('urls');
		echo $this->Form->input('seed_list_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Seed.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Seed.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Seeds', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Seed Lists', true), array('controller' => 'seed_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seed List', true), array('controller' => 'seed_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>