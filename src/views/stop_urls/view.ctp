<div class="stopUrls view">
<h2><?php  __('Stop Url');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $stopUrl['StopUrl']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $stopUrl['StopUrl']['url']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Forbidden Point'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $stopUrl['StopUrl']['forbidden_point']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Crawl'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($stopUrl['Crawl']['name'], array('controller' => 'crawls', 'action' => 'view', $stopUrl['Crawl']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($stopUrl['User']['name'], array('controller' => 'users', 'action' => 'view', $stopUrl['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Stop Url', true), array('action' => 'edit', $stopUrl['StopUrl']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Stop Url', true), array('action' => 'delete', $stopUrl['StopUrl']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $stopUrl['StopUrl']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Stop Urls', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stop Url', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
