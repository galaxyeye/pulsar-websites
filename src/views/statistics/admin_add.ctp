<div class="statistics form">
<?php echo $this->Form->create('Statistic');?>
	<fieldset>
 		<legend><?php __('Admin Add Statistic'); ?></legend>
	<?php
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Statistics', true), array('action' => 'index'));?></li>
	</ul>
</div>