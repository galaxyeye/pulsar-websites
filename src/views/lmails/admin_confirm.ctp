<?php 
	$this->viewVars['sub_title_for_layout'] = '邮件确认';

	$this->viewVars['css_for_layout'] = $html->css('admin_search', false);

	// This lines are for pagination
	$args = $this->passedArgs;
	unset($args['page']);
	$paginator->options(array('url'=>$args));

	App::import('Sanitize');

	$batchId = 0;
?>

<?php $emailStatus = array('PENDING' => '等待确认', 'CONFIRMED' => '已确认', 'SENT' => '已发送') ?>
<?php $userStatus = array('ALL' => '所有状态', 'CREATED' => '新创建', 'ACTIVATED' => '已激活', 'BANNED' => '已封杀', 'CANCELLED' => '已取消', 'DELETED' => '已删除') ?>

<br />
<div class='message'><span></span></div>
<div class='error'></div>

<div class='general'>
	<h3>邮件概况</h3>
	<?php 
		if(!empty($lmails)) : 
		$lmail = $lmails[0];
		$batchId = $lmail['Lmail']['batch_id'];
	?>
	<div><input type='hidden' class='batch-id' value=<?php echo $lmail['Lmail']['batch_id'] ?> /></div>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>>批号</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $lmail['Lmail']['batch_id'] ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>发件人</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo Sanitize::html($lmail['Lmail']['from']) ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>邮件主题</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $lmail['Lmail']['subject']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>邮件内容</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link('预览', array('action'=>'preview', $lmail['Lmail']['id']), array('target' => '_blank')) ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>>邮件优先级</dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $lmail['Lmail']['priority']; ?>
			&nbsp;
		</dd>
	</dl>
	<?php endif; ?>
</div>
<br />
<div class="filter">
<?php $searchType = array('NONE' => '----', '收件人邮箱' => 'to') ?>
<fieldset>
	<legend>在本批次中筛选</legend>
	<?php echo $form->create('Lmail', array('url' => "/admin/lmails/confirm/$batchId")); ?>

	<div class='statusAndGroup'>
		<?php echo $form->input('Filter.status', array('options' => $emailStatus, 'default' => 'ALL', 'label' => '邮件状态')); ?>
	</div>

	<div class='time'>
		<?php echo $form->input('Filter.start', array('type' => 'date', 'dateFormat' => 'YMD', 
				'minYear' => date('Y') - 20, 'maxYear' => date('Y'), 'label' => '起始时间', 'default' => date('YMD', strtotime("-1 months")))); ?>
		<?php echo $form->input('Filter.end', array('type' => 'date', 'dateFormat' => 'YMD', 
				'minYear' => date('Y') - 20, 'maxYear' => date('Y'), 'label' => '结束时间')); ?>
	</div>

	<div class='search'>
		<?php echo $form->input('Search.type', array('options' => $searchType, 'label' => '根据', 'div' => 'type')); ?>
		<?php echo $form->input('Search.key', array('label' => '搜索', 'div' => 'key')) ?>
		<?php echo $form->end('提交'); ?>
	</div>

	<div class='clear'></div>
</fieldset>
</div>
<br />
<p>
<?php
	echo $paginator->counter(array(
		'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
?>
</p>

<?php if (!empty($lmails)) : ?>
<div class="operates">
	<input name="del" class='del' type="button" value="删除所选" />
	<input name="confirm" class='confirm' type="button" value="确认所选" />
	<input name="delAll" class='del-all' type="button" value="删除全部" />
	<input name="confirmAll" class='confirm-all' type="button" value="确认全部" />
</div>
<?php endif; ?>

<table id='lmailList'>
    <tr>
		<th><input type="checkbox" name='check-all' class="check-all" />全选</th>
		<th>收件人</th>
		<th>收件人邮箱</th>
		<th>收件人状态</th>
		<th>邮件状态</th>
		<th>创建时间</th>
		<th>操作</th>
	</tr>
	<?php 
		$i = 0;
		foreach ($lmails as $lmail) : 
	?>
	<tr>
		<td><?php echo ++$i ?>
			<input class='check-item' name='data[Lmail][<?php echo '_'.$lmail['Lmail']['id'] ?>]' type='checkbox' />
			<input class='lmail-id' type='hidden' value="<?php echo $lmail['Lmail']['id'] ?>" />
		</td>
		<td><?php echo $html->link($lmail['User']['name'], array('controller' => 'users', 'action' => 'view', $lmail['User']['id']), array('target' => '_blank')) ?></td>
		<td><?php echo $lmail['Lmail']['to'] ?></td>
		<td><span class="<?php echo $lmail['User']['status'] != 'ACTIVATED' ? 'red' : 'green'?>"><?php echo $userStatus[$lmail['User']['status']] ?></span></td>
		<td><?php echo $emailStatus[$lmail['Lmail']['status']] ?></td>
		<td><?php echo date('Y/m/d H:m:s', strtotime($lmail['Lmail']['created'])) ?></td>
		<td>
			<?php echo $html->link('预览', array('action'=>'preview', $lmail['Lmail']['id']), array('target' => '_blank')) ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?php if (!empty($lmails)) : ?>
<div class="operates">
	<input name="del" class='del' type="button" value="删除所选" />
	<input name="confirm" class='confirm' type="button" value="确认所选" />
	<input name="delAll" class='del-all' type="button" value="删除全部" />
	<input name="confirmAll" class='confirm-all' type="button" value="确认全部" />
</div>
<?php endif; ?>

<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>

<div class="actions">
	<ul>
		<li><?php echo $html->link('邮件清单', array('action'=>'index')); ?> </li>
	</ul>
</div>