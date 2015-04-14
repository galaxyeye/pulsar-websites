<?php echo $this->element('page_entities/subnav') ?>

<div class="featureBlockStats index">
	<h2><?php __('Feature Block Stats');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('extract_feature_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($featureBlockStats as $featureBlockStat):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $featureBlockStat['FeatureBlockStat']['id']; ?>&nbsp;</td>
		<td><?php echo $featureBlockStat['FeatureBlockStat']['name']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($featureBlockStat['ExtractFeature']['domain'], array('controller' => 'extract_features', 'action' => 'view', $featureBlockStat['ExtractFeature']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $featureBlockStat['FeatureBlockStat']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $featureBlockStat['FeatureBlockStat']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $featureBlockStat['FeatureBlockStat']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $featureBlockStat['FeatureBlockStat']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Feature Block Stat', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Extract Features', true), array('controller' => 'extract_features', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Extract Feature', true), array('controller' => 'extract_features', 'action' => 'add')); ?> </li>
	</ul>
</div>