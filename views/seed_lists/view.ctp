<div class="seedLists view">
<h2><?php  __('Seed List');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seedList['SeedList']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($seedList['User']['name'], array('controller' => 'users', 'action' => 'view', $seedList['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seedList['SeedList']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seedList['SeedList']['desc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seedList['SeedList']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seedList['SeedList']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Seed List', true), array('action' => 'edit', $seedList['SeedList']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Seed List', true), array('action' => 'delete', $seedList['SeedList']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $seedList['SeedList']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Seed Lists', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seed List', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seeds', true), array('controller' => 'seeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seed', true), array('controller' => 'seeds', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Crawls');?></h3>
	<?php if (!empty($seedList['Crawl'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Desc'); ?></th>
		<th><?php __('Batchid'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Finished'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Seed List Id'); ?></th>
		<th><?php __('Round'); ?></th>
		<th><?php __('Crawlid'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($seedList['Crawl'] as $crawl):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $crawl['id'];?></td>
			<td><?php echo $crawl['name'];?></td>
			<td><?php echo $crawl['desc'];?></td>
			<td><?php echo $crawl['batchid'];?></td>
			<td><?php echo $crawl['created'];?></td>
			<td><?php echo $crawl['finished'];?></td>
			<td><?php echo $crawl['user_id'];?></td>
			<td><?php echo $crawl['seed_list_id'];?></td>
			<td><?php echo $crawl['round'];?></td>
			<td><?php echo $crawl['crawlid'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'crawls', 'action' => 'view', $crawl['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'crawls', 'action' => 'edit', $crawl['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'crawls', 'action' => 'delete', $crawl['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $crawl['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Seeds');?></h3>
	<?php if (!empty($seedList['Seed'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Urls'); ?></th>
		<th><?php __('Seed List Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($seedList['Seed'] as $seed):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $seed['id'];?></td>
			<td><?php echo $seed['urls'];?></td>
			<td><?php echo $seed['seed_list_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'seeds', 'action' => 'view', $seed['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'seeds', 'action' => 'edit', $seed['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'seeds', 'action' => 'delete', $seed['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $seed['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Seed', true), array('controller' => 'seeds', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
