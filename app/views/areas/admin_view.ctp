<?php
	$html->script('editinplace.0.4', array('inline' => false));

	if ($current == NULL){
		$this->viewVars['sub_title_for_layout'] = '区域信息管理';
	}else {
		$parentId = isset($parent['id']) ? $parent['id'] : 0;
		$rootUrl = ($parentId == 0) ? '/admin/areas/' : '/admin/areas/view/'.$parentId;
		$this->viewVars['sub_title_for_layout'] = '隶属于'.$html->link($current['name'], $rootUrl).'的区域';
	}
?>

<div class='hidden'><input type='hidden' id='root' value='<?php echo $current ? $current['id'] : 0 ?>' /></div>
<div class='control'><span class='open'>打开编辑模式</span><span class='close'>关闭编辑模式</span></div>
<div class='message'><span></span></div>
<div class='error'></div>
<div class='fit'>
	<table id='areasList' class='editableContainer'>
		<thead>
		    <tr>
				<th class='hidden'>ID</th>
		        <th>序号</th>
				<th>名字</th>
				<th>级别</th>
				<th>下属区域数</th>
				<th>是否显示</th>
				<th class='op'>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($subAreas as $area): ?>
			<tr>
				<td class='hidden'><span class='e'><?php echo $area['Area']['id']; ?></span></td>
				<td><span class='e'><?php echo $area['Area']['order']; ?></span></td>
				<td><?php echo $html->link($area['Area']['name'], array('controller' => 'areas', 'action' => 'view', $area['Area']['id']), array('class' => 'e')); ?></td>
				<td><span><?php echo $area['Area']['layer']; ?></span></td>
				<td><span><?php echo $area['Area']['children']; ?></span></td>
				<td><span class='e'><?php echo ($area['Area']['is_open'] == 1 ? '是' : '否'); ?></span></td>
				<td class='op'><a class='rm' href='javascript:void()'>移除</a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
		<tfoot class='add'>
			<tr>
				<td class='hidden'><span class='e'>0</span></td>
				<td><span class='e'><?php echo $nextOrder ?></span></td>
				<td><span class='e'>输入区域名</span></td>
				<td><span><?php echo $layer ?></span></td>
				<td><span>0</span></td>
				<td><span class='e'>是</span></td>
				<td class='op'><input class='doAdd' type='button' value='添加' /></td>
			</tr>
		</tfoot>
	</table>
</div>
