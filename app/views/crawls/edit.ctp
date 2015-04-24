<?php echo $this->element('crawls/subnav') ?>

<div class="crawls form">
<?php echo $this->Form->create('Crawl');?>
	<fieldset>
 		<legend><?php __('Edit Crawl'); ?></legend>
	<?php 
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('disabled' => 'disabled'));
		echo $this->Form->input('round', array('disabled' => 'disabled'));
		echo $this->Form->input('batchid', array('disabled' => 'disabled'));
		echo $this->Form->input('crawl_phrase', array('disabled' => 'disabled'));
		echo $this->Form->input('task_status', array('disabled' => 'disabled'));
		echo $this->Form->input('finished', array('disabled' => 'disabled'));
		echo $this->Form->input('description');
  ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('View Crawl Status', true), array('action' => 'status', $this->data['Crawl']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('New Wes', true), array('action' => 'addWes'), array('target' => '_blank')); ?> </li>
		<li><?php echo $this->Html->link(__('View Crawl', true), array('action' => 'view', $this->data['Crawl']['id'])); ?> </li>
	</ul>
</div>
