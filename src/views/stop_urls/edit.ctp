<div class="stopUrls form">
<?php echo $this->Form->create('StopUrl');?>
	<fieldset>
 		<legend><?php __('Edit Stop Url'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('url');
		echo $this->Form->input('forbidden_point');
		echo $this->Form->input('crawl_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('StopUrl.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('StopUrl.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Stop Urls', true), array('action' => 'index'));?></li>
	</ul>
</div>