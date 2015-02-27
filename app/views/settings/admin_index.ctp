<?php
	$this->viewVars['sub_title_for_layout'] = '每天赚豆次数限制';
?>

<br />
<div class="games index">
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>ID</th>
	<th><?php echo $paginator->sort('skey');?></th>
	<th><?php echo $paginator->sort('svalue');?></th>	
	<th class="actions"><?php echo "操作";?></th>
</tr>
	<?php
	$i = 0;
	foreach ($settings1 as $setting):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $i ?>
		</td>
		<td>
			<?php echo $setting['Setting']['skey']; ?>
		</td>
		<td>
			<?php echo $setting['Setting']['svalue']; ?>
		</td>
		<td>
			<?php echo $html->link('修改', array('controller'=>'settings', 'action'=>'edit', $setting['Setting']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>

<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
