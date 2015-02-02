<div class="schedulings view">
<h2><?php  __('Scheduling');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scheduling['Scheduling']['id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Scheduling', true), array('action' => 'edit', $scheduling['Scheduling']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Scheduling', true), array('action' => 'delete', $scheduling['Scheduling']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $scheduling['Scheduling']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Schedulings', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Scheduling', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
