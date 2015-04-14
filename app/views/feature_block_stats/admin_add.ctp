<?php echo $this->element('page_entities/subnav') ?>

<div class="featureBlockStats form">
<?php echo $this->Form->create('FeatureBlockStat');?>
	<fieldset>
 		<legend><?php __('Admin Add Feature Block Stat'); ?></legend>
	<?php
		echo $this->Form->input('domain');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('features');
		echo $this->Form->input('extract_feature_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Feature Block Stats', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Extract Features', true), array('controller' => 'extract_features', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Extract Feature', true), array('controller' => 'extract_features', 'action' => 'add')); ?> </li>
	</ul>
</div>