<div class="ontologies view">
<h2><?php  __('Ontology');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ontology['Ontology']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ontology['Ontology']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ontology', true), array('action' => 'edit', $ontology['Ontology']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Ontology', true), array('action' => 'delete', $ontology['Ontology']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ontology['Ontology']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ontologies', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ontology', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
