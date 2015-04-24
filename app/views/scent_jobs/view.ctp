<?php echo $this->element('jobs/subnav') ?>

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
    <li><?php echo $this->Html->link(__('List Scent Jobs', true), array('action' => 'index')); ?></li>
    <li><?php echo $this->Html->link(__('View Page Entity', true),
          array('controller' => 'page_entities', 'action' => 'view', $scentJob['ScentJob']['page_entity_id'])); ?>
    </li>
  </ul>
</div>

<div id="mingingResult" class="scentJobs related">
  <h2>Minging Result</h2>
  <div>Processed <span class='extract-count'>0</span> Web Pages</div>
  <ul>
    <li>
    <?php 
        echo $this->Html->link(__('View Minging Results', true),
        	['controller' => 'storage_page_entities', '?' => ['regex' => $scentJob['PageEntity']['url_filter']]]
    		);
    ?>
    </li>
  </ul>
</div>

<div class="scentJobs view">
  <h3><?php  __('Minging Server Message');?></h3>
  <pre id="jobInfoRaw"></pre>
</div>

<script type="text/javascript">
<!--
  var scentJob = <?= json_encode($scentJob) ?>;
//-->
</script>

<script type="text/x-jsrender" id="sqlListTemplate">
  <li>{{:#data}}</li>
</script>
