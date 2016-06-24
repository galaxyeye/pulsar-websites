<div class="webAuthorizations index">
	<h2><?php __('Web Authorizations');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('login_url');?></th>
			<th><?php echo $this->Paginator->sort('account');?></th>
			<th><?php echo $this->Paginator->sort('password_text');?></th>
			<th><?php echo $this->Paginator->sort('account_css_selector');?></th>
			<th><?php echo $this->Paginator->sort('password_css_selector');?></th>
			<th><?php echo $this->Paginator->sort('crawl_id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($webAuthorizations as $webAuthorization):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $webAuthorization['WebAuthorization']['id']; ?>&nbsp;</td>
		<td><?php echo $webAuthorization['WebAuthorization']['login_url']; ?>&nbsp;</td>
		<td><?php echo $webAuthorization['WebAuthorization']['account']; ?>&nbsp;</td>
		<td><?php echo $webAuthorization['WebAuthorization']['password_text']; ?>&nbsp;</td>
		<td><?php echo $webAuthorization['WebAuthorization']['account_css_selector']; ?>&nbsp;</td>
		<td><?php echo $webAuthorization['WebAuthorization']['password_css_selector']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($webAuthorization['Crawl']['name'], array('controller' => 'crawls', 'action' => 'view', $webAuthorization['Crawl']['id'])); ?>
		</td>
		<td><?php echo $webAuthorization['WebAuthorization']['user_id']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $webAuthorization['WebAuthorization']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $webAuthorization['WebAuthorization']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $webAuthorization['WebAuthorization']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $webAuthorization['WebAuthorization']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Web Authorization', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
	</ul>
</div>