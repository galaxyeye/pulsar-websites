<div class="apartmentImages view">
<h2><?php  __('Property Image');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $propertyImage['PropertyImage']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Big'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $propertyImage['PropertyImage']['is_big']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image($propertyImage['PropertyImage']['url']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Property'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($propertyImage['Property']['address'], array('controller' => 'properties', 'action' => 'view', $propertyImage['Property']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Add Property Image', true), array('action' => 'add', 'property_id' => $propertyImage['PropertyImage']['property_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Property Image', true), array('action' => 'delete', $propertyImage['PropertyImage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $propertyImage['PropertyImage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Property Images', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List properties', true), array('controller' => 'properties', 'action' => 'index')); ?> </li>
	</ul>
</div>
