<div class="solutions view">
<h2><?php  __('Solution');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $solution['Solution']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Symbol'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $solution['Solution']['symbol']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $solution['Solution']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $solution['Solution']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Content'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $solution['Solution']['content']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Solution', true), array('action' => 'edit', $solution['Solution']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Solution', true), array('action' => 'delete', $solution['Solution']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $solution['Solution']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Solutions', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Solution', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
