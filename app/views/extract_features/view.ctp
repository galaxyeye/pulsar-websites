<?php echo $this->element('page_entities/subnav') ?>

<div class="extractFeatures view">
<h2><?php  __('Extract Feature');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $extractFeature['ExtractFeature']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Domain'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $extractFeature['ExtractFeature']['domain']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bad Attr Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<pre><?php echo $extractFeature['ExtractFeature']['bad_attr_name']; ?></pre>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bad Attr Value Words'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<pre><?php echo $extractFeature['ExtractFeature']['bad_attr_value_words']; ?></pre>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bad Category Words'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<pre><?php echo $extractFeature['ExtractFeature']['bad_category_words']; ?></pre>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bad Entity Name Words'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<pre><?php echo $extractFeature['ExtractFeature']['bad_entity_name_words']; ?></pre>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bad Html Title Words'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<pre><?php echo $extractFeature['ExtractFeature']['bad_html_title_words']; ?></pre>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bad Page Keywords'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<pre><?php echo $extractFeature['ExtractFeature']['bad_page_keywords']; ?></pre>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Extract Feature', true), array('action' => 'edit', $extractFeature['ExtractFeature']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Extract Feature', true), array('action' => 'delete', $extractFeature['ExtractFeature']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $extractFeature['ExtractFeature']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Extract Features', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Extract Feature', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Feature Block Stats', true), array('controller' => 'feature_block_stats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feature Block Stat', true), array('controller' => 'feature_block_stats', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Feature Block Texts', true), array('controller' => 'feature_block_texts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feature Block Text', true), array('controller' => 'feature_block_texts', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Feature Block Stats');?></h3>
	<?php if (!empty($extractFeature['FeatureBlockStat'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Domain'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Features'); ?></th>
		<th><?php __('Extract Feature Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($extractFeature['FeatureBlockStat'] as $featureBlockStat):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $featureBlockStat['id'];?></td>
			<td><?php echo $featureBlockStat['name'];?></td>
			<td><?php echo $featureBlockStat['extract_feature_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'feature_block_stats', 'action' => 'view', $featureBlockStat['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'feature_block_stats', 'action' => 'edit', $featureBlockStat['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'feature_block_stats', 'action' => 'delete', $featureBlockStat['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $featureBlockStat['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Feature Block Stat', true), array('controller' => 'feature_block_stats', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Feature Block Texts');?></h3>
	<?php if (!empty($extractFeature['FeatureBlockText'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Domain'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Feature Block Text Id'); ?></th>
		<th><?php __('Extract Feature Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($extractFeature['FeatureBlockText'] as $featureBlockText):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $featureBlockText['id'];?></td>
			<td><?php echo $featureBlockText['name'];?></td>
			<td><?php echo $featureBlockText['feature_block_text_id'];?></td>
			<td><?php echo $featureBlockText['extract_feature_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'feature_block_texts', 'action' => 'view', $featureBlockText['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'feature_block_texts', 'action' => 'edit', $featureBlockText['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'feature_block_texts', 'action' => 'delete', $featureBlockText['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $featureBlockText['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Feature Block Text', true), array('controller' => 'feature_block_texts', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
