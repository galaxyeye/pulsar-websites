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
			<span id='finishedRounds'><?php echo $crawl['Crawl']['finished_rounds']; ?></span>
			&nbsp;
		</dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('State'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['state']; ?>
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

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('View Crawl', true), array('action' => 'view', $crawl['Crawl']['id'])); ?> </li>
	</ul>
</div>

<div class="crawls view js-view">
	<h3><?php  __('爬虫服务器消息');?></h3>

	<div id="jobInfo"></div>
</div>

<div id="jobException" class="crawls view js-view">
	<h3><?php  __('异常');?></h3>
	<pre></pre>
</div>

<div id="jobInfoRaw" class="crawls view js-view raw">
	<h3><?php  __('爬虫服务器原始消息');?></h3>
	<pre></pre>
</div>

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

<script type="text/x-jsrender" id="jobExceptionTemplate">
	<h4>异常消息</h4>
	<dl>
		<dt>exception</dt>
		<dd>{{:exception}}</dd>
		<dt>message</dt>
		<dd>{{:message}}</dd>
		<dt>stackTrace</dt>
		<dd>{{:stackTrace}}</dd>
	</dl>
	<hr/>
</script>
