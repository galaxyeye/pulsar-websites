<div class="instances form">
<?php echo $this->Form->create('Instance');?>
	<fieldset>
 		<legend><?php __('Admin Add Instance'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Instances', true), array('action' => 'index'));?></li>
	</ul>
</div>