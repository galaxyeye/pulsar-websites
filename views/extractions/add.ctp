<div class="extractions form">
<?php echo $this->Form->create('Extraction');?>
	<fieldset>
 		<legend><?php __('Add Extraction'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('crawlid');
		echo $this->Form->input('desc');
		echo $this->Form->input('domain');
		echo $this->Form->input('url_pattern');
		echo $this->Form->input('text_pattern');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Extractions', true), array('action' => 'index'));?></li>
	</ul>
</div>