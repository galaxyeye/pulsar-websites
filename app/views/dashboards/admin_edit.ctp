<div class="dashboards form">
<?php echo $this->Form->create('Dashboard');?>
	<fieldset>
 		<legend><?php __('Admin Edit Dashboard'); ?></legend>
	<?php
		echo $this->Form->input('id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Dashboard.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Dashboard.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Dashboards', true), array('action' => 'index'));?></li>
	</ul>
</div>