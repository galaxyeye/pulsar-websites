<?php echo $this->element('page_entities/subnav') ?>

<div class="extractFeatures index">
	<h2><?php __('Extract Features');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('domain');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($extractFeatures as $extractFeature):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $extractFeature['ExtractFeature']['id']; ?>&nbsp;</td>
		<td><?php echo $extractFeature['ExtractFeature']['domain']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $extractFeature['ExtractFeature']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $extractFeature['ExtractFeature']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $extractFeature['ExtractFeature']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $extractFeature['ExtractFeature']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Extract Feature', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Feature Block Stats', true), array('controller' => 'feature_block_stats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feature Block Stat', true), array('controller' => 'feature_block_stats', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Feature Block Texts', true), array('controller' => 'feature_block_texts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feature Block Text', true), array('controller' => 'feature_block_texts', 'action' => 'add')); ?> </li>
	</ul>
</div>