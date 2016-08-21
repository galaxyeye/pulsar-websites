<div class="topics form">
<?php echo $this->Form->create('Topic');?>
	<fieldset>
 		<legend><?php __('Add Topic'); ?></legend>
	<?php
		echo $this->Form->input('category');
		echo $this->Form->input('name');
		echo $this->Form->input('expression', ['rows' => 20]);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Topics', true), array('action' => 'index'));?></li>
	</ul>
</div>
