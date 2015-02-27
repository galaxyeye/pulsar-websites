<div class="dashboards form">
<?php echo $this->Form->create('Dashboard');?>
	<fieldset>
 		<legend><?php __('Admin Add Dashboard'); ?></legend>
	<?php
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Dashboards', true), array('action' => 'index'));?></li>
	</ul>
</div>