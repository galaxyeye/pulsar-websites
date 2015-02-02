<?php 

   if (isset($old_filter['property_type']) && $old_filter['property_type'] != 'null') {
     $title_for_layout = str_replace('{{property-type}}', $old_filter['property_type'], $title_for_layout);
   }
   else {
     $title_for_layout = str_replace('{{property-type}}', 'Apartments', $title_for_layout);
   }

   $this->set('title_for_layout', $title_for_layout);

// 	 This lines are for pagination
//   $args = $this->passedArgs;
//   unset($args['page']);
//   $paginator->options(array('url' => $args));

  $sort_url = $paginator->options['url'];
  $sort_url['page'] = null;

  global $all_property_types;

  unset($old_filter['sort']);
  unset($old_filter['page']);
  unset($old_filter['direction']);

  // pr($compounds);
?>
    <div class="search_box cl">
      <div class='z'>
        <input type="text" value="Compound Name, Keywords..." />
        <input class='button'  type="button" value="Compound Search" />
        <span><?php echo $this->Html->link('Map Search', array('controller' => 'compounds', 'action' => 'map'), array('target' => 'blank')) ?></span>
      </div>
    </div>

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
      <li class='last_item cl'>
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
    </ul>

    <div class="compound-detail column frame-2-1-l">
      <div class="title">
        <div class='cl'>
          <ul class="tb">
            <li class="z title-text"><em><?php echo $compound_count ?> Compounds Found</em></li>
            <li class='y'><a href="/compounds/map" target='_blank' class='map-search'>Map Search</a></li>
            <li class='y'><?php echo $paginator->sort('A - Z', 'name_en', array('url' => array('page' => null))) ?></li>
          </ul>
        </div>
      </div>

      <div class='compound-list'>
        <?php 
          foreach ($compounds as $compound): 
            $image = "/";
            foreach ($compound['CompoundImage'] as $tmp_image) {
              if ($tmp_image['is_big'] == '1') {
                $image = $tmp_image['url'];
              }
            }
        ?>

        <table class="table compound">
          <tr>
            <td rowspan="3" width="210" class='image'><?php echo $html->link($html->image($image, array('class' => 'lazyLoad', 'width' => 200, 'height' => 116)), 
                array('action' => 'view', $compound["Compound"]['id']), array('escape' => false)); ?></td>
            <td colspan="2" class='name'><em><?php echo $html->link($compound["Compound"]['name_en'] . ' ' . $compound["Compound"]['name_zh'],
                  array('controller' => 'compounds', 'action' => 'view', $compound["Compound"]['id'])) ?></em>
            </td>
            <td rowspan="3" width="100" class='payment'>
              <div class='price'>¥ <?php echo number_format($compound['Compound']['rent_lower'])?></div>
              <div class='delimiter'> - </div>
              <div class='price'>¥ <?php echo number_format($compound['Compound']['rent_upper'])?></div>
              <div class='unit'>RMB per <?php echo $compound["Compound"]['rent_unit']?></div>
            </td>
            </tr>
          <tr>
            <td class='layout'><?php echo $compound["Compound"]['layout']?> Bedrooms</td>
            <td><?php echo $compound["Area"]['name']?></td>
          </tr>
          <tr>
            <td><?php echo $compound["Compound"]['property_type']?></td>
            <td><div class='map icon'><?php echo $html->link(' ', array('action' => 'map', $compound["Compound"]['id']), array('target' => '_blank')) ?></div></td>
          </tr>
        </table>

        <?php endforeach; ?>
      </div>

      <div class="pages content-pages">
        <?php 
          echo $paginator->first('previous page');
          echo $paginator->numbers(array('separator' => ' '));
          echo $paginator->next('next page');
         ?>
      </div>

    </div> <!-- end frame-2-1-l -->

    <div class="column frame-2-1-r">
      <?php echo $this->element('online_arrange', array('arranged_properties', $arranged_properties)) ?>
    </div> <!-- end frame-2-1-r -->
