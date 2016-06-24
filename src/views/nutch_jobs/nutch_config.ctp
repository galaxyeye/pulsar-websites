<?php 
if ($raw) :
	$this->layout = 'blank';
	pr($nutchConfig);
else :
?>
<div class="nutch_jobs view">
	<div>
		<h3><?php __('配置');?></h3>
		<div id="nutchConfig">
			<pre>
				<?php pr($nutchConfig) ?>
		  </pre>
		</div>
	</div>
	
	<div class="actions">
	  <ul>
	    <li><?=$this->Html->link(__('List Nutch Jobs', true), array('action' => 'index')); ?> </li>
	    <li><?=$this->Html->link(__('List Active Jobs', true), array('action' => 'activeJobs')); ?> </li>
	    <li><?=$this->Html->link(__('List Active Jobs（Plain View）', true), array('action' => 'plainActiveJobs')); ?> </li>
	  </ul>
	</div>

</div>
<?php endif; ?>
