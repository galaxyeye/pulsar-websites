<div class="pageEntityFields form auto-validate">
<?php echo $this->Form->create('PageEntityField');?>
	<fieldset>
 		<legend>
 			<?php __('Add Page Entity Field'); ?>
 			<?php echo " For "?>
 			<?php echo $this->Html->link($pageEntity['PageEntity']['name'], 
 					array('controller' => 'page_entities', 'action' => 'view', $pageEntity['PageEntity']['id'])); ?>
 		</legend>
	<?php 
		global $allExtractors;

		$m = array(
				'name' => '',
				'extractor_class' => '<p class="m">specifiy a extractor to located code section</p>',
				'css_path' => '<p class="m">css path for field value, relative to page entity\'s css path</p>',
				'text_extract_regex' => '<p class="m">regex to extract the value</p>',
				'text_validate_regex' => '<p class="m">regex to validate the value</p>',
				'sql_data_type' => '<p class="m">specifiy type RDMS data type to generate sql statements</p>'
		);

		echo $this->Form->input('name');
		echo $this->Form->input('extractor_class', array('value' => 'TextExtractor', 
				'options' => $allExtractors, 'after' => $m['name']));
		echo $this->Form->input('css_path', array('div' => 'input long text', 'after' => $m['css_path']));
		echo $this->Form->input('text_extract_regex', array('value' => '.+', 'after' => $m['text_extract_regex']));
		echo $this->Form->input('text_validate_regex', array('value' => '.+', 'after' => $m['text_validate_regex']));
		echo $this->Form->input('sql_data_type', array('value' => 'varchar(256) default ""', 
				'after' => $m['sql_data_type']));
		echo $this->Form->input('description');

		echo $this->Form->hidden('page_entity_id', array('value' => $pageEntity['PageEntity']['id']));
		echo $this->Form->hidden('crawl_id', array('value' => $crawl_id));
  ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true)); ?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Page Entities', true), array('controller' => 'page_entities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page Entity', true), array('controller' => 'page_entities', 'action' => 'add')); ?> </li>
	</ul>
</div>
