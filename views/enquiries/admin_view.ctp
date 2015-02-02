<div class="enquiries view">
<h2>咨询和看房</h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['gender']; ?>&nbsp;&nbsp;<?php echo $enquiry['Enquiry']['full_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cell Phone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['cell_phone']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Company'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['company']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nationality'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['nationality']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Budget'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['budget']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lease Term'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['lease_term']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('House Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['house_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('City'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['city']; ?>, <?php echo $enquiry['Enquiry']['user_city']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Area'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['preferred_areas']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bedrooms'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['bedrooms']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Furnishings'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['furnishings']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Viewing Trip'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['viewing_trip']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Comments'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $enquiry['Enquiry']['comments']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3>客户预订的房源</h3>
  <?php if (!empty($arranged_properties2)) : ?>
	<table>
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Property Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Compound Id'); ?></th>
		<th><?php __('Layout'); ?></th>
		<th><?php __('Property Type'); ?></th>
		<th><?php __('Size'); ?></th>
		<th><?php __('Rent'); ?></th>
		<th><?php __('Rent Unit'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($arranged_properties2 as $property):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}

			$pro = $property['Property'];
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $pro['id'];?></td>
			<td><?php echo $pro['pid'];?></td>
			<td><?php echo $this->Html->link($pro['name_en'].' - '.$pro['name_zh'], array('controller' => 'properties', 'action' => 'view', $pro['id']), array('target' => 'blank')); ?></td>			
			<td><?php echo $pro['compound_id'];?></td>
			<td><?php echo $pro['layout'];?></td>
			<td><?php echo $pro['property_type'];?></td>
			<td><?php echo $pro['size'];?></td>
			<td><?php echo $pro['rent'];?></td>
			<td><?php echo $pro['rent_unit'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'properties', 'action' => 'view', $pro['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Enquiry', true), array('action' => 'edit', $enquiry['Enquiry']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Enquiries', true), array('action' => 'index')); ?> </li>
	</ul>
</div>
