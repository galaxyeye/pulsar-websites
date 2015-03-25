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
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Args'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scentJob['ScentJob']['args']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('State'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scentJob['ScentJob']['state']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Msg'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $scentJob['ScentJob']['msg']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Raw Msg'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<pre class='json'><?php echo $scentJob['ScentJob']['raw_msg']; ?></pre>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Results'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<pre class='json'><?php echo $scentJob['ScentJob']['results']; ?></pre>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Page Entity'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($scentJob['PageEntity']['name'],
					array('controller' => 'page_entities', 'action' => 'view', $scentJob['PageEntity']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li class="view-extract-result hidden"><?php echo $this->Html->link(__('View Extract Result', true), 
				array('action' => 'viewExtractResult', $scentJob['ScentJob']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Scent Jobs', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('View Page Entity', true),
					array('controller' => 'page_entities', 'action' => 'view', $scentJob['PageEntity']['id'])); ?>
    </li>
	</ul>
</div>

<div class="scentJobs related">
  <h3>抽取结果</h3>
  <ol id="sqlList" class='decimal'>
  </ol>
</div>

<div class="scentJobs view">
	<h3><?php  __('数据挖掘服务器实时消息');?></h3>

	<div id="jobInfo"></div>
</div>

<div id="jobInfoRaw" class="scentJobs view">
	<h3><?php  __('数据挖掘服务器原始消息');?></h3>
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

<script type="text/x-jsrender" id="sqlListTemplate">
  <li>{{:#data}}</li>
</script>
