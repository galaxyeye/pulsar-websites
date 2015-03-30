<!---------------------------------------------------------->
<!-- 第三步：启动爬虫 -->
<!---------------------------------------------------------->
<div class="crawls analysis step-3 view">
	<h2>
		<span><?php  __('爬虫配置概要');?></span>
	</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
      <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<span class='model-id'><?php echo $crawl['Crawl']['id']; ?></span>
			&nbsp;
		</dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
        <?php echo $crawl['Crawl']['name']; ?>
        &nbsp;
      </dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Seed'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
        <?php echo $crawl['Seed'][0]['url']; ?>
        &nbsp;
      </dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Index Url Pattern'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
        <?php echo $crawl['CrawlFilter'][0]['url_filter']; ?>
        &nbsp;
      </dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Detail Url Pattern'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
        <?php echo $crawl['CrawlFilter'][1]['url_filter']; ?>
        &nbsp;
      </dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Config Id'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
        <?php echo $crawl['Crawl']['configId']; ?>
        &nbsp;
      </dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Rounds'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
        <?php echo $crawl['Crawl']['rounds']; ?>
        &nbsp;
      </dd>
	</dl>
</div>

<?php if (empty($crawl['Crawl']['configId'])) : ?>
<div class="crawls form">
    <?php echo $this->Form->create('Crawl', array('action' => 'startCrawl'));?>
      <fieldset>
		<legend><?php __('Start This Crawl'); ?></legend>
      <?php
	echo $this->Form->input ( 'id', array (
			'value' => $crawl ['Crawl'] ['id'] 
	) );
	echo $this->Form->hidden ( 'Ui.analysis', array (
			'value' => 'analysis' 
	) );
	?>
  <?php echo $this->Form->end(__('Start Crawl', true));?>
  </fieldset>
</div>
<?php endif; ?>
