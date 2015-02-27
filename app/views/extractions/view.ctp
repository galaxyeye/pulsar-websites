<div class="extractions view">
<h2><?php  __('Extraction');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $extraction['Extraction']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $extraction['Extraction']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $extraction['Extraction']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $extraction['Extraction']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Finished'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $extraction['Extraction']['finished']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $extraction['Extraction']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Extraction', true), array('action' => 'edit', $extraction['Extraction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Extraction', true), array('action' => 'delete', $extraction['Extraction']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $extraction['Extraction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Extractions', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Extraction', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Page Entities');?></h3>
	<?php if (!empty($extraction['PageEntity'])): ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Url Pattern'); ?></th>
		<th><?php __('Text Pattern'); ?></th>
		<th><?php __('Css Path'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($extraction['PageEntity'] as $pageEntity):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $pageEntity['id'];?></td>
			<td><?php echo $pageEntity['name'];?></td>
			<td><?php echo $pageEntity['url_pattern'];?></td>
			<td><?php echo $pageEntity['text_pattern'];?></td>
			<td><?php echo $pageEntity['css_path'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'page_entities', 'action' => 'view', $pageEntity['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'page_entities', 'action' => 'edit', $pageEntity['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'page_entities', 'action' => 'delete', $pageEntity['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pageEntity['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Page Entity', true), array('controller' => 'page_entities', 'action' => 'add', 'extraction_id' => $extraction['Extraction']['id'])); ?> </li>
		</ul>
	</div>
</div>

<div class="extractions form">
<?php echo $this->Form->create('Extraction', array('action' => 'startExtraction'));?>
	<fieldset>
 		<legend><?php __('Start This Extraction'); ?></legend>
	<?php echo $this->Form->input('id'); ?>
	<?php echo $this->Form->end(__('Start Extraction', true));?>
	</fieldset>
</div>
