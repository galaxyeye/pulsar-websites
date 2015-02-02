<?php global $all_property_types, $all_ownerships, $all_property_status, $all_layouts; ?>

<div class='message green'>
<?php if($this->Form->value('Property.is_alone')) : ?>
注意：这是一个单独的房源，所有改动都会被同步到相应的傀儡小区。
<?php endif; ?>
</div>

<div class="properties form">
<?php echo $this->Form->create('Property');?>
	<fieldset>
 		<legend><?php __('Admin Edit Property'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('pid');
		echo $this->Form->input('name_en');
		echo $this->Form->input('name_zh');
		echo $this->Form->input('address', array('div' => 'long'));
		echo $this->Form->input('layout', array('options' => $all_layouts, 'default' => 3));
		echo $this->Form->input('property_type', array('options' => $all_property_types));
		echo $this->Form->input('size', array('default' => 150));
		echo $this->Form->input('rent', array('default' => 10000));
		echo $this->Form->input('area_id');
		echo $this->Form->input('district_id');
		echo $this->Form->input('ownership', array('options' => $all_ownerships));		
		echo $this->Form->input('status', array('options' => $all_property_status));
		echo $this->Form->input('valid', array('options' => array('Valid' => 'Valid', 'Invalid' => 'Invalid')));
		echo $this->Form->input('desc');
		echo $this->Form->input('location');
		echo $this->Form->input('latlng', array('type' => 'text', 'value' => $this->Form->value('Property.lat').','.$this->Form->value('Property.lng')));
		echo $this->Form->hidden('compound_id');
		echo $this->Form->hidden('is_alone');

		echo $this->Form->input('meta_keywords');
		echo $this->Form->input('meta_description');
  ?>
  <?php // echo $fck->fckeditor(array('Property', 'location_map'), $html->base, 'location_map'); ?>
  <?php // echo $fck->fckeditor(array('Property', 'location_map'), $html->base, 'location_map'); ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('View', true), array('action' => 'view', $this->Form->value('Property.id')));?></li>
	  <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Property.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Property.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Properties', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Compounds', true), array('controller' => 'compounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound', true), array('controller' => 'compounds', 'action' => 'add')); ?> </li>
	</ul>
</div>
