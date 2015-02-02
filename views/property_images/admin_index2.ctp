<?php $this->layout = 'blank' ?>

<div class="apartmentImages index">
<h2><?php __('Property Images');?></h2>

 <div>
 	<?php 
 	$i = 0;
 	foreach ($propertyImages as $propertyImage):
 	?>
 	<span>
 	
		<?php echo $this->Html->link(
		   $this->Html->image($propertyImage['PropertyImage']['url'], array('class' => 'lazyLoad', 'width' => 300, 'height' => 175)), 
		   array('action' => 'view', $propertyImage['PropertyImage']['id']), 
		   array('escape' => false)); ?>
 		<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $propertyImage['PropertyImage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $propertyImage['PropertyImage']['id'])); ?>
 	</span> 
 	<?php endforeach; ?>
 </div>

	<p>
	<?php 
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
   |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List properties', true), array('controller' => 'properties', 'action' => 'index')); ?> </li>
	</ul>
</div>

<script type="text/javascript" src="/js/jquery/jquery.lazyload.pack.js"></script>
