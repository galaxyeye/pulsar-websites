<div class="pageEntityFields form">
<?php echo $this->Form->create('PageEntityField');?>
	<fieldset>
 		<legend>
 			<?php __('Edit Page Entity Field'); ?>
 			<?php echo " For "?>
 			<?php echo $this->Html->link($this->data['PageEntity']['name'], 
 					array('controller' => 'page_entities', 'action' => 'view', $this->data['PageEntity']['id'])); ?>
 		</legend>
	<?php 
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('extractor_class');
		echo $this->Form->input('css_path');
		echo $this->Form->input('text_extract_regex');
		echo $this->Form->input('text_validate_regex');
		echo $this->Form->input('sql_data_type');
		echo $this->Form->input('description');
		echo $this->Form->hidden('page_entity_id');
		echo $this->Form->hidden('crawl_id', array('value' => $crawl_id));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('PageEntityField.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('PageEntityField.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Page Entities', true), array('controller' => 'page_entities', 'action' => 'index')); ?> </li>
	</ul>
</div>
