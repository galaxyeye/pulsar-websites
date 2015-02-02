<div class="pageEntities view">
<h2><?php  __('Page Entity');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pageEntity['PageEntity']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pageEntity['PageEntity']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pageEntity['PageEntity']['desc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Domain'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pageEntity['PageEntity']['domain']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url Pattern'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pageEntity['PageEntity']['url_pattern']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Page Entity'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($pageEntity['PageEntity']['name'], array('controller' => 'page_entities', 'action' => 'view', $pageEntity['PageEntity']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Page Entity', true), array('action' => 'edit', $pageEntity['PageEntity']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Page Entity', true), array('action' => 'delete', $pageEntity['PageEntity']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pageEntity['PageEntity']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Page Entities', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page Entity', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Page Entities', true), array('controller' => 'page_entities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page Entity', true), array('controller' => 'page_entities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Page Entity Fields', true), array('controller' => 'page_entity_fields', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page Entity Field', true), array('controller' => 'page_entity_fields', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Page Entities');?></h3>
	<?php if (!empty($pageEntity['PageEntity'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Desc'); ?></th>
		<th><?php __('Domain'); ?></th>
		<th><?php __('Url Pattern'); ?></th>
		<th><?php __('Page Entity Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($pageEntity['PageEntity'] as $pageEntity):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $pageEntity['id'];?></td>
			<td><?php echo $pageEntity['name'];?></td>
			<td><?php echo $pageEntity['desc'];?></td>
			<td><?php echo $pageEntity['domain'];?></td>
			<td><?php echo $pageEntity['url_pattern'];?></td>
			<td><?php echo $pageEntity['page_entity_id'];?></td>
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
			<li><?php echo $this->Html->link(__('New Page Entity', true), array('controller' => 'page_entities', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Page Entity Fields');?></h3>
	<?php if (!empty($pageEntity['PageEntityField'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Desc'); ?></th>
		<th><?php __('Extractor Class'); ?></th>
		<th><?php __('Css Path'); ?></th>
		<th><?php __('Text Extract Regex'); ?></th>
		<th><?php __('Text Validate Regex'); ?></th>
		<th><?php __('Sql Data Type'); ?></th>
		<th><?php __('Page Entity Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($pageEntity['PageEntityField'] as $pageEntityField):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $pageEntityField['id'];?></td>
			<td><?php echo $pageEntityField['name'];?></td>
			<td><?php echo $pageEntityField['desc'];?></td>
			<td><?php echo $pageEntityField['extractor_class'];?></td>
			<td><?php echo $pageEntityField['css_path'];?></td>
			<td><?php echo $pageEntityField['text_extract_regex'];?></td>
			<td><?php echo $pageEntityField['text_validate_regex'];?></td>
			<td><?php echo $pageEntityField['sql_data_type'];?></td>
			<td><?php echo $pageEntityField['page_entity_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'page_entity_fields', 'action' => 'view', $pageEntityField['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'page_entity_fields', 'action' => 'edit', $pageEntityField['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'page_entity_fields', 'action' => 'delete', $pageEntityField['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pageEntityField['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Page Entity Field', true), array('controller' => 'page_entity_fields', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
