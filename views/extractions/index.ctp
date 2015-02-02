<div class="extractions index">
	<h2><?php __('Extractions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('crawlid');?></th>
			<th><?php echo $this->Paginator->sort('desc');?></th>
			<th><?php echo $this->Paginator->sort('domain');?></th>
			<th><?php echo $this->Paginator->sort('url_pattern');?></th>
			<th><?php echo $this->Paginator->sort('text_pattern');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($extractions as $extraction):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $extraction['Extraction']['id']; ?>&nbsp;</td>
		<td><?php echo $extraction['Extraction']['name']; ?>&nbsp;</td>
		<td><?php echo $extraction['Extraction']['crawlid']; ?>&nbsp;</td>
		<td><?php echo $extraction['Extraction']['desc']; ?>&nbsp;</td>
		<td><?php echo $extraction['Extraction']['domain']; ?>&nbsp;</td>
		<td><?php echo $extraction['Extraction']['url_pattern']; ?>&nbsp;</td>
		<td><?php echo $extraction['Extraction']['text_pattern']; ?>&nbsp;</td>
		<td><?php echo $extraction['Extraction']['created']; ?>&nbsp;</td>
		<td><?php echo $extraction['Extraction']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $extraction['Extraction']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $extraction['Extraction']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $extraction['Extraction']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $extraction['Extraction']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Extraction', true), array('action' => 'add')); ?></li>
	</ul>
</div>