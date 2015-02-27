<div class="schedulings form">
<?php echo $this->Form->create('Scheduling');?>
	<fieldset>
 		<legend><?php __('Admin Add Scheduling'); ?></legend>
	<?php
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Schedulings', true), array('action' => 'index'));?></li>
	</ul>
</div>