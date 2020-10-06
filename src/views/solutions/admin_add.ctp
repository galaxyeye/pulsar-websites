<div class="solutions form">
<?php echo $this->Form->create('Solution');?>
	<fieldset>
 		<legend><?php __('Admin Add Solution'); ?></legend>
	<?php
		echo $this->Form->input('symbol');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Solutions', true), array('action' => 'index'));?></li>
	</ul>
</div>