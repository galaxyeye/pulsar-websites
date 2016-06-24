<?php
	$this->viewVars['sub_title_for_layout'] = '根权限组';
?>

<table id='groupsList'>
	<tr>
		<th>序号</th>
		<th>名字</th>
		<th>描述</th>
		<th>操作</th>
	</tr>
	<?php
		$i = 0;
		foreach ($groups as $group):
	?>
	<tr>
		<td><?php echo ++$i; ?></td>
		<td><?php echo $html->link($group['Group']['name'], array('action' => 'view', $group['Group']['id'])); ?></td>
		<td><?php echo $group['Group']['description']; ?></td>
		<td><?php echo $html->link('修改', array('action' => 'edit', $group['Group']['id'])); ?></td>
	</tr>
	<?php endforeach; ?>
</table>
