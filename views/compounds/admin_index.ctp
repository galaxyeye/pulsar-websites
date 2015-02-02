<?php 
  $this->set('title_for_layout', $title_for_layout);

  $sort_url = $paginator->options['url'];
  $sort_url['page'] = null;

  global $all_property_types;

  unset($old_filter['sort']);
  unset($old_filter['page']);
  unset($old_filter['direction']);
?>

    <ul class="search_options">
      <li class='cl'>
        <div><em>Property Type:</em></div>
        <p>
          <?php 
           print_all_search_options('property_type', $old_filter, $html);

           foreach($all_property_types as $property_type) {
             if (array_key_exists('property_type', $old_filter) && $old_filter['property_type'] == $property_type) {
               echo "<span>{$property_type}</span>";
             }
             else echo $this->Html->link($property_type, array_merge($old_filter, array('property_type' => $property_type)));
           }
          ?>
        </p>
      </li>
      <li class='cl'>
        <div><em>Area:</em></div>
        <p>
        <?php 
          print_all_search_options('area_id', $old_filter, $html);

          foreach($areas as $id => $name) {
            if (array_key_exists('area_id', $old_filter) && $old_filter['area_id'] == $id) {
              echo "<span>{$name}</span>";
            }
            else echo $html->link($name, array_merge($old_filter, array_merge($old_filter, array('area_id' => $id))));
          }
        ?>
        </p>
      </li>
      <li class='cl'>
        <div><em>Aleph:</em></div>
        <p>
         <?php 
           print_all_search_options('name_en like', $old_filter, $html);

           foreach(range('A', 'Z') as $name) {
             if (array_key_exists('name_en like', $old_filter) && $old_filter['name_en like'] == $name) {
               echo "<span>{$name}</span>";
             }
             else echo $html->link($name, array_merge($old_filter, array('name_en like' => $name)));
           }
        ?>
        </p>
      </li>
      <li class='last_item cl'>
        <div><em>Other:</em></div>
        <p>
        <span><?php echo $this->Html->link('No properties', array_merge($old_filter, array('property_id' => 0))) ?></span>
        <span><?php echo $this->Html->link('Hidden', array_merge($old_filter, array('status' => 'Hidden'))) ?></span>
        </p>
      </li>      
    </ul>

    <div class="search_box cl">
      <div class='z'>
		<table><tbody><tr><td><input type="text" value="Compound Name, Keywords..." />
		<input type="button" class='button' value="Search"></td></tr></tbody>
		</table>
      </div>
    </div>

<div class="compounds index">
	<h2><?php __('Compounds');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('cid');?></th>
			<th><?php echo $this->Paginator->sort('name_en');?></th>
			<th>Rent / M</th>
			<th><?php echo $this->Paginator->sort('layout');?></th>
			<th><?php echo $this->Paginator->sort('Type', 'property_type');?></th>
			<th><?php echo $this->Paginator->sort('area_id');?></th>
			<th><?php echo $this->Paginator->sort('district_id');?></th>
			<th><?php echo $this->Paginator->sort('Owner', 'ownership');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th title='IsAlone'><?php echo $this->Paginator->sort('A', 'is_alone');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php 
	$i = 0;
	foreach ($compounds as $compound):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}

		$name_en = $compound['Compound']['name_en'];
		$name_zh  = $compound['Compound']['name_zh'];
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $compound['Compound']['id']; ?>&nbsp;</td>
		<td><?php echo $compound['Compound']['cid']; ?>&nbsp;</td>
		<td title='<?php echo $name_en.' - '.$name_zh  ?>'><?php echo getShortName($name_en, 25) ?><br /><?php echo getShortName($name_zh, 25) ?>&nbsp;</td>
		<td><?php echo $compound['Compound']['rent_lower']; ?>&nbsp; - <br /><?php echo $compound['Compound']['rent_upper']; ?>&nbsp;</td>
		<td><?php echo $compound['Compound']['layout']; ?>&nbsp;Brs</td>
		<td title='<?php echo $compound['Compound']['property_type'] ?>'><?php echo getShortName($compound['Compound']['property_type']); ?>&nbsp;</td>
		<td title='<?php echo $compound['Area']['name_full'] ?>'><?php echo getShortName($compound['Area']['name_full'], 14); ?></td>
		<td><?php echo getShortName($compound['District']['name']); ?></td>
		<td><?php echo $compound['Compound']['ownership']; ?>&nbsp;</td>
		<td title='<?php echo $compound['Compound']['status']?>'><?php echo getShortName($compound['Compound']['status'], 5); ?>&nbsp;</td>
		<td <?php if($compound['Compound']['is_alone']) echo "class='green'"; ?>><?php echo $compound['Compound']['is_alone'] ? '是' : '否'; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $compound['Compound']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $compound['Compound']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $compound['Compound']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $compound['Compound']['id'])); ?>
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
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Compound', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('New Property Alone', true), array('controller' => 'properties', 'action' => 'add_alone')); ?></li>
		<li><?php echo $this->Html->link(__('New School', true), array('controller' => 'schools', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List properties', true), array('controller' => 'properties', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Schools', true), array('controller' => 'schools', 'action' => 'index')); ?> </li>
	</ul>
</div>