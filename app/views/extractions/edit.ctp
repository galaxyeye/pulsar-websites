<div class="extractions form">
<?php echo $this->Form->create('Extraction');?>
	<fieldset>
 		<legend><?php __('Edit Extraction'); ?></legend>
	<?php 

		$m = array(
				'name' => 'Extraction name',
				'url_pattern' => 'Extract pages only match this regex pattern',
				'text_pattern' => 'Extract the pages whose text matches this regex pattern',
		);

		echo $this->Form->input('id');
		echo $this->Form->input('name');
		// echo $this->Form->input('domain_pattern');
		echo $this->Form->input('url_pattern');
		echo $this->Form->input('text_pattern');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Extractions', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('View Extraction', true), array('action' => 'view', $this->data['Extraction']['id']));?></li>
	</ul>
</div>