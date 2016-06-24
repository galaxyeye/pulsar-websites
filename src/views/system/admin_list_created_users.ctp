<?php 
	$this->layout = 'admin';
?>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<div>
	<table>
		<tr>
			<th>ID</th>
			<th>姓名</th>
			<th>注册邮箱</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
		<?php 
			foreach ($newUsers as $user) :
		?>
		<tr>
			<td><?php echo $user['User']['id'] ?></td>
			<td><?php echo $user['User']['name'] ?></td>
			<td><?php echo $user['User']['email'] ?></td>
			<td><?php echo $user['User']['status'] ?></td>
			<td><?php echo $html->link('发送激活邮件', array('controller' => 'users', 'action' => 'sendUsersRegisterMail', $user['User']['id'])) ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>

<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>