<script type="text/x-jsrender" id="jobInfoTemplate">
	<h4>任务配置</h4>
	<dl>
		{{props}}
		<dt>{{>key}}</dt>
		<dd>
			{{>prop}}			&nbsp;
		</dd>
		{{/props}}
	</dl>
	<hr/>

	<h4>任务参数</h4>
	<dl>
		{{props args}}
		<dt>{{>key}}</dt>
		<dd>
			{{>prop}}			&nbsp;
		</dd>
		{{/props}}
	</dl>

</script>

<div class="crawls view">
<h2><?php  __('爬虫任务状态');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<span class='model-id'><?php echo $crawl['Crawl']['id']; ?></span>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rounds'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['rounds']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Finished Rounds'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['finished_rounds']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Finished'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['finished']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="crawls view">
	<h3><?php  __('爬虫服务器实时消息');?></h3>

	<div id="jobInfo"></div>
</div>

<div id="jobInfoRaw" class="crawls view">
	<h3><?php  __('爬虫服务器原始消息');?></h3>
	<pre></pre>
</div>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('View Crawl', true), array('action' => 'view', $crawl['Crawl']['id'])); ?> </li>
	</ul>
</div>
