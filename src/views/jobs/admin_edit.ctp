<?php
assert(isset($html));
?>

<div class="jobs form">
<?php echo $this->Form->create('Job');?>
	<fieldset>
 		<legend><?php __('Admin Edit Job'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('category');
		echo $this->Form->input('categoryDisplay');
		echo $this->Form->input('title');
		echo $this->Form->input('location');
		echo $this->Form->input('salary');
		echo $this->Form->input('duty');
		echo $this->Form->input('condition');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Job.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Job.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Jobs', true), array('action' => 'index'));?></li>
	</ul>
</div>