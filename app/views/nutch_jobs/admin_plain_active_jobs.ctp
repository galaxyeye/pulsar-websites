<?php $this->layout = 'blank' ?>

<div class="nutchJobs index">
  <h2><?php __('Nutch Jobs');?></h2>
  <div>
  <?php 
  foreach ($nutchJobs as $nutchJob) {
  	pr($nutchJob);
  	echo "<br /><hr /><br />";
  }
  ?>
  </div>
  
	<div class="actions">
	  <ul>
	    <li><?=$this->Html->link(__('List Nutch Jobs', true), array('action' => 'index')); ?> </li>
	    <li><?=$this->Html->link(__('List Active Jobs', true), array('action' => 'activeJobs')); ?> </li>
	    <li><?=$this->Html->link(__('List Active Jobs（Plain View）', true), array('action' => 'plainActiveJobs')); ?> </li>
	  </ul>
	</div>

</div>
