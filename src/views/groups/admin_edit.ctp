<?php
	$this->viewVars['sub_title_for_layout'] = '修改权限组信息';
?>

<div class="groups form">
<?php echo $form->create('Group');?>
<fieldset>
 		<legend>修改权限组信息</legend>
	<?php
		echo $form->input('Group.id');
		echo $form->input('Group.name', array('readonly' => true));
		echo $form->input('Group.description');
		echo $form->input('Group.parent_id', array('type' => 'hidden'));
	?>
</fieldset>

<?php echo $form->end('修改'); ?>
</div>

<div class="actions">
	<ul>
		<li>
			<?php
				if ($form->value('Group.parent_id')) {
					echo $html->link('查看权限组信息', array('action'=>'view', $form->value('Group.parent_id'))); 
				}
				else {
					echo $html->link('查看权限组信息', array('action'=>'index')); 
				}
			?>
		</li>
	</ul>
</div>

<?php pr($this->data) ?>
