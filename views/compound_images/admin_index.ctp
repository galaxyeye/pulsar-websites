<div class="compoundImages index">
	<h2><?php __('Compound Images');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Compound.name_en');?></th>
			<th><?php echo $this->Paginator->sort('is_big');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($compoundImages as $compoundImage):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
	  <td><?php echo $compoundImage['Compound']['id'] ?></td>
		<td>
			<?php echo $this->Html->link($compoundImage['Compound']['name_en'], array('controller' => 'compounds', 'action' => 'view', $compoundImage['Compound']['id'])); ?>
		</td>
		<td><?php echo $compoundImage['CompoundImage']['is_big'] == 1 ? 'big' : 'small'; ?>&nbsp;</td>
		<td><?php echo $this->Html->image($compoundImage['CompoundImage']['url'], array('width' => 100)); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $compoundImage['CompoundImage']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $compoundImage['CompoundImage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $compoundImage['CompoundImage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('List Compounds', true), array('controller' => 'compounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound', true), array('controller' => 'compounds', 'action' => 'add')); ?> </li>
	</ul>
</div>