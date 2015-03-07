<div class="actions">
	<h3><?php __('创建任务'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('创建网络实体集', true), array('controller' => 'crawls', 'action' => 'add_wes')); ?></li>
		<li><?php echo $this->Html->link(__('创建通用爬虫任务', true), array('controller' => 'crawls', 'action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('创建信息抽取任务', true), array('controller' => 'extractions', 'action' => 'add')); ?></li>
	</ul>
</div>

<div class="actions">
	<h3><?php __('工具'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('测试解析器', true), array('controller' => 'nutch_jobs', 'action' => 'parseChecker'), array('target' => '_blank')); ?></li>
		<li><?php echo $this->Html->link(__('测试链接过滤器', true), array('controller' => 'nutch_jobs', 'action' => 'urlFilterChecker'), array('target' => '_blank')); ?></li>
		<li><?php echo $this->Html->link(__('测试正则表达式', true), array('controller' => 'pages', 'action' => 'regexpal'), array('target' => '_blank')); ?></li>
	</ul>
</div>

<div class="crawls index">
	<h2><?php __('Crawls');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>id</th>
			<th>name</th>
			<th>rounds</th>
			<th>created</th>
			<th>finished</th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php 
	$i = 0;
	foreach ($crawls as $crawl):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $crawl['Crawl']['id']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['name']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['rounds']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['created']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['finished']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('controller' => 'crawls', 'action' => 'view', $crawl['Crawl']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('controller' => 'crawls', 'action' => 'edit', $crawl['Crawl']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>

<div class="extractions index">
	<h2><?php __('Extractions');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>id</th>
			<th>name</th>
			<th>status</th>
			<th>created</th>
			<th>finished</th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($extractions as $extraction):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $extraction['Extraction']['id']; ?>&nbsp;</td>
		<td><?php echo $extraction['Extraction']['name']; ?>&nbsp;</td>
		<td><?php echo $extraction['Extraction']['status']; ?>&nbsp;</td>
		<td><?php echo $extraction['Extraction']['created']; ?>&nbsp;</td>
		<td><?php echo $extraction['Extraction']['finished']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('controller' => 'extractions', 'action' => 'view', $extraction['Extraction']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('controller' => 'extractions', 'action' => 'edit', $extraction['Extraction']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
