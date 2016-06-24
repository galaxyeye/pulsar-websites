<?php
	$prev = $html->link('每人每天赚多少次', array('action'=>'index'));
	$this->viewVars['sub_title_for_layout'] = $prev;
?>


<div class="settings form">
<?php echo $form->create('Setting'); ?>
	<fieldset>
		<legend>更改统计信息</legend>
	<?php
		echo $form->input('Setting.id');
		echo $form->input('Setting.skey', array('readonly'=>'true'));
		echo $form->input('Setting.svalue');
	?>
	</fieldset>
<?php echo $form->end('Submit'); ?>
</div>
