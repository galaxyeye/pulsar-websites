<div class="humanActions form">
<?php echo $this->Form->create('HumanAction');?>
	<fieldset>
 		<legend><?php __('Edit Human Action'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('action');
		echo $this->Form->input('css_path');
		echo $this->Form->input('script');
		echo $this->Form->input('order');
		echo $this->Form->input('crawl_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('HumanAction.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('HumanAction.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Human Actions', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
	</ul>
</div>