<div class="crawlFilters view movable">
<h2><?php  __('Crawl Filter');?></h2>
  <dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $crawlFilter['CrawlFilter']['id']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Page Type'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $crawlFilter['CrawlFilter']['page_type']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url Filter'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <pre><?php echo $crawlFilter['CrawlFilter']['url_filter']; ?></pre>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Text Filter'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <pre><?php echo $crawlFilter['CrawlFilter']['text_filter']; ?></pre>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parse Block Filter'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <pre><?php echo $crawlFilter['CrawlFilter']['block_filter']; ?></pre>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Crawl'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $this->Html->link($crawlFilter['Crawl']['name'], array('controller' => 'crawls', 'action' => 'view', $crawlFilter['Crawl']['id'])); ?>
      &nbsp;
    </dd>
  </dl>
</div>
<div class="actions">
  <h3><?php __('Actions'); ?></h3>
  <ul>
    <li><?php echo $this->Html->link(__('View Crawl', true), array('controller' => 'crawls', 'action' => 'view', $crawlFilter['Crawl']['id'])); ?> </li>
    <li><?php echo $this->Html->link(__('Edit Crawl Filter', true), array('action' => 'edit', $crawlFilter['CrawlFilter']['id'])); ?> </li>
    <li><?php echo $this->Html->link(__('Delete Crawl Filter', true), array('action' => 'delete', $crawlFilter['CrawlFilter']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $crawlFilter['CrawlFilter']['id'])); ?> </li>
  </ul>
</div>
