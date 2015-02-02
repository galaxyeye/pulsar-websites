<div class="seeds view">
<h2><?php  __('Seed');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seed['Seed']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Urls'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seed['Seed']['urls']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Seed List'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($seed['SeedList']['name'], array('controller' => 'seed_lists', 'action' => 'view', $seed['SeedList']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Seed', true), array('action' => 'edit', $seed['Seed']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Seed', true), array('action' => 'delete', $seed['Seed']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $seed['Seed']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Seeds', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seed', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seed Lists', true), array('controller' => 'seed_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seed List', true), array('controller' => 'seed_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>
