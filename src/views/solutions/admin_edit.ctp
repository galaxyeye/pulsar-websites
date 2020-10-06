<div class="solutions form">
<?php echo $this->Form->create('Solution');?>
	<fieldset>
 		<legend><?php __('Admin Edit Solution'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('symbol');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Solution.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Solution.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Solutions', true), array('action' => 'index'));?></li>
	</ul>
</div>