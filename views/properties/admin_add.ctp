<?php global $all_property_types, $all_ownerships, $all_property_status, $all_layouts, $property_keywords, $property_description; ?>

<div class="properties form">
<?php echo $this->Form->create('Property');?>
	<fieldset>
 		<legend>
 			<?php __('Admin Add Property - '); ?>
 			<?php echo $compound['Compound']['name_en'].'('.$compound['Compound']['name_zh'].')'; ?>
 	  </legend>
	<?php
		echo $this->Form->input('name_en', array('value' => $compound['Compound']['name_en']));
		echo $this->Form->input('name_zh', array('value' => $compound['Compound']['name_zh']));
		echo $this->Form->hidden('compound_id', array('value' => $compound['Compound']['id']));
		echo $this->Form->input('address', array('div' => 'long', 'value' => $compound['Compound']['address']));
		echo $this->Form->input('layout', array('options' => $all_layouts, 'default' => 3));
		echo $this->Form->input('property_type', array('options' => $all_property_types, 'value' => $compound['Compound']['property_type']));
		echo $this->Form->input('size', array('default' => 150));
		echo $this->Form->input('rent', array('default' => 10000));
//		echo $this->Form->input('rent_unit', array('options' => array('Month' => 'Month', 'Quarter' => 'Quarter', 'Year' => 'Year')));
		echo $this->Form->input('area_id', array('value' => $compound['Compound']['area_id']));
		echo $this->Form->input('district_id', array('value' => $compound['Compound']['district_id']));
		echo $this->Form->input('ownership', array('options' => $all_ownerships, 'value' => $compound['Compound']['ownership']));
		echo $this->Form->input('status', array('options' => array('Published' => 'Published', 'Waiting' => 'Waiting')));
		echo $this->Form->input('valid', array('options' => array('Valid' => 'Valid', 'Invalid' => 'Invalid')));
		echo $this->Form->input('user_id', array('type' => 'hide', 'value' => $currentUser['id']));
		echo $this->Form->input('desc');
		echo $this->Form->input('location');
		echo $this->Form->input('latlng', array('type' => 'text', 'value' => $compound['Compound']['lat'].','.$compound['Compound']['lng']));

		echo $this->Form->input('meta_keywords', array('value' => $property_keywords));
		echo $this->Form->input('meta_description', array('value' => $property_description));
  ?>

	<?php // echo $fck->fckeditor(array('Property', 'desc'), $html->base, 'description here');?>
	<?php // echo $fck->fckeditor(array('Property', 'location'), $html->base, 'location here');?>
  <?php // echo $fck->fckeditor(array('Property', 'location_map'), $html->base, 'location_map');?>
  </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List properties', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Compounds', true), array('controller' => 'compounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound', true), array('controller' => 'compounds', 'action' => 'add')); ?> </li>
	</ul>
</div>
