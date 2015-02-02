<div class="webpages form">
<?php echo $this->Form->create('Webpage');?>
	<fieldset>
 		<legend><?php __('Edit Webpage'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('domain');
		echo $this->Form->input('url');
		echo $this->Form->input('title');
		echo $this->Form->input('keywords');
		echo $this->Form->input('description');
		echo $this->Form->input('html');
		echo $this->Form->input('category_tags');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Webpage.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Webpage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Webpages', true), array('action' => 'index'));?></li>
	</ul>
</div>