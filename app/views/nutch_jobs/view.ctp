<div class="nutchJobs view">
<h2><?php  __('Nutch Job');?></h2>
  <dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['NutchJob']['id']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Round'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['NutchJob']['round']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('CrawlId'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['NutchJob']['crawlId']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ConfId'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['NutchJob']['confId']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('BatchId'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['NutchJob']['batchId']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('JobId'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['NutchJob']['jobId']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['NutchJob']['type']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Args'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['NutchJob']['args']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('State'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['NutchJob']['state']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Msg'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['NutchJob']['msg']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Raw Msg'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php 
        $rawMsg = strip_tags($nutchJob['NutchJob']['raw_msg']);
        $rawMsg = json_decode($rawMsg,true);
      	$rawMsg = json_encode($rawMsg, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
      ?>
      <pre><?php echo $rawMsg ?></pre>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Crawl'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $this->Html->link($nutchJob['Crawl']['name'], array('controller' => 'crawls', 'action' => 'view', $nutchJob['Crawl']['id'])); ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['NutchJob']['created']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['NutchJob']['modified']; ?>
      &nbsp;
    </dd>
  </dl>
</div>

<div class="nutch server view">
  <h3><?php  __('爬虫服务器消息');?></h3>

  <div id="jobInfo"></div>
</div>

<div class="actions">
  <ul>
    <li><?=$this->Html->link(__('List Nutch Jobs', true), array('action' => 'index')); ?> </li>
    <li><?=$this->Html->link(__('List Active Jobs', true), array('action' => 'activeJobs')); ?> </li>
    <li><?=$this->Html->link(__('List Active Jobs（Plain View）', true), array('action' => 'plainActiveJobs')); ?> </li>
    <li><?=$this->Html->link(__('View Nutch Config', true), array('action' => 'nutchConfig', $nutchJob['NutchJob']['confId'])); ?> </li>
  </ul>
</div>
