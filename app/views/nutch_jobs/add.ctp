<div class="nutchJobs form">
<?php echo $this->Form->create('NutchJob');?>
	<fieldset>
 		<legend><?php __('Add Nutch Job'); ?></legend>
	<?php
		echo $this->Form->input('jobId');
		echo $this->Form->input('type');
		echo $this->Form->input('confId');
		echo $this->Form->input('args');
		echo $this->Form->input('state');
		echo $this->Form->input('msg');
		echo $this->Form->input('crawlId');
		echo $this->Form->input('result');
		echo $this->Form->input('crawl_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Nutch Jobs', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>