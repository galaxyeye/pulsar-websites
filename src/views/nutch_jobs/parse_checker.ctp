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
	<h2><?php __('Parse Result');?></h2>

	<div>
		<h3><?php __('Passed Links');?></h3>
		<div><pre id="outlinks"></pre></div>
	</div>
	<hr />
	<div>
		<h3><?php __('Discarded Links');?></h3>
		<div><pre id="discardOutlinks"></pre></div>
	</div>
	<hr />
	<div>
		<h3><?php __('Text');?></h3>
		<div id="parseText"></div>
	</div>
	<hr />
	<div>
		<h3><?php __('Nutch Configuration');?></h3>
		<div id="nutchConfig">
			<pre>
				<?php pr($nutchConfig) ?>
		  </pre>
		</div>
	</div>
</div>

<div class="actions">
	<h3><?php __('Tools'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('测试链接过滤器', true), array('controller' => 'nutch_jobs', 'action' => 'urlFilterChecker'), array('target' => '_blank')); ?></li>
		<li><?php echo $this->Html->link(__('生成正则表达式', true), array('controller' => 'common', 'action' => 'regexGenerator'), array('target' => '_blank')); ?></li>
		<li><?php echo $this->Html->link(__('测试正则表达式', true), array('controller' => 'pages', 'action' => 'regexpal'), array('target' => '_blank')); ?></li>
	</ul>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
  <ul>
    <li><?=$this->Html->link(__('List Nutch Jobs', true), array('action' => 'index')); ?> </li>
    <li><?=$this->Html->link(__('List Active Jobs', true), array('action' => 'activeJobs')); ?> </li>
    <li><?=$this->Html->link(__('List Active Jobs（Plain View）', true), array('action' => 'plainActiveJobs')); ?> </li>
  </ul>
</div>
