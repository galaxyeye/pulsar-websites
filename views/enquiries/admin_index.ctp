<div class="enquiries index">
	<h2><?php __('Enquiries');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('full_name');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('cell_phone');?></th>
			<th><?php echo $this->Paginator->sort('company');?></th>
			<th><?php echo $this->Paginator->sort('nationality');?></th>
			<th><?php echo $this->Paginator->sort('budget');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php 
	$i = 0;
	foreach ($enquiries as $enquiry):

	  $arranged = !empty($enquiry['Enquiry']['property_ids']);

		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
		if ($arranged)
		 $class = ' class="blue"';
	?>
	<tr<?php echo $class;?>>
		<td>
		  <?php echo $arranged ? "*" : ''; ?>
		  <?php echo $enquiry['Enquiry']['id']; ?>&nbsp;
		</td>
		<td><?php echo $enquiry['Enquiry']['full_name']; ?>&nbsp;</td>
		<td><?php echo $enquiry['Enquiry']['email']; ?>&nbsp;</td>
		<td><?php echo $enquiry['Enquiry']['cell_phone']; ?>&nbsp;</td>
		<td><?php echo $enquiry['Enquiry']['company']; ?>&nbsp;</td>
		<td><?php echo $enquiry['Enquiry']['nationality']; ?>&nbsp;</td>
		<td><?php echo $enquiry['Enquiry']['budget']; ?>&nbsp;</td>
		<td><?php echo $enquiry['Enquiry']['created']; ?>&nbsp;</td>
		<td><?php echo $enquiry['Enquiry']['status'] == 'NotRead' ? '未处理' : '已处理'; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $enquiry['Enquiry']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $enquiry['Enquiry']['id'])); ?>
			<?php 
			  if ($enquiry['Enquiry']['status'] == 'NotRead') {
			   echo $this->Html->link('标为已处理', array('action' => 'markRead', $enquiry['Enquiry']['id']));
			  }
			?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
