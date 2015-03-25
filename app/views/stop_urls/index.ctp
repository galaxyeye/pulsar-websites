<div class="stopUrls index">
	<h2><?php __('Stop Urls');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<th><?php echo $this->Paginator->sort('forbidden_point');?></th>
			<th><?php echo $this->Paginator->sort('crawl_id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($stopUrls as $stopUrl):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $stopUrl['StopUrl']['id']; ?>&nbsp;</td>
		<td><?php echo $stopUrl['StopUrl']['url']; ?>&nbsp;</td>
		<td><?php echo $stopUrl['StopUrl']['forbidden_point']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($stopUrl['Crawl']['name'], array('controller' => 'crawls', 'action' => 'view', $stopUrl['Crawl']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($stopUrl['User']['name'], array('controller' => 'users', 'action' => 'view', $stopUrl['User']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $stopUrl['StopUrl']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $stopUrl['StopUrl']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $stopUrl['StopUrl']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $stopUrl['StopUrl']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Stop Url', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>