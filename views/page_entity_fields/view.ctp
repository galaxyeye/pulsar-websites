<div class="pageEntityFields view">
<h2><?php  __('Page Entity Field');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pageEntityField['PageEntityField']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pageEntityField['PageEntityField']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pageEntityField['PageEntityField']['desc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Extractor Class'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pageEntityField['PageEntityField']['extractor_class']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Css Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pageEntityField['PageEntityField']['css_path']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Text Extract Regex'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pageEntityField['PageEntityField']['text_extract_regex']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Text Validate Regex'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pageEntityField['PageEntityField']['text_validate_regex']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sql Data Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pageEntityField['PageEntityField']['sql_data_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Page Entity'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($pageEntityField['PageEntity']['name'], array('controller' => 'page_entities', 'action' => 'view', $pageEntityField['PageEntity']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Page Entity Field', true), array('action' => 'edit', $pageEntityField['PageEntityField']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Page Entity Field', true), array('action' => 'delete', $pageEntityField['PageEntityField']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pageEntityField['PageEntityField']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Page Entity Fields', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page Entity Field', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Page Entities', true), array('controller' => 'page_entities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Page Entity', true), array('controller' => 'page_entities', 'action' => 'add')); ?> </li>
	</ul>
</div>
