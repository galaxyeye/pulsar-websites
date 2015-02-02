<div class="pageEntityFields form">
<?php echo $this->Form->create('PageEntityField');?>
	<fieldset>
 		<legend><?php __('Add Page Entity Field'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('desc');
		echo $this->Form->input('extractor_class');
		echo $this->Form->input('css_path');
		echo $this->Form->input('text_extract_regex');
		echo $this->Form->input('text_validate_regex');
		echo $this->Form->input('sql_data_type');
		echo $this->Form->input('page_entity_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Page Entity Fields', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Page Entities', true), array('controller' => 'page_entities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page Entity', true), array('controller' => 'page_entities', 'action' => 'add')); ?> </li>
	</ul>
</div>