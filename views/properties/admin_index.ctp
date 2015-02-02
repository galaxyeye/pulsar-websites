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
        <span><?php echo $this->Html->link('No compound', array_merge($old_filter, array('compound_id' => 0))) ?></span>
        </p>
      </li>
      
    </ul>

    <div class="search_box cl">
      <div class='z'>
		<table><tbody><tr><td><input type="text" value="Property Name, Keywords..." />
		<input type="button" class='button' value="Search"></td></tr></tbody>
		</table>
      </div>
    </div>
    
    <div class="properties index">
	<h2><?php __('Properties');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('pid');?></th>
			<th><?php echo $this->Paginator->sort('name_en');?></th>
			<th><?php echo $this->Paginator->sort('Compound');?></th>
			<th><?php echo $this->Paginator->sort('T', 'property_type');?></th>
			<th><?php echo $this->Paginator->sort('L', 'layout');?></th>
			<th><?php echo $this->Paginator->sort('S', 'size');?></th>
			<th><?php echo $this->Paginator->sort('rent');?></th>
			<th title='IsAlone'><?php echo $this->Paginator->sort('A', 'is_alone');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($properties as $apartment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
		$name = $apartment['Property']['name_en'].'-'.$apartment['Property']['name_zh'];
		$compoundName = $apartment['Compound']['name_en'].'-'.$apartment['Compound']['name_zh'];
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $apartment['Property']['id']; ?>&nbsp;</td>
		<td><?php echo $apartment['Property']['pid']; ?>&nbsp;</td>
		<td title="<?php echo $name ?>"><?php echo $apartment['Property']['name_en'].'<br />'.$apartment['Property']['name_zh']; ?>&nbsp;</td>
		<td title="<?php echo $compoundName ?>">
			<?php echo $this->Html->link($compoundName, array('controller' => 'compounds', 'action' => 'view', $apartment['Compound']['id'])); ?>
		</td>
		<td><?php echo $apartment['Property']['property_type']; ?>&nbsp;</td>
		<td><?php echo $apartment['Property']['layout']; ?>&nbsp;br</td>
		<td><?php echo $apartment['Property']['size']; ?>&nbsp;sqm</td>
		<td><?php echo $apartment['Property']['rent']; ?>&nbsp;/&nbsp;M&nbsp;</td>
		<td <?php if ($apartment['Property']['is_alone']) echo "class='green'" ?>><?php echo $apartment['Property']['is_alone'] ? '是' : '否'; ?>&nbsp;</td>
		<td class="actions">
		  <?php echo $this->Html->link(__('View', true), array('action' => 'view', $apartment['Property']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $apartment['Property']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $apartment['Property']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $apartment['Property']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Property Alone', true), array('action' => 'add_alone')); ?></li>
		<li><?php echo $this->Html->link(__('List Compounds', true), array('controller' => 'compounds', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Compound', true), array('controller' => 'compounds', 'action' => 'add')); ?> </li>
	</ul>
</div>