<?php echo $this->element('page_entities/subnav') ?>

<div class="featureBlockTexts view">
<h2><?php  __('Feature Block Text');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $featureBlockText['FeatureBlockText']['id']; ?>
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
			<code><?php echo $featureBlockText['FeatureBlockText']['features']; ?></code>
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
