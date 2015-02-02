<div class="apartmentImages index">
	<h2><?php __('Property Images');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('pid');?></th>
			<th><?php echo $this->Paginator->sort('address');?></th>
			<th><?php echo $this->Paginator->sort('is_big');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php 
	$i = 0;
	foreach ($propertyImages as $propertyImage):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	  <td><?php echo $propertyImage['Property']['id'] ?></td>
		<td>
			<?php echo $this->Html->link($propertyImage['Property']['pid'], array('controller' => 'properties', 'action' => 'view', $propertyImage['Property']['id'])); ?>
		</td>
		<td><?php echo $propertyImage['Property']['address']; ?>&nbsp;</td>
		<td><?php echo $propertyImage['PropertyImage']['is_big'] == 1 ? 'big' : 'small'; ?>&nbsp;</td>
		<td><?php echo $this->Html->image($propertyImage['PropertyImage']['url'], array('width' => 100)); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $propertyImage['PropertyImage']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $propertyImage['PropertyImage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $propertyImage['PropertyImage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('List properties', true), array('controller' => 'properties', 'action' => 'index')); ?> </li>
	</ul>
</div>
