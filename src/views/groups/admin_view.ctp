<?php
	if ($current['Group']['parent_id']){
		$h2 = $html->link($current['Group']['name'], array('action' => 'view', $current['Group']['parent_id']));
		$this->viewVars['sub_title_for_layout'] = '隶属于'.$h2.'的权限组';
	}
	else {
		$h2 = $html->link($current['Group']['name'], array('action' => 'index'));
		$this->viewVars['sub_title_for_layout'] = '隶属于'.$h2.'的权限组';	
	}
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
		foreach ($children as $child): 
	?>
	<tr>
		<td><?php echo ++$i; ?></td>
		<td><?php echo $html->link($child['Group']['name'], array('action' => 'view', $child['Group']['id'])); ?></td>
		<td><?php echo $child['Group']['description']; ?></td>
		<td><?php echo $html->link('修改', array('action' => 'edit', $child['Group']['id'])); ?></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php echo $html->link('加入子权限组', array('action' => 'add', 'for' => $current['Group']['id'])) ?>

<?php pr($current) ?>
<?php pr($children) ?>
