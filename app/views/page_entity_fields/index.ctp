<div class="pageEntityFields index">
	<h2><?php __('Page Entity Fields');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('extractor_class');?></th>
			<th><?php echo $this->Paginator->sort('css_path');?></th>
			<th><?php echo $this->Paginator->sort('text_extract_regex');?></th>
			<th><?php echo $this->Paginator->sort('text_validate_regex');?></th>
			<th><?php echo $this->Paginator->sort('sql_data_type');?></th>
			<th><?php echo $this->Paginator->sort('page_entity_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pageEntityFields as $pageEntityField):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $pageEntityField['PageEntityField']['id']; ?>&nbsp;</td>
		<td><?php echo $pageEntityField['PageEntityField']['name']; ?>&nbsp;</td>
		<td><?php echo $pageEntityField['PageEntityField']['description']; ?>&nbsp;</td>
		<td><?php echo $pageEntityField['PageEntityField']['extractor_class']; ?>&nbsp;</td>
		<td><?php echo $pageEntityField['PageEntityField']['css_path']; ?>&nbsp;</td>
		<td><?php echo $pageEntityField['PageEntityField']['text_extract_regex']; ?>&nbsp;</td>
		<td><?php echo $pageEntityField['PageEntityField']['text_validate_regex']; ?>&nbsp;</td>
		<td><?php echo $pageEntityField['PageEntityField']['sql_data_type']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($pageEntityField['PageEntity']['name'], array('controller' => 'page_entities', 'action' => 'view', $pageEntityField['PageEntity']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $pageEntityField['PageEntityField']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $pageEntityField['PageEntityField']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $pageEntityField['PageEntityField']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pageEntityField['PageEntityField']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Page Entity Field', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Page Entities', true), array('controller' => 'page_entities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page Entity', true), array('controller' => 'page_entities', 'action' => 'add')); ?> </li>
	</ul>
</div>