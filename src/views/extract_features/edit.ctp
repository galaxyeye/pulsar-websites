<?php echo $this->element('page_entities/subnav') ?>

<div class="extractFeatures form">
<?php echo $this->Form->create('ExtractFeature');?>
	<fieldset>
 		<legend><?php __('Edit Extract Feature'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('domain');
		echo $this->Form->input('bad_attr_name');
		echo $this->Form->input('bad_attr_value_words');
		echo $this->Form->input('bad_category_words');
		echo $this->Form->input('bad_entity_name_words');
		echo $this->Form->input('bad_html_title_words');
		echo $this->Form->input('bad_page_keywords');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('ExtractFeature.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('ExtractFeature.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Extract Features', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Feature Block Stats', true), array('controller' => 'feature_block_stats', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feature Block Stat', true), array('controller' => 'feature_block_stats', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Feature Block Texts', true), array('controller' => 'feature_block_texts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feature Block Text', true), array('controller' => 'feature_block_texts', 'action' => 'add')); ?> </li>
	</ul>
</div>