<div class="dashboards index">
	<h2><?php __('格物，齐物，用物'); ?></h2>
</div>

<br />
<br />

<div class="actions">
	<ul class='larger'>
		<li><?php echo $this->Html->link(__('简单任务向导', true), array('controller' => 'crawls', 'action' => 'analysis'), array('target' => '_blank')); ?></li>
	</ul>
</div>

<br />

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('创建网络实体集', true), array('controller' => 'crawls', 'action' => 'addWes'), array('target' => '_blank')); ?></li>
		<li><?php echo $this->Html->link(__('创建通用爬虫任务', true), array('controller' => 'crawls', 'action' => 'add'), array('target' => '_blank')); ?></li>
	</ul>
</div>

<br />
<hr />
<br />

<div class="crawls index">
	<h2><?php __('Crawls');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Rounds</th>
			<th>Finished Rounds</th>
			<th>Limit</th>
			<th>State</th>
			<th>Config Id</th>
			<th>Created</th>
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
		<td><?php echo $crawl['Crawl']['finished_rounds']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['limit']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['state']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['configId']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('controller' => 'crawls', 'action' => 'view', $crawl['Crawl']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('controller' => 'crawls', 'action' => 'edit', $crawl['Crawl']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
  <?php echo $this->Html->link(__('More >>', true), array('controller' => 'crawls')); ?>
</div>

<br />

<div class="pageEntities index">
	<h2><?php __('Page Entities');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Block Path</th>
			<th>Status</th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php 
	$i = 0;
	foreach ($pageEntities as $pageEntity):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $pageEntity['PageEntity']['id']; ?>&nbsp;</td>
		<td><?php echo $pageEntity['PageEntity']['name']; ?>&nbsp;</td>
		<td><?php echo $pageEntity['PageEntity']['block_path']; ?>&nbsp;</td>
		<td><?php echo $pageEntity['PageEntity']['status']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $pageEntity['PageEntity']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $pageEntity['PageEntity']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $pageEntity['PageEntity']['id']),
						null, sprintf(__('Are you sure you want to delete # %s?', true), $pageEntity['PageEntity']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
  <?php echo $this->Html->link(__('More >>', true), array('controller' => 'page_entities')); ?>
</div>

<br />

<div class="actions">
	<h3><?php __('工具'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('测试爬虫解析器', true), array('controller' => 'nutch_jobs', 'action' => 'parseChecker'), array('target' => '_blank')); ?></li>
		<li><?php echo $this->Html->link(__('测试链接过滤器', true), array('controller' => 'nutch_jobs', 'action' => 'urlFilterChecker'), array('target' => '_blank')); ?></li>
		<li><?php echo $this->Html->link(__('生成正则表达式', true), array('controller' => 'common', 'action' => 'regexGenerator'), array('target' => '_blank')); ?></li>
		<li><?php echo $this->Html->link(__('测试正则表达式', true), array('controller' => 'pages', 'action' => 'regexpal'), array('target' => '_blank')); ?></li>
	</ul>
</div>
