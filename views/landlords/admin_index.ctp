<div class="landlords index">
	<h2><?php __('Landlords');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('gender');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('name', 'full_name');?></th>
			<th><?php echo $this->Paginator->sort('phone', 'cell_phone');?></th>
			<th><?php echo $this->Paginator->sort('compound', 'compound_name');?></th>
			<th><?php echo $this->Paginator->sort('unit_size');?></th>
			<th><?php echo $this->Paginator->sort('bdr', 'bedrooms');?></th>
			<th><?php echo $this->Paginator->sort('liv', 'livingrooms');?></th>
			<th><?php echo $this->Paginator->sort('bath', 'bathrooms');?></th>
			<th><?php echo $this->Paginator->sort('ren', 'rental');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php 
	$i = 0;
	foreach ($landlords as $landlord):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $landlord['Landlord']['id']; ?>&nbsp;</td>
		<td><?php echo $landlord['Landlord']['gender']; ?>&nbsp;</td>
		<td><?php echo $landlord['Landlord']['email']; ?>&nbsp;</td>
		<td><?php echo $landlord['Landlord']['full_name']; ?>&nbsp;</td>
		<td><?php echo $landlord['Landlord']['cell_phone']; ?>&nbsp;</td>
		<td><?php echo $landlord['Landlord']['compound_name']; ?>&nbsp;</td>
		<td><?php echo $landlord['Landlord']['unit_size']; ?>&nbsp;</td>
		<td><?php echo $landlord['Landlord']['bedrooms']; ?>&nbsp;</td>
		<td><?php echo $landlord['Landlord']['livingrooms']; ?>&nbsp;</td>
		<td><?php echo $landlord['Landlord']['bathrooms']; ?>&nbsp;</td>
		<td><?php echo $landlord['Landlord']['rental']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $landlord['Landlord']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $landlord['Landlord']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $landlord['Landlord']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $landlord['Landlord']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Landlord', true), array('action' => 'add')); ?></li>
	</ul>
</div>