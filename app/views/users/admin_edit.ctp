<?php 
	$prev = $html->link('用户管理', array('action'=>'index'));
	$this->viewVars['sub_title_for_layout'] = $prev;
?>

<div class="users form">
<?php echo $form->create('User'); ?>
	<fieldset>
		<legend>更改用户信息</legend>
	<?php 
		echo $form->input('User.id');
		echo $form->input('User.email');
		echo $form->input('User.name');
    echo $form->hidden('User.group_id');
  ?>
	</fieldset>
<?php echo $form->end('Submit'); ?>
</div>

<div class="users form">
<?php echo $form->create('User', array('action' => 'changeGroup')); ?>
	<fieldset>
		<legend>更改用户权限组</legend>
	<?php
		echo $form->input('User.id');
		echo $form->input('User.group_id', array('options' => $groups));
	?>
	</fieldset>
<?php echo $form->end('Submit'); ?>
</div>
