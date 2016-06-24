<div class="humanActions index">
	<h2><?php __('Human Actions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('action');?></th>
			<th><?php echo $this->Paginator->sort('css_path');?></th>
			<th><?php echo $this->Paginator->sort('script');?></th>
			<th><?php echo $this->Paginator->sort('order');?></th>
			<th><?php echo $this->Paginator->sort('crawl_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($humanActions as $humanAction):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $humanAction['HumanAction']['id']; ?>&nbsp;</td>
		<td><?php echo $humanAction['HumanAction']['action']; ?>&nbsp;</td>
		<td><?php echo $humanAction['HumanAction']['css_path']; ?>&nbsp;</td>
		<td><?php echo $humanAction['HumanAction']['script']; ?>&nbsp;</td>
		<td><?php echo $humanAction['HumanAction']['order']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($humanAction['Crawl']['name'], array('controller' => 'crawls', 'action' => 'view', $humanAction['Crawl']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $humanAction['HumanAction']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $humanAction['HumanAction']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $humanAction['HumanAction']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $humanAction['HumanAction']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Human Action', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
	</ul>
</div>