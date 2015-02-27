<div class="pageEntities index">
	<h2><?php __('Page Entities');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('url_pattern');?></th>
			<th><?php echo $this->Paginator->sort('text_pattern');?></th>
			<th><?php echo $this->Paginator->sort('css_path');?></th>
			<th><?php echo $this->Paginator->sort('extraction_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($pageEntities as $pageEntity):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $pageEntity['PageEntity']['id']; ?>&nbsp;</td>
		<td><?php echo $pageEntity['PageEntity']['name']; ?>&nbsp;</td>
		<td><?php echo $pageEntity['PageEntity']['url_pattern']; ?>&nbsp;</td>
		<td><?php echo $pageEntity['PageEntity']['text_pattern']; ?>&nbsp;</td>
		<td><?php echo $pageEntity['PageEntity']['css_path']; ?>&nbsp;</td>
		<td>
			<?php 
				$name = $pageEntity['Extraction']['name'].'-'.$pageEntity['Extraction']['id'];
				echo $this->Html->link($name, array('controller' => 'extractions', 'action' => 'view', $pageEntity['Extraction']['id']));
		  ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $pageEntity['PageEntity']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $pageEntity['PageEntity']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $pageEntity['PageEntity']['id']),
						null, sprintf(__('Are you sure you want to delete # %s?', true), $pageEntity['PageEntity']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('List Page Entities', true), array('controller' => 'page_entities', 'action' => 'index')); ?> </li>
	</ul>
</div>