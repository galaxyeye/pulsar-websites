<?php 
	$this->viewVars['sub_title_for_layout'] = '发送邮件';

	$html->script('fckeditor', array('inline' => false));
?>

<?php $status = array('ALL' => '所有状态', 'CREATED' => '新创建', 'RUNNING' => '进行中', 'WAITING' => '等待中', 'FINISHED' => '已完成', 'CANCELLED' => '已取消', 'DELETED' => '已删除') ?>
<?php $searchType = array('NONE' => '----', 'email' => 'email', 'name' => 'name') ?>
<div>
	<?php echo $form->create('Lmail') ?>
		<?php echo $form->input('title', array()) ?>
		<?php echo $fck->fckeditor(array('Lmail', 'content'), $html->base) ?>
		<div class="try"><input type="text" id="TryEmail" value="" name="data[Try][email]"></div>
		<input type="button" class='try' value="试发">
		<br />
		<br />
		<div class="filter">
			<div class='statusAndGroup'>
				<?php echo $form->input('Filter.status', array('options' => $status, 'default' => 'ALL', 'label' => '状态')); ?>
				<?php echo $form->input('Filter.group', array('options' => $groups, 'default' => 'all', 'label' => '所属权限组')); ?>
			</div>

			<div class='time'>
				<?php echo $form->input('Filter.start', array('type' => 'date', 'dateFormat' => 'YMD', 
						'minYear' => date('Y') - 20, 'maxYear' => date('Y'), 'label' => '起始时间', 'default' => date('YMD', strtotime("-1 months")))); ?>
				<?php echo $form->input('Filter.end', array('type' => 'date', 'dateFormat' => 'YMD', 
						'minYear' => date('Y') - 20, 'maxYear' => date('Y'), 'label' => '结束时间')); ?>
			</div>
			<div class='clear'></div>
		</div>
		<input type="button" class='send' value="发送">
	<?php echo $form->end() ?>
</div>

<div class="actions">
	<ul>
		<li><?php echo $html->link('邮件清单', array('action'=>'index')); ?> </li>
	</ul>
</div>