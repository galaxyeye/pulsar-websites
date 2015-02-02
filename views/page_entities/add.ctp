<div class="pageEntities form">
<?php echo $this->Form->create('PageEntity');?>
	<fieldset>
 		<legend><?php __('Add Page Entity'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('desc');
		echo $this->Form->input('domain');
		echo $this->Form->input('url_pattern');
		echo $this->Form->input('page_entity_id');
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