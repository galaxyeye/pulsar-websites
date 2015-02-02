<div class="compoundLayouts view">
<h2><?php  __('Compound Layout');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compoundLayout['CompoundLayout']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Compound'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($compoundLayout['Compound']['name_en'], array('controller' => 'compounds', 'action' => 'view', $compoundLayout['Compound']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Size'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compoundLayout['CompoundLayout']['size']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Layout'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compoundLayout['CompoundLayout']['layout']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rent Desc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compoundLayout['CompoundLayout']['rent_desc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rent Unit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compoundLayout['CompoundLayout']['rent_unit']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Compound Layout', true), array('action' => 'edit', $compoundLayout['CompoundLayout']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Compound Layout', true), array('action' => 'delete', $compoundLayout['CompoundLayout']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $compoundLayout['CompoundLayout']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Compound Layouts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound Layout', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Compounds', true), array('controller' => 'compounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound', true), array('controller' => 'compounds', 'action' => 'add')); ?> </li>
	</ul>
</div>
