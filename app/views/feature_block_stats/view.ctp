<?php echo $this->element('page_entities/subnav') ?>

<style>
<!--
#FeatureBlockStatFeatures { width: 80%; }
-->
</style>

<div class="featureBlockStats view">
<h2><?php  __('Feature Block Stat');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $featureBlockStat['FeatureBlockStat']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $featureBlockStat['FeatureBlockStat']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $featureBlockStat['FeatureBlockStat']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Features'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<textarea rows="100" id='FeatureBlockStatFeatures'><?php echo $featureBlockStat['FeatureBlockStat']['features']; ?></textarea>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Extract Feature'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($featureBlockStat['ExtractFeature']['domain'], array('controller' => 'extract_features', 'action' => 'view', $featureBlockStat['ExtractFeature']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Feature Block Stat', true), array('action' => 'edit', $featureBlockStat['FeatureBlockStat']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Feature Block Stat', true), array('action' => 'delete', $featureBlockStat['FeatureBlockStat']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $featureBlockStat['FeatureBlockStat']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Feature Block Stats', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feature Block Stat', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Extract Features', true), array('controller' => 'extract_features', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Extract Feature', true), array('controller' => 'extract_features', 'action' => 'add')); ?> </li>
	</ul>
</div>
