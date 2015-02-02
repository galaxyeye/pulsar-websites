<div class="seedLists form">
<?php echo $this->Form->create('SeedList');?>
	<fieldset>
 		<legend><?php __('Edit Seed List'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('name');
		echo $this->Form->input('desc');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('SeedList.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('SeedList.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Seed Lists', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seeds', true), array('controller' => 'seeds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seed', true), array('controller' => 'seeds', 'action' => 'add')); ?> </li>
	</ul>
</div>