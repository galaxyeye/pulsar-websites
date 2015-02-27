<div class="seeds index">
	<h2>
		<?php __('Seeds');?>
 		<?php echo " Of " ?>
 		<?php echo $this->Html->link($crawl['Crawl']['name'],
 					array('controller' => 'crawls', 'action' => 'view', $crawl['Crawl']['id'])); ?>
	</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($seeds as $seed):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $seed['Seed']['id']; ?>&nbsp;</td>
		<td><?php echo $seed['Seed']['url']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
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
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Seed', true), array('action' => 'add', 'crawl_id' => $crawl['Crawl']['id'])); ?></li>
	</ul>
</div>