<?php echo $this->element('page_entities/subnav') ?>

<div class="featureBlockTexts form">
<?php echo $this->Form->create('FeatureBlockText');?>
	<fieldset>
 		<legend><?php __('Admin Add Feature Block Text'); ?></legend>
	<?php
		echo $this->Form->input('domain');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('features');
		echo $this->Form->input('feature_block_text_id');
		echo $this->Form->input('extract_feature_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Feature Block Texts', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Feature Block Texts', true), array('controller' => 'feature_block_texts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feature Block Text', true), array('controller' => 'feature_block_texts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Extract Features', true), array('controller' => 'extract_features', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Extract Feature', true), array('controller' => 'extract_features', 'action' => 'add')); ?> </li>
	</ul>
</div>