<div class="crawls form">
<?php echo $this->Form->create('Crawl');?>
	<fieldset>
 		<legend><?php __('Admin Edit Crawl'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('round');
		echo $this->Form->input('batchid');
		echo $this->Form->input('phrase');
		echo $this->Form->input('status');
		echo $this->Form->input('user_id');
		echo $this->Form->input('finished');
		echo $this->Form->input('description');
  ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Crawl.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Crawl.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Crawl Filters', true), array('controller' => 'crawl_filters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl Filter', true), array('controller' => 'crawl_filters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seeds', true), array('controller' => 'seeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seed', true), array('controller' => 'seeds', 'action' => 'add')); ?> </li>
	</ul>
</div>