<div class="crawls index">
	<h2><?php __('Crawls');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('round');?></th>
			<th><?php echo $this->Paginator->sort('batchid');?></th>
			<th><?php echo $this->Paginator->sort('phrase');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('finished');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($crawls as $crawl):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $crawl['Crawl']['id']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['name']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['description']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['round']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['batchid']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['phrase']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['status']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($crawl['User']['name'], array('controller' => 'users', 'action' => 'view', $crawl['User']['id'])); ?>
		</td>
		<td><?php echo $crawl['Crawl']['created']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['finished']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $crawl['Crawl']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $crawl['Crawl']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $crawl['Crawl']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $crawl['Crawl']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Crawl Filters', true), array('controller' => 'crawl_filters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl Filter', true), array('controller' => 'crawl_filters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seeds', true), array('controller' => 'seeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seed', true), array('controller' => 'seeds', 'action' => 'add')); ?> </li>
	</ul>
</div>