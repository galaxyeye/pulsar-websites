<div class="nutchJobs view">
<h2><?php  __('Active Nutch Job');?></h2>
  <dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['id']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['type']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('ConfId'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['confId']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('State'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['state']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Msg'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $nutchJob['msg']; ?>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Args'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <pre><?php echo json_encode($nutchJob['args'], JSON_PRETTY_PRINT) ?></pre>
      &nbsp;
    </dd>
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Result'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <pre><?php echo json_encode($nutchJob['result'], JSON_PRETTY_PRINT) ?></pre>
      &nbsp;
    </dd>
  </dl>
</div>

<div class="actions">
  <ul>
    <li><?=$this->Html->link(__('List Nutch Jobs', true), array('action' => 'index')); ?> </li>
    <li><?=$this->Html->link(__('List Active Jobs', true), array('action' => 'activeJobs')); ?> </li>
    <li><?=$this->Html->link(__('List Active Jobs（Plain View）', true), array('action' => 'plainActiveJobs')); ?> </li>
  </ul>
</div>
