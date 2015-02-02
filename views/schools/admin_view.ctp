<div class="schools view">
<h2><?php  __('School');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name En'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['name_en']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name Full'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['name_full']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Image'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->image($school['School']['image'], array('height' => '80')); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Address'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['address']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Website'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['website']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Area'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['Area']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('District'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['District']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Keywords'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['meta_keywords']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $school['School']['meta_description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit School', true), array('action' => 'edit', $school['School']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete School', true), array('action' => 'delete', $school['School']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $school['School']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Schools', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New School', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Compounds', true), array('controller' => 'compounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound', true), array('controller' => 'compounds', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Compounds');?></h3>
	<?php if (!empty($school['Compound'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name En'); ?></th>
		<th><?php __('Name Zh'); ?></th>
		<th><?php __('Rent Lower'); ?></th>
		<th><?php __('Rent Upper'); ?></th>
		<th><?php __('Rent Unit'); ?></th>
		<th><?php __('Layout'); ?></th>
		<th><?php __('Property Type'); ?></th>
		<th><?php __('Area Id'); ?></th>
		<th><?php __('Ownership'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($school['Compound'] as $compound):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $compound['id'];?></td>
			<td><?php echo $compound['name_en'];?></td>
			<td><?php echo $compound['name_zh'];?></td>
			<td><?php echo $compound['rent_lower'];?></td>
			<td><?php echo $compound['rent_upper'];?></td>
			<td><?php echo $compound['rent_unit'];?></td>
			<td><?php echo $compound['layout'];?></td>
			<td><?php echo $compound['property_type'];?></td>
			<td><?php echo $compound['area_id'];?></td>
			<td><?php echo $compound['ownership'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'compounds', 'action' => 'view', $compound['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'compounds', 'action' => 'edit', $compound['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'compounds', 'action' => 'delete', $compound['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $compound['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
