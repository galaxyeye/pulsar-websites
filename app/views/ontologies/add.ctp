<div class="ontologies form">
<?php echo $this->Form->create('Ontology');?>
	<fieldset>
 		<legend><?php __('Add Ontology'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Ontologies', true), array('action' => 'index'));?></li>
	</ul>
</div>