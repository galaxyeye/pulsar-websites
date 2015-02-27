<div class="pageEntities form">
<?php echo $this->Form->create('PageEntity');?>
	<fieldset>
 		<legend>
 			<?php __('Edit Page Entity'); ?>
 		</legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('url_pattern');
		echo $this->Form->input('text_pattern');
		echo $this->Form->input('css_path');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('View', true), array('action' => 'view', $this->Form->value('PageEntity.id')));?></li>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('PageEntity.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('PageEntity.id'))); ?></li>
  </ul>
</div>

<div class="related">
	<h2><?php  __('Extraction Brief');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($this->data['Extraction']['name'], array('controller' => 'extractions', 
				'action' => 'view', $this->Form->value('Extraction.id')));?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->data['Extraction']['status']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
