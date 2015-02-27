<?php 
	$this->layout = 'admin';
?>

<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>

<div>
	<table>
		<tr>
			<th>奖品ID</th>
			<th>奖品名</th>
			<th>seo关键词</th>
			<th>seo描述</th>
			<th>操作</th>
		</tr>
		<?php 
			foreach ($prizes as $prize) : 
		?>
		<tr id='prize_<?php echo $prize['Prize']['id'] ?>' class='prize'>
			<td class='prize-id'><?php echo $prize['Prize']['id'] ?></td>
			<td><?php echo $html->link($prize['Prize']['name'], array('controller' => 'prizes', 'action' => 'view', $prize['Prize']['id'])) ?></td>
			<td>
				<input name="data[Prize][page_keywords]" value="<?php echo $prize['Prize']['page_keywords'] ?>" class='page-keywords' />
			</td>
			<td>
				<textarea name="data[Prize][page_description]" value="<?php echo $prize['Prize']['page_description'] ?>" class='page-description' cols='40'><?php echo $prize['Prize']['page_description'] ?></textarea>
			</td>
			<td>
				<button>提交</button>
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
