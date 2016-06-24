<?php 
	$this->viewVars['sub_title_for_layout'] = '清单邮件';
	
	$this->viewVars['css_for_layout'] = $html->css('admin_search', false);
	
	App::import('Sanitize');
?>

<div class="filter">
<?php $emailStatus = array('PENDING' => '等待确认', 'CONFIRMED' => '已确认', 'SENT' => '已发送') ?>
<?php $searchType = array('NONE' => '----', 'to' => 'to', 'subject' => 'subject') ?>
<fieldset>
	<?php echo $form->create('Lmail', array('action' => 'index')); ?>

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
<div>以下默认仅显示尚未发送的邮件</div>
<p>
<?php
	echo $paginator->counter(array(
		'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
?>
</p>
<table id='lmailList'>
    <tr>
        <th>序号</th>
        <th>批次号</th>
        <th><?php echo $paginator->sort('发件人', 'Lmail.from'); ?></th>
		<th><?php echo $paginator->sort('收件人', 'Lmail.to'); ?></th>
		<th><?php echo $paginator->sort('标题', 'Lmail.subject'); ?></th>
		<th>邮件状态</th>
		<th>优先级</th>
		<th>操作</th>
	</tr>
	<?php
		$i = 0;
		foreach ($lmails as $lmail) : 
	?>
	<tr>
        <td><?php echo ++$i ?></td>
		<td><?php echo $html->link($lmail['Lmail']['batch_id'], array('action' => 'confirm', $lmail['Lmail']['batch_id'])) ?></td>
		<td><?php echo Sanitize::html($lmail['Lmail']['from']) ?></td>
		<td><?php echo $lmail['Lmail']['to'] ?></td>
		<td><?php echo $lmail['Lmail']['subject'] ?></td>
		<td><?php echo $lmail['Lmail']['status'] ?></td>
		<td><?php echo $lmail['Lmail']['priority'] ?></td>
		<td>
			<?php echo $html->link('查看', array('action'=>'view', $lmail['Lmail']['id']), array('target' => '_blank')) ?>
			<?php echo $html->link('预览', array('action'=>'preview', $lmail['Lmail']['id']), array('target' => '_blank')) ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
