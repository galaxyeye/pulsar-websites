<?php echo $this->element('crawls/subnav') ?>

<div class="crawls index">
	<h2><?php __('Crawls');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('rounds');?></th>
			<th><?php echo $this->Paginator->sort('R/Finish', 'finished_rounds');?></th>
			<th><?php echo $this->Paginator->sort('limit');?></th>
			<th><?php echo $this->Paginator->sort('P/Finish', 'fetched_pages');?></th>
			<th><?php echo $this->Paginator->sort('state');?></th>
			<th><?php echo $this->Paginator->sort('configId');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('finished');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php 
	$i = 0;
	foreach ($crawls as $crawl) : 
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $crawl['Crawl']['id']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['name']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['rounds']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['finished_rounds']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['limit']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['fetched_pages']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['state']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['configId']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($crawl['User']['name'], array('controller' => 'users', 'action' => 'view', $crawl['User']['id'])); ?>
		</td>
		<td><?php echo $crawl['Crawl']['created']; ?>&nbsp;</td>
		<td><?php echo $crawl['Crawl']['finished']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $crawl['Crawl']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $crawl['Crawl']['id'])); ?>
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
