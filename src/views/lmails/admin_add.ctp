<?php 
	$this->viewVars['sub_title_for_layout'] = '发送邮件';

	$html->script('fckeditor', array('inline' => false));
	
	$this->viewVars['css_for_layout'] = $html->css('admin_search', false);
?>

<?php $status = array('ALL' => '所有状态', 'CREATED' => '新创建', 'ACTIVATED' => '已激活', 'BANNED' => '已封杀', 'CANCELLED' => '已取消') ?>
<?php $searchType = array('NONE' => '----', 'email' => 'email') ?>

<div><?php echo $session->flash() ?></div>

<div>
	<?php echo $form->create('Lmail', array('action' => 'add')) ?>
		<?php echo $form->input('from', array('options' => array(
			'乐够乐透网 <no-reply@logoloto.com>' => '乐够乐透网 <no-reply@logoloto.com>', 
			'乐够乐透网客服 <service@logoloto.com>' => '乐够乐透网客服 <service@logoloto.com>'), 'label' => '发送邮箱')) ?>
		<?php echo $form->hidden('batch_id', array('value' => uniqid('U-'))) ?>
		<?php echo $form->hidden('bcc') ?>
		<?php echo $form->hidden('send_as', array('value' => 'html')) ?>
		<div>邮件标题<input type="text" class="subject" name="data[Lmail][subject]" /></div>
		<div class='content'>邮件内容<?php echo $fck->fckeditor(array('Lmail', 'content_html'), $html->base, '', '600px') ?></div>
		<div class="filter">
		<fieldset>
			<legend>收件人筛选</legend>
			<div class='statusAndGroup'>
				<?php echo $form->input('Filter.status', array('options' => $status, 'default' => 'ALL', 'label' => '状态')); ?>
				<?php //echo $form->input('Filter.shanghai', array('type' => 'checkbox', 'label' => '锁定上海地区')); ?>
			</div>

			<div class='time'>
				<?php echo $form->input('Filter.start', array('type' => 'date', 'dateFormat' => 'YMD', 
						'minYear' => date('Y') - 20, 'maxYear' => date('Y'), 'label' => '注册时间', 'default' => date('YMD', strtotime("-1 months")))); ?>
				<?php echo $form->input('Filter.end', array('type' => 'date', 'dateFormat' => 'YMD', 
						'minYear' => date('Y') - 20, 'maxYear' => date('Y'), 'label' => '结束时间')); ?>
			</div>

			<div class='search'>
				<?php echo $form->input('Search.type', array('options' => $searchType, 'label' => '根据', 'div' => 'type')); ?>
				<?php echo $form->input('Search.key', array('label' => '搜索', 'div' => 'key', 'after' => '使用半角逗号分隔不同的关键字，如：gmail.com,msn.com,yueming')) ?>
			</div>

			<div class='clear'></div>
		</fieldset>
		</div>
		<?php echo $form->hidden('content_text') ?>
		<?php echo $form->hidden('status', array('value' => 'PENDING')) ?>
		<input type="submit" class='send' value="提交并预览">
	<?php echo $form->end() ?>
</div>
<br />
<br />
<div class="actions">
	<ul>
		<li><?php echo $html->link('邮件清单', array('action'=>'index')); ?> </li>
	</ul>
</div>
<br />
<br />
