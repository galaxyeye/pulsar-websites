<div class="WebPage_pages index">
	<h2><?php __('WebPage');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th>Url</th>
			<th>Title</th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php 
	$i = 0;
	foreach ($webPages as $webPage):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $webPage['WebPage']['url']; ?>&nbsp;</td>
		<td><?php echo $webPage['WebPage']['title']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', symmetric_encode($webPage['WebPage']['url']))); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Search Web', true), array('action' => 'search')); ?></li>
	</ul>
</div>
