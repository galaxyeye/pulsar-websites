<div class='message green'>
<?php if($compound['Compound']['is_alone']) : ?>
注意：这是一个单独的房源，所以不会对客户显示，但会出现在地图中。
<?php endif; ?>
</div>

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
			<?php echo $compound['Compound']['name_en']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name Zh'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['name_zh']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rent Lower'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['rent_lower']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rent Upper'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['rent_upper']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rent Unit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['rent_unit']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Layout'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['layout']; ?>
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
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Area'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Area']['name'] ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('District'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['District']['name'] ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ownership'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['ownership']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['desc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Features'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['features']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Locations'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['locations']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lat'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['lat']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lng'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['lng']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Facilities'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['facilities']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Keywords'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['meta_keywords']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['meta_description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $compound['Compound']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Compound', true), array('action' => 'edit', $compound['Compound']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Compound', true), array('action' => 'delete', $compound['Compound']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $compound['Compound']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Compounds', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Bind Properties', true), array('action' => 'bind', $compound['Compound']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List CompoundImages', true), array('controller' => 'compound_images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New CompoundImage', true), array('controller' => 'compound_images', 'action' => 'add', 'compound_id' => $compound['Compound']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound Layout', true), array('controller' => 'compound_layouts', 'action' => 'add', 'compound_id' => $compound['Compound']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Schools', true), array('controller' => 'schools', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School', true), array('controller' => 'schools', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related properties');?></h3>
	<?php if (!empty($compound['Property'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Pid'); ?></th>
		<th><?php __('name_en'); ?></th>
		<th><?php __('Layout'); ?></th>
		<th><?php __('Property Type'); ?></th>
		<th><?php __('Size'); ?></th>
		<th><?php __('Rent'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($compound['Property'] as $property):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $property['id'];?></td>
			<td><?php echo $property['pid'];?></td>
			<td><?php echo $property['name_en'].' - '.$property['name_zh'] ?></td>
			<td><?php echo $property['layout'];?></td>
			<td><?php echo $property['property_type'];?></td>
			<td><?php echo $property['size'];?></td>
			<td><?php echo $property['rent'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'properties', 'action' => 'view', $property['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'properties', 'action' => 'edit', $property['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'properties', 'action' => 'delete', $property['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $property['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Property', true), array('controller' => 'properties', 'action' => 'add', 'compound_id' => $compound['Compound']['id']));?> </li>
		  <li><?php echo $this->Html->link(__('New Property Alone', true), array('action' => 'add_alone')); ?></li>
		  <li><?php echo $this->Html->link(__('Bind Properties', true), array('action' => 'bind', $compound['Compound']['id'])); ?> </li>
		</ul>
	</div>
</div>


<div class="related">
	<h3><?php __('Gallary'); ?></h3>
	<div>
  	<?php foreach ($compound['CompoundImage'] as $image ) : ?>
		<span><?php echo $html->link($html->image($image['url']), array('controller' => 'compound_images', 'action' => 'view', $image['id']), array('escape' => false)); ?>			
  	<?php endforeach; ?>
  </div>
		
	<div class="actions">
		<ul>
		  <li><?php echo $this->Html->link(__('List CompoundImages', true), array('controller' => 'compound_images', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Compound Image', true), array('controller' => 'compound_images', 'action' => 'add', 'compound_id' => $compound['Compound']['id']));?> </li>
		</ul>
	</div>
</div>

<div class="related">
	<h3><?php __('Related Compound Layouts');?></h3>
	<?php if (!empty($compound['CompoundLayout'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Compound Id'); ?></th>
		<th><?php __('Size'); ?></th>
		<th><?php __('Layout'); ?></th>
		<th><?php __('Rent Desc'); ?></th>
		<th><?php __('Rent Unit'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($compound['CompoundLayout'] as $compoundLayout):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $compoundLayout['id'];?></td>
			<td><?php echo $compoundLayout['size'];?></td>
			<td><?php echo $compoundLayout['layout'];?></td>
			<td><?php echo $compoundLayout['rent_desc'];?></td>
			<td><?php echo $compoundLayout['rent_unit'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'compound_layouts', 'action' => 'view', $compoundLayout['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'compound_layouts', 'action' => 'edit', $compoundLayout['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'compound_layouts', 'action' => 'delete', $compoundLayout['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $compoundLayout['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Compound Layout', true), array('controller' => 'compound_layouts', 'action' => 'add', 'compound_id' => $compound['Compound']['id']));?> </li>
		</ul>
	</div>
</div>

<div class="related">
	<h3><?php __('Related Schools');?></h3>
	<?php if (!empty($compound['School'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name En'); ?></th>
		<th><?php __('Address'); ?></th>
		<th><?php __('Website'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($compound['School'] as $school):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $school['id'];?></td>
			<td><?php echo $school['name_en'];?></td>
			<td><?php echo $school['address'];?></td>
			<td><?php echo $school['website'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'schools', 'action' => 'view', $school['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'schools', 'action' => 'edit', $school['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'schools', 'action' => 'delete', $school['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $school['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New School', true), array('controller' => 'schools', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
