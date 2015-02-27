<div class="crawls view">
<h2><?php  __('Crawl');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Round'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['round']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Batchid'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['batchid']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Phrase'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['phrase']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($crawl['User']['name'], array('controller' => 'users', 'action' => 'view', $crawl['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Finished'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['finished']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Crawl', true), array('action' => 'edit', $crawl['Crawl']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Crawl', true), array('action' => 'delete', $crawl['Crawl']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $crawl['Crawl']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Crawl Filters', true), array('controller' => 'crawl_filters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl Filter', true), array('controller' => 'crawl_filters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seeds', true), array('controller' => 'seeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seed', true), array('controller' => 'seeds', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Crawl Filters');?></h3>
	<?php if (!empty($crawl['CrawlFilter'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Domain Pattern'); ?></th>
		<th><?php __('Url Pattern'); ?></th>
		<th><?php __('Text Pattern'); ?></th>
		<th><?php __('Crawl Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($crawl['CrawlFilter'] as $crawlFilter):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $crawlFilter['id'];?></td>
			<td><?php echo $crawlFilter['domain_pattern'];?></td>
			<td><?php echo $crawlFilter['url_pattern'];?></td>
			<td><?php echo $crawlFilter['text_pattern'];?></td>
			<td><?php echo $crawlFilter['crawl_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'crawl_filters', 'action' => 'view', $crawlFilter['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'crawl_filters', 'action' => 'edit', $crawlFilter['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'crawl_filters', 'action' => 'delete', $crawlFilter['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $crawlFilter['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Crawl Filter', true), array('controller' => 'crawl_filters', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Seeds');?></h3>
	<?php if (!empty($crawl['Seed'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Url'); ?></th>
		<th><?php __('Crawl Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($crawl['Seed'] as $seed):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $seed['id'];?></td>
			<td><?php echo $seed['url'];?></td>
			<td><?php echo $seed['crawl_id'];?></td>
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
