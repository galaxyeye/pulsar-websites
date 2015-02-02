<?php global $all_property_types, $all_ownerships; ?>

<div class="compounds form">
<?php echo $this->Form->create('Compound');?>
	<fieldset>
 		<legend><?php __('Admin Edit Compound'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('cid');
		echo $this->Form->input('name_en');
		echo $this->Form->input('name_zh');
		echo $this->Form->input('address');
		echo $this->Form->input('rent_lower', array('default' => '0'));
		echo $this->Form->input('rent_upper', array('default' => '100000'));
		echo $this->Form->input('rent_unit', array('options' => array('Month' => 'Month', 'Quarter' => 'Quarter', 'Year' => 'Year')));
	  echo $this->Form->input('layout');
		echo $this->Form->input('property_type', array('options' => $all_property_types));
		echo $this->Form->input('area_id');
		echo $this->Form->input('district_id');
		echo $this->Form->input('ownership', array('options' => $all_ownerships));
		echo $this->Form->input('management', array('options' => array('None' => 'None', 'Full' => 'Full', 'Partial' => 'Partial')));
		echo $this->Form->input('School', array('size' => min(count($schools), 30)));
		echo $this->Form->input('status', array('options' => array('Published' => 'Published', 'Waiting' => 'Waiting', 'Hidden' => 'Hidden')));

		echo $this->Form->input('desc');
		echo $this->Form->input('features');
		echo $this->Form->input('locations');
		echo $this->Form->input('facilities');
		echo $this->Form->input('latlng', array('type' => 'text', 'value' => $this->Form->value('Compound.lat').','.$this->Form->value('Compound.lng')));

		echo $this->Form->input('meta_keywords');
		echo $this->Form->input('meta_description');
	?>

	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Compound.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Compound.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Compounds', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Areas', true), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Area', true), array('controller' => 'areas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List properties', true), array('controller' => 'properties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Compound Layouts', true), array('controller' => 'compound_layouts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound Layout', true), array('controller' => 'compound_layouts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schools', true), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School', true), array('controller' => 'schools', 'action' => 'add')); ?> </li>
	</ul>
</div>