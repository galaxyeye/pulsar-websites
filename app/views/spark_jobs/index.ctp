<?php echo $this->element('jobs/subnav') ?>

<div class="sparkJobs index">
	<h2><?php __('Spark Jobs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('jobId');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('args');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('msg');?></th>
			<th><?php echo $this->Paginator->sort('raw_msg');?></th>
			<th><?php echo $this->Paginator->sort('crawl_id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($sparkJobs as $sparkJob):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $sparkJob['SparkJob']['id']; ?>&nbsp;</td>
		<td><?php echo $sparkJob['SparkJob']['jobId']; ?>&nbsp;</td>
		<td><?php echo $sparkJob['SparkJob']['type']; ?>&nbsp;</td>
		<td><?php echo $sparkJob['SparkJob']['args']; ?>&nbsp;</td>
		<td><?php echo $sparkJob['SparkJob']['state']; ?>&nbsp;</td>
		<td><?php echo $sparkJob['SparkJob']['msg']; ?>&nbsp;</td>
		<td><?php echo $sparkJob['SparkJob']['raw_msg']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($sparkJob['Crawl']['name'], array('controller' => 'crawls', 'action' => 'view', $sparkJob['Crawl']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($sparkJob['User']['name'], array('controller' => 'users', 'action' => 'view', $sparkJob['User']['id'])); ?>
		</td>
		<td><?php echo $sparkJob['SparkJob']['created']; ?>&nbsp;</td>
		<td><?php echo $sparkJob['SparkJob']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $sparkJob['SparkJob']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $sparkJob['SparkJob']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $sparkJob['SparkJob']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sparkJob['SparkJob']['id'])); ?>
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
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Spark Job', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>