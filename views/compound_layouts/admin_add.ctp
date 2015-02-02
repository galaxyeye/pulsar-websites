<div class="compoundLayouts form">
<?php echo $this->Form->create('CompoundLayout');?>
	<fieldset>
 		<legend>
 			<?php __('Admin Add Compound Layout - '); ?>
 			<?php echo $compound['Compound']['name_en']; ?>
 		</legend>
	<?php
		echo $this->Form->hidden('compound_id', array('value' => $compound['Compound']['id']));
		echo $this->Form->input('size');
		echo $this->Form->input('layout');
		echo $this->Form->input('rent_desc');
		echo $this->Form->input('rent_unit', array('options' => array('Month' => 'Month', 'Quarter' => 'Quarter', 'Year' => 'Year')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Compound Layouts', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Compounds', true), array('controller' => 'compounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound', true), array('controller' => 'compounds', 'action' => 'add')); ?> </li>
	</ul>
</div>