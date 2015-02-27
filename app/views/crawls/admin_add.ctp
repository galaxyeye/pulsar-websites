<div class="crawls form">
<?php echo $this->Form->create('Crawl');?>
	<fieldset>
 		<legend><?php __('Admin Add Crawl'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('round');
		echo $this->Form->input('batchid');
		echo $this->Form->input('phrase');
		echo $this->Form->input('status');
		echo $this->Form->input('user_id');
		echo $this->Form->input('finished');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Crawls', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Crawl Filters', true), array('controller' => 'crawl_filters', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl Filter', true), array('controller' => 'crawl_filters', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seeds', true), array('controller' => 'seeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seed', true), array('controller' => 'seeds', 'action' => 'add')); ?> </li>
	</ul>
</div>