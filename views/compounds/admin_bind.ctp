<script type="text/javascript">
  var compound_id = <?php echo $compound['Compound']['id'] ?>;
</script>

<table class='search_box'><tbody><tr><td><input type="text" value="Compound Name, Keywords..." />
  <input type="button" class='button' value="Search"></td></tr></tbody>
</table>

<div class="compounds view">
<h2><?php  __('Compound');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cid'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['cid']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name En'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['name_en'].' - '.$compound['Compound']['name_zh']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Property Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['property_type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('IsAlone'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['is_alone']  ? '是' : '否' ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php __('Related properties');?></h3>
	<?php if (!empty($properties)):?>
	<table>
	<tr>
		<th><input type='checkbox' class='check-all' /></th>
	  <th><?php __('Id'); ?></th>
		<th><?php __('Pid'); ?></th>
		<th><?php __('name_en'); ?></th>
		<th>Compound</th>
		<th><?php __('Layout'); ?></th>
		<th><?php __('Property Type'); ?></th>
		<th><?php __('Size'); ?></th>
		<th><?php __('Rent'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($properties as $property):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}

			$binded = false;
			if ($property['Compound']['id'] == $compound['Compound']['id']) {
			 $binded = true;
			}
		?>
		<tr<?php echo $class;?>>
			<td><input type='checkbox' class='check-property' pid=<?php echo $property['Property']['id']; ?> <?php if ($binded) echo ' checked=checked'; ?> /></td>
		  <td><?php echo $property['Property']['id'];?></td>
			<td><?php echo $property['Property']['pid'];?></td>
			<td><?php echo $property['Property']['name_en'].' <br /> '.$property['Property']['name_zh'] ?>&nbsp;</td>
			<td><?php echo $property['Compound']['name_en'].' <br /> '.$property['Compound']['name_zh'] ?>&nbsp;</td>
			<td><?php echo $property['Property']['layout'];?></td>
			<td><?php echo $property['Property']['property_type'];?></td>
			<td><?php echo $property['Property']['size'];?></td>
			<td><?php echo $property['Property']['rent'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('view', true), array('controller' => 'properties', 'action' => 'view', $property['Property']['id'])); ?>
		  </td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<table>
  <tr>
   <td><input type="button" class='bind-all button' value="Bind All" />
   <input type="button" class='unbind-all button' value="Unbind All" /></td>
  </tr>
</table>
