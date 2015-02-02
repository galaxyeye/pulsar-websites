<div class="compoundImages view">
<h2><?php  __('Compound Image');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compoundImage['CompoundImage']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Big'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compoundImage['CompoundImage']['is_big']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image($compoundImage['CompoundImage']['url']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Compound'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($compoundImage['Compound']['name_en'], array('controller' => 'compounds', 'action' => 'view', $compoundImage['Compound']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Add Compound Image', true), array('action' => 'add', 'compound_id' => $compoundImage['CompoundImage']['compound_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Compound Image', true), array('action' => 'delete', $compoundImage['CompoundImage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $compoundImage['CompoundImage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Compound Images', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Compounds', true), array('controller' => 'compounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound', true), array('controller' => 'compounds', 'action' => 'add')); ?> </li>
	</ul>
</div>
