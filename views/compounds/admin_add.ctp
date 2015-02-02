<?php global $all_property_types, $all_ownerships, $compound_keywords, $compound_description; ?>

<div class="compounds form">
<?php echo $this->Form->create('Compound');?>
	<fieldset>
 		<legend><?php __('Admin Add Compound'); ?></legend>
	<?php
		echo $this->Form->input('name_en');
		echo $this->Form->input('name_zh');
		echo $this->Form->input('address');
		echo $this->Form->input('rent_lower', array('default' => '0'));
		echo $this->Form->input('rent_upper', array('default' => '100000'));
		echo $this->Form->input('rent_unit', array('options' => array('Month' => 'Month', 'Quarter' => 'Quarter', 'Year' => 'Year')));
	  echo $this->Form->input('layout', array('default' => '1 - 4'));
		echo $this->Form->input('property_type', array('options' => $all_property_types));
	  echo $this->Form->input('area_id');
	  echo $this->Form->input('district_id');
	  echo $this->Form->input('ownership', array('options' => $all_ownerships));
		echo $this->Form->input('management', array('options' => array('None' => 'None', 'Full' => 'Full', 'Partial' => 'Partial')));
		echo $this->Form->input('School', array('default' => 0, 'size' => min(count($schools), 30)));
		echo $this->Form->input('status', array('options' => array('Published' => 'Published', 'Waiting' => 'Waiting', 'Hidden' => 'Hidden')));
		echo $this->Form->input('user_id', array('type' => 'hide', 'value' => $currentUser['id']));

		echo $this->Form->input('desc');
		echo $this->Form->input('features');
		echo $this->Form->input('locations');
		echo $this->Form->input('facilities');
		echo $this->Form->input('latlng');

		echo $this->Form->input('meta_keywords', array('value' => $compound_keywords));
		echo $this->Form->input('meta_description', array('value' => $compound_description));
	?>

	<!-- 
	<div>Description</div>
	<?php // echo $fck->fckeditor(array('Compound', 'desc'), $html->base, 'description here');?>
	<div>Features</div>
	<?php // echo $fck->fckeditor(array('Compound', 'features'), $html->base, 'features here');?>
	<div>Location</div>
	<?php // echo $fck->fckeditor(array('Compound', 'location'), $html->base, 'location here');?>
	<div>Facilities</div>
	<?php // echo $fck->fckeditor(array('Compound', 'facilities'), $html->base, 'facilities here');?>
	<?php // echo $fck->fckeditor(array('Property', 'location_map'), $html->base, 'location_map');?>
 -->

	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Compounds', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Areas', true), array('controller' => 'areas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List properties', true), array('controller' => 'properties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Compound Layouts', true), array('controller' => 'compound_layouts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound Layout', true), array('controller' => 'compound_layouts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schools', true), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School', true), array('controller' => 'schools', 'action' => 'add')); ?> </li>
	</ul>
</div>
