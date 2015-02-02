<div class="compoundLayouts index">
	<h2><?php __('Compound Layouts');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('compound_id');?></th>
			<th><?php echo $this->Paginator->sort('size');?></th>
			<th><?php echo $this->Paginator->sort('layout');?></th>
			<th><?php echo $this->Paginator->sort('rent_desc');?></th>
			<th><?php echo $this->Paginator->sort('rent_unit');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($compoundLayouts as $compoundLayout):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $compoundLayout['CompoundLayout']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($compoundLayout['Compound']['name_en'], array('controller' => 'compounds', 'action' => 'view', $compoundLayout['Compound']['id'])); ?>
		</td>
		<td><?php echo $compoundLayout['CompoundLayout']['size']; ?>&nbsp;</td>
		<td><?php echo $compoundLayout['CompoundLayout']['layout']; ?>&nbsp;</td>
		<td><?php echo $compoundLayout['CompoundLayout']['rent_desc']; ?>&nbsp;</td>
		<td><?php echo $compoundLayout['CompoundLayout']['rent_unit']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $compoundLayout['CompoundLayout']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $compoundLayout['CompoundLayout']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $compoundLayout['CompoundLayout']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $compoundLayout['CompoundLayout']['id'])); ?>
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