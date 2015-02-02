<div class="webpages index">
	<h2><?php __('Webpages');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('domain');?></th>
			<th><?php echo $this->Paginator->sort('url');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('keywords');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('html');?></th>
			<th><?php echo $this->Paginator->sort('category_tags');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($webpages as $webpage):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $webpage['Webpage']['id']; ?>&nbsp;</td>
		<td><?php echo $webpage['Webpage']['domain']; ?>&nbsp;</td>
		<td><?php echo $webpage['Webpage']['url']; ?>&nbsp;</td>
		<td><?php echo $webpage['Webpage']['title']; ?>&nbsp;</td>
		<td><?php echo $webpage['Webpage']['keywords']; ?>&nbsp;</td>
		<td><?php echo $webpage['Webpage']['description']; ?>&nbsp;</td>
		<td><?php echo $webpage['Webpage']['html']; ?>&nbsp;</td>
		<td><?php echo $webpage['Webpage']['category_tags']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $webpage['Webpage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $webpage['Webpage']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $webpage['Webpage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $webpage['Webpage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Webpage', true), array('action' => 'add')); ?></li>
	</ul>
</div>