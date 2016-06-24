<?php echo $this->element('page_entities/subnav') ?>

<div class="featureBlockTexts view">
<h2><?php  __('Feature Block Text');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $featureBlockText['FeatureBlockText']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Domain'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $featureBlockText['FeatureBlockText']['domain']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $featureBlockText['FeatureBlockText']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $featureBlockText['FeatureBlockText']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Features'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $featureBlockText['FeatureBlockText']['features']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Feature Block Text'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($featureBlockText['FeatureBlockText']['name'], array('controller' => 'feature_block_texts', 'action' => 'view', $featureBlockText['FeatureBlockText']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Extract Feature'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($featureBlockText['ExtractFeature']['domain'], array('controller' => 'extract_features', 'action' => 'view', $featureBlockText['ExtractFeature']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Feature Block Text', true), array('action' => 'edit', $featureBlockText['FeatureBlockText']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Feature Block Text', true), array('action' => 'delete', $featureBlockText['FeatureBlockText']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $featureBlockText['FeatureBlockText']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Feature Block Texts', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feature Block Text', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Feature Block Texts', true), array('controller' => 'feature_block_texts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feature Block Text', true), array('controller' => 'feature_block_texts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Extract Features', true), array('controller' => 'extract_features', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Extract Feature', true), array('controller' => 'extract_features', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Feature Block Texts');?></h3>
	<?php if (!empty($featureBlockText['FeatureBlockText'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Domain'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Features'); ?></th>
		<th><?php __('Feature Block Text Id'); ?></th>
		<th><?php __('Extract Feature Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($featureBlockText['FeatureBlockText'] as $featureBlockText):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $featureBlockText['id'];?></td>
			<td><?php echo $featureBlockText['domain'];?></td>
			<td><?php echo $featureBlockText['name'];?></td>
			<td><?php echo $featureBlockText['description'];?></td>
			<td><?php echo $featureBlockText['features'];?></td>
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
