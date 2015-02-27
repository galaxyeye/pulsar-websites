<div class="nutchJobs index">
	<h2><?php __('Nutch Jobs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('jobId');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('confId');?></th>
			<th><?php echo $this->Paginator->sort('args');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('msg');?></th>
			<th><?php echo $this->Paginator->sort('crawlId');?></th>
			<th><?php echo $this->Paginator->sort('result');?></th>
			<th><?php echo $this->Paginator->sort('crawl_id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($nutchJobs as $nutchJob):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $nutchJob['NutchJob']['id']; ?>&nbsp;</td>
		<td><?php echo $nutchJob['NutchJob']['jobId']; ?>&nbsp;</td>
		<td><?php echo $nutchJob['NutchJob']['type']; ?>&nbsp;</td>
		<td><?php echo $nutchJob['NutchJob']['confId']; ?>&nbsp;</td>
		<td><?php echo $nutchJob['NutchJob']['args']; ?>&nbsp;</td>
		<td><?php echo $nutchJob['NutchJob']['state']; ?>&nbsp;</td>
		<td><?php echo $nutchJob['NutchJob']['msg']; ?>&nbsp;</td>
		<td><?php echo $nutchJob['NutchJob']['crawlId']; ?>&nbsp;</td>
		<td><?php echo $nutchJob['NutchJob']['result']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($nutchJob['Crawl']['name'], array('controller' => 'crawls', 'action' => 'view', $nutchJob['Crawl']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($nutchJob['User']['name'], array('controller' => 'users', 'action' => 'view', $nutchJob['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $nutchJob['NutchJob']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $nutchJob['NutchJob']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $nutchJob['NutchJob']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $nutchJob['NutchJob']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Nutch Job', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>