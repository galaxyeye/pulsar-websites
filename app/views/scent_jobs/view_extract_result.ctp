<div class="scentJobs view">
<h2><?php  __('Scent Job');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<span class='model-id'><?php echo $scentJob['ScentJob']['id']; ?></span>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('JobId'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scentJob['ScentJob']['jobId']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scentJob['ScentJob']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ConfigId'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scentJob['ScentJob']['configId']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('CrawlId'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scentJob['ScentJob']['crawlId']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('State'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scentJob['ScentJob']['state']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Download Sql File', true), 
				array('action' => 'downloadExtractResult', $scentJob['ScentJob']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('View Page Entity', true),
					array('controller' => 'page_entities', 'action' => 'view', $scentJob['PageEntity']['id'])); ?>
    </li>
	</ul>
</div>

<div class="scentJobs view">
	<ol class='decimal'>
	<?php foreach ($sqls as $sql) : ?>
	<li><?php echo $sql ?></li>
	<?php endforeach; ?>
	</ol>
</div>
