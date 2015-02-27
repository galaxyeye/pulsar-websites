<div class="searches view">
<h2><?php  __('Search');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $search['Search']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $search['Search']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Search', true), array('action' => 'edit', $search['Search']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Search', true), array('action' => 'delete', $search['Search']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $search['Search']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Searches', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Search', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
