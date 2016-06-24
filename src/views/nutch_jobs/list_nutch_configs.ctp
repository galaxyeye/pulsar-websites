<?php echo $this->element('jobs/subnav') ?>

<div class="actions">
  <ul>
    <li><?=$this->Html->link(__('List Active Jobs', true), array('action' => 'activeJobs')); ?> </li>
    <li><?=$this->Html->link(__('List Active Jobs（Plain View）', true), array('action' => 'plainActiveJobs')); ?> </li>
  </ul>
</div>

<div class="nutchConfigs index">
  <ul>
    <?php foreach ($nutchConfigs as $nutchConfig) : ?>
    <li><?=$this->Html->link($nutchConfig, array('action' => 'nutchConfig', $nutchConfig)); ?></li>
    <?php endforeach; ?>
  </ul>
</div>
