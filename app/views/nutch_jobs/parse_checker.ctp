<div class="nutchJobs view">
<h2><?php  __('任务概要');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<span class='model-id'><?php echo $crawl['Crawl']['id']; ?></span>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Crawl Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Seed'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Seed'][0]['url']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Config Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['configId']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nutch Job Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<span id='NutchJobJobId'><?php echo $jobId; ?></span>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="nutchJobs view">
	<h2><?php __('解析结果');?></h2>

	<div>
		<h3><?php __('符合条件的链接');?></h3>
		<div><pre id="outlinks"></pre></div>
	</div>
	<hr />
	<div>
		<h3><?php __('被过滤的链接');?></h3>
		<div><pre id="discardOutlinks"></pre></div>
	</div>
	<hr />
	<div>
		<h3><?php __('文本');?></h3>
		<div id="parseText"></div>
	</div>
	<hr />
	<div>
		<h3><?php __('配置');?></h3>
		<div id="nutchConfig">
			<pre>
				<?php pr($nutchConfig) ?>
		  </pre>
		</div>
	</div>
</div>

<div class="actions">
	<h3><?php __('工具'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('测试爬虫解析器', true), array('controller' => 'nutch_jobs', 'action' => 'parseChecker'), array('target' => '_blank')); ?></li>
		<li><?php echo $this->Html->link(__('测试链接过滤器', true), array('controller' => 'nutch_jobs', 'action' => 'urlFilterChecker'), array('target' => '_blank')); ?></li>
		<li><?php echo $this->Html->link(__('生成正则表达式', true), array('controller' => 'common', 'action' => 'regexGenerator'), array('target' => '_blank')); ?></li>
		<li><?php echo $this->Html->link(__('测试正则表达式', true), array('controller' => 'pages', 'action' => 'regexpal'), array('target' => '_blank')); ?></li>
	</ul>
</div>

<div class="actions">
  <ul>
    <li><?=$this->Html->link(__('List Nutch Jobs', true), array('action' => 'index')); ?> </li>
    <li><?=$this->Html->link(__('List Active Jobs', true), array('action' => 'activeJobs')); ?> </li>
    <li><?=$this->Html->link(__('List Active Jobs（Plain View）', true), array('action' => 'plainActiveJobs')); ?> </li>
  </ul>
</div>
