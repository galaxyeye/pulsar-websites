<?php 
	$this->viewVars['sub_title_for_layout'] = '会员清单';

	$pos = strpos($_SERVER['REQUEST_URI'], '?');

	if ($pos !== false) {
		$args = substr($_SERVER['REQUEST_URI'], $pos + 1);
		$paginator->options(array('url' =>  array('?' => $args)));
	}
?>

<br />
<p>
<?php
	echo $paginator->counter(array(
		'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
?>
</p>
<table id='userList'>
    <tr>
        <th>ID</th>
        <th><?php echo $paginator->sort('邮箱地址', 'User.email'); ?></th>
		<th><?php echo $paginator->sort('会员名', 'User.name'); ?></th>
		<th><?php echo $paginator->sort('积分', 'User.point'); ?></th>
		<th><?php echo $paginator->sort('经验值', 'User.exp'); ?></th>
		<th><?php echo $paginator->sort('引荐人', 'User.referer'); ?></th>
		<th><?php echo $paginator->sort('创建时间', 'User.created'); ?></th>
		<th><?php echo $paginator->sort('帐户状态', 'User.status'); ?></th>
		<th class="actions"><?php echo "操作";?></th>
	</tr>
	<?php 
		foreach ($users as $user): 
	?>
	<tr>
		<td><?php echo $user['User']['id']; ?></td>
		<td><?php echo $user['User']['email']; ?></td>
		<td><?php echo $user['User']['name']; ?></td>
		<td><?php echo $user['User']['point']; ?></td>
		<td><?php echo $user['User']['exp']; ?></td>
		<td><?php echo $user['User']['referrer']; ?></td>		
		<td><?php echo $user['User']['created']; ?></td>
		<td>
			<?php echo $user['User']['status']; ?>
			<?php 
				if ($user['User']['status'] == 'CREATED') {
					echo $html->link('激活', array('controller'=>'users', 'action'=>'activate', $user['User']['id']), array('target' => '_blank'));
				}
			?>
		</td>
		<td><?php echo $html->link('修改', array('controller'=>'users', 'action'=>'edit', $user['User']['id'])); ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>

