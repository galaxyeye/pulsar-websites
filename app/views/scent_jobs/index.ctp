<div class="actions">
  <ul>
      <li>
        <a href="<?php echo Router::url('/nutch_jobs') ?>">nutch jobs</a>
      </li>
      <li>
        <a href="<?php echo Router::url('/scent_jobs') ?>">scent jobs</a>
      </li>
      <li>
        <a href="<?php echo Router::url('/spark_jobs') ?>">spark jobs</a>
      </li>
  </ul>
</div>

<div class="scentJobs index">
	<h2><?php __('Scent Jobs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('jobId');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('configId');?></th>
			<th><?php echo $this->Paginator->sort('crawlId');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('page_entity_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($scentJobs as $scentJob):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $scentJob['ScentJob']['id']; ?>&nbsp;</td>
		<td><?php echo $scentJob['ScentJob']['jobId']; ?>&nbsp;</td>
		<td><?php echo $scentJob['ScentJob']['type']; ?>&nbsp;</td>
		<td><?php echo $scentJob['ScentJob']['configId']; ?>&nbsp;</td>
		<td><?php echo $scentJob['ScentJob']['crawlId']; ?>&nbsp;</td>
		<td><?php echo $scentJob['ScentJob']['state']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($scentJob['PageEntity']['name'], array('controller' => 'page_entities', 'action' => 'view', $scentJob['PageEntity']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $scentJob['ScentJob']['id'])); ?>
		</td>
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
