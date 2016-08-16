<div class="horizon-nav2">
  <ul>
      <li>
        <?php echo $this->Html->link(__('Nutch Jobs', true), array('controller' => 'nutch_jobs', 'action' => 'index')); ?>
      </li>
      <li>
        <?php echo $this->Html->link(__('Scent Jobs', true), array('controller' => 'scent_jobs', 'action' => 'index')); ?>
      </li>
      <li>
        <?php echo $this->Html->link(__('Spark Jobs', true), array('controller' => 'spark_jobs', 'action' => 'index')); ?>
      </li>
  </ul>
</div>
