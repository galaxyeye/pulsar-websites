<div class="instances view">
<h2><?php  __('Instance');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $instance['Instance']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $instance['Instance']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Instance', true), array('action' => 'edit', $instance['Instance']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Instance', true), array('action' => 'delete', $instance['Instance']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $instance['Instance']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Instances', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Instance', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
