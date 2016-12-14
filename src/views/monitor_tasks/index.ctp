<?php $topicName = "全部主题" ?>

<nav class="two columns" id="actions-sidebar">
	<ul class="side-nav">
		<li class="heading"><a>日常监测</a></li>
		<?php foreach ($monitorTasks as $monitorTask) : ?>
			<li><?= $this->Html->link($monitorTask['MonitorTask']['name'], ['action' => 'view', $monitorTask['MonitorTask']['id']]) ?></li>
		<?php endforeach ?>
		
		<li class="heading"><a>话题追踪</a></li>
		<li class="heading"><a>评论分析</a></li>
		<li class="heading"><a>风险人群</a></li>
		<li class="heading"><a>收藏夹</a></li>
	</ul>
</nav>

<div class="topics ten columns content">

	<table cellpadding="0" cellspacing="0">
		<thead>
		<tr>
			<th>标题</th>
			<th>内容</th>
			<th>来源</th>
			<th class="actions">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($docs as $doc): ?>
			<tr>
				<?php if ($doc['provider'] === 'baidu') : ?>
					<td><?= $doc['title'] ?></td>
				<?php else : ?>
					<td><?= $this->Html->link(h($doc['title']), ['action' => 'quickView', symmetric_encode($doc['url'])]) ?></td>
				<?php endif ?>
				<td><?= $doc['shortContent'] ?></td>
				<td><?= $doc['provider'] ?></td>
				<td class="actions">
					<?= $this->Html->link("快照", ['action' => 'quickView', symmetric_encode($doc['url'])]) ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<div class="paginator">
		<p>
			<?php
			echo $this->Paginator->counter([
					'format' => __('当前第%page%页，共计%pages%页， 显示 %current% 条记录， 共计%count%条记录', true)
			]);
			?>
		</p>

		<div class="paging">
			<?php echo $this->Paginator->prev('<< ' . "上一页", [], null, array('class'=>'disabled'));?>
			| 	<?php echo $this->Paginator->numbers();?>
			|
			<?php echo $this->Paginator->next("下一页" . ' >>', [], null, array('class' => 'disabled'));?>
		</div>
	</div>
</div>

<?php // echo $this->element('search_syntax_help') ?>
