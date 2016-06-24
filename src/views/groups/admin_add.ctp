<?php
	$h2 = $html->link($parent['Group']['name'], array('action'=>'view', $parent['Group']['id']));	
	$this->viewVars['sub_title_for_layout'] = '为'.$h2.'加入子权限组';
?>

<div class="groups form">
<?php echo $form->create('groups');?>
<fieldset>
 		<legend>新建权限组</legend>
	<?php
		echo $form->input('Group.name');
		echo $form->input('Group.description');
		echo $form->input('Group.parent_id', array('type' => 'hidden', 'default' => $parent['Group']['id']));
	?>
</fieldset>

<?php echo $form->end('提交'); ?>
</div>
