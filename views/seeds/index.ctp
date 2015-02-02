<div class="seeds index">
	<h2><?php __('Seeds');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('urls');?></th>
			<th><?php echo $this->Paginator->sort('seed_list_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($seeds as $seed):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $seed['Seed']['id']; ?>&nbsp;</td>
		<td><?php echo $seed['Seed']['urls']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($seed['SeedList']['name'], array('controller' => 'seed_lists', 'action' => 'view', $seed['SeedList']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $seed['Seed']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $seed['Seed']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $seed['Seed']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $seed['Seed']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Seed', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Seed Lists', true), array('controller' => 'seed_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seed List', true), array('controller' => 'seed_lists', 'action' => 'add')); ?> </li>
	</ul>
</div>