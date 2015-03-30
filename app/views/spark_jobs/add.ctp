<div class="sparkJobs form">
<?php echo $this->Form->create('SparkJob');?>
	<fieldset>
 		<legend><?php __('Add Spark Job'); ?></legend>
	<?php
		echo $this->Form->input('jobId');
		echo $this->Form->input('type');
		echo $this->Form->input('args');
		echo $this->Form->input('state');
		echo $this->Form->input('msg');
		echo $this->Form->input('raw_msg');
		echo $this->Form->input('crawl_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Spark Jobs', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>