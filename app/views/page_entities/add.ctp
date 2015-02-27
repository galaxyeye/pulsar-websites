<div class="pageEntities form auto-validate">
<?php echo $this->Form->create('PageEntity');?>
	<fieldset>
 		<legend><?php __('Add Page Entity'); ?></legend>
	<?php 
		$defaultName = 'PageEntity-'.date('YmdHis');

		echo $this->Form->input('name', array('value' => $defaultName));
		echo $this->Form->input('url_pattern', array('div' => 'input long text', 'value' => '.+'));
		echo $this->Form->input('text_pattern', array('div' => 'input long text', 'value' => '.+'));
		echo $this->Form->input('css_path', array('div' => 'input long text', 'value' => ':root'));
		echo $this->Form->hidden('extraction_id', array('value' => $extraction_id));
		echo $this->Form->input('description');
  ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Page Entities', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Page Entities', true), array('controller' => 'page_entities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page Entity', true), array('controller' => 'page_entities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Page Entity Fields', true), array('controller' => 'page_entity_fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page Entity Field', true), array('controller' => 'page_entity_fields', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="related">
	<h2><?php  __('Extraction Brief');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($extraction['Extraction']['name'], array('controller' => 'extractions', 
				'action' => 'view', $this->Form->value('Extraction.id')));?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $extraction['Extraction']['status']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
