<div class="landlords form">
<?php echo $this->Form->create('Landlord');?>
	<fieldset>
 		<legend><?php __('Edit Landlord'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('gender');
		echo $this->Form->input('email');
		echo $this->Form->input('full_name');
		echo $this->Form->input('cell_phone');
		echo $this->Form->input('compound_name');
		echo $this->Form->input('property_address');
		echo $this->Form->input('unit_size');
		echo $this->Form->input('bedrooms');
		echo $this->Form->input('livingrooms');
		echo $this->Form->input('bathrooms');
		echo $this->Form->input('furnishings');
		echo $this->Form->input('rental');
		echo $this->Form->input('comments');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Landlord.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Landlord.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Landlords', true), array('action' => 'index'));?></li>
	</ul>
</div>