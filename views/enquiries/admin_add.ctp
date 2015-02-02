<div class="enquiries form">
<?php echo $this->Form->create('Enquiry');?>
	<fieldset>
 		<legend><?php __('Admin Add Enquiry'); ?></legend>
	<?php
		echo $this->Form->input('full_name');
		echo $this->Form->input('email');
		echo $this->Form->input('cell_phone');
		echo $this->Form->input('company');
		echo $this->Form->input('nationality');
		echo $this->Form->input('budget');
		echo $this->Form->input('lease_term');
		echo $this->Form->input('house_type');
		echo $this->Form->input('city');
		echo $this->Form->input('area');
		echo $this->Form->input('bedrooms');
		echo $this->Form->input('furnishings');
		echo $this->Form->input('comments');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Enquiries', true), array('action' => 'index'));?></li>
	</ul>
</div>