<?php 

   if (isset($old_filter['property_type']) && $old_filter['property_type'] != 'null') {
     $title_for_layout = str_replace('{{property-type}}', $old_filter['property_type'], $title_for_layout);
   }
   else {
     $title_for_layout = str_replace('{{property-type}}', 'Apartments', $title_for_layout);
   }

   $this->set('title_for_layout', $title_for_layout);

  // This lines are for pagination
//   $args = $this->passedArgs;
//   unset($args['page']);
//   $paginator->options(array('url'=>$args));

  // pr($paginator);

  global $all_property_types;
  $all_price_ranges = array(10 => 15, 15 => 20,  20 => 25,  25 => 30,  30 => 40,  40 => 50,  50 => 1000000);
  $all_size_ranges = array(50 => 100,  100 => 150,  150 => 200,  200 => 300,  300 => 1000000);

  unset($old_filter['sort']);
  unset($old_filter['page']);
  unset($old_filter['direction']);
?>

<script type="text/javascript">
  var properties = <?php echo get_property_js_array($properties) ?>
</script>

    <div class="search_box cl">
      <div class='z'>
        <input type="text" value="Property ID, Keywords..." />
        <input class='button' type="button" value="Property Search" />
        <span><?php echo $this->Html->link('Map Search', array('controller' => 'compounds', 'action' => 'map'), array('target' => 'blank')) ?></span>
      </div>
    </div>

    <ul class="search_options">
      <li class='property_type cl'>
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
      <li class='search_by_area cl'>
        <div><em>Area:</em></div>
        <p>
        <?php 
          print_all_search_options('area_id', $old_filter, $html);

          foreach($areas as $id => $name) {
            if (array_key_exists('area_id', $old_filter) && $old_filter['area_id'] == $id) {
              echo "<span>{$name}</span>";
            }
            else echo $html->link($name, array_merge($old_filter, array('area_id' => $id)));
          }
        ?>
        </p>
      </li>
      <li class='price cl'>
       <div><em>Price (RMB):</em></div>
       <p>
        <?php 
         print_all_search_options('rent', $old_filter, $html);

         foreach($all_price_ranges as $lower => $upper) {
           $name = $lower."K ~ ".$upper."K";
           if ($upper >= 1000000) {
             $name = 'Over '.$lower."K";
           }

           $param = ($lower * 1000).",".($upper * 1000);

           if (array_key_exists('rent', $old_filter) && $old_filter['rent'] == $param) {
             echo "<span>{$name}</span>";
           }
           else {
             echo $this->Html->link($name, array_merge($old_filter, array('rent' => $param)));
           }
         }
        ?>
        </p>
      </li>
      <li class='bedrooms cl'>
        <div><em>Bedrooms:</em></div>
        <p>
        <?php 
         print_all_search_options('layout', $old_filter, $html);

         for($i = 1; $i < 6; ++$i) {
           $text = $i."Brs";
           $layout = $i;

           if ($i == 1) $text = $i."Br";
           if ($i == 5) {
             $text = $i."Brs+";
             $layout = $i.','.'20';
           }

           if (array_key_exists('layout', $old_filter) && $old_filter['layout'] == $layout) {
             echo "<span>{$text}</span>";
           }
           else {
             echo $this->Html->link($text, array_merge($old_filter, array('layout' => $layout)));
           }
         }
        ?>
        </p>
      </li>
      <li class='size last_item cl'>
        <div><em>Size (sqm):</em></div>
        <p>
        <?php 
         print_all_search_options('size', $old_filter, $html);

         foreach($all_size_ranges as $lower => $upper) {
           $name = $lower." ~ ".$upper;
           if ($upper >= 1000000) {
             $name = 'Over '.$lower;
           }

           $param = $lower.",".$upper;

           if (array_key_exists('size', $old_filter) && $old_filter['size'] == $param) {
             echo "<span>{$name}</span>";
           }
           else {
             echo $this->Html->link($name, array_merge($old_filter, array('size' => $param)));
           }
         }
        ?>
        </p>
      </li>
    </ul>
    <div id='collapseSearchBox' class='hidden'>x</div>

    <div class="properties frame-2-1-l">
      <div class="title">
        <div class='cl'>
          <ul class="tb">
            <li class="z title-text"><em><?php echo $property_count ?> Properties Found</em></li>
            <li class='y'><a href="/compounds/map" target='_blank' class='map-search'>Map Search</a></li>
            <li class='y'><?php echo $paginator->sort('Bedrooms', 'layout', array('url' => array('page' => null))) ?></li>
            <li class='y'><?php echo $paginator->sort('Size', 'size', array('url' => array('page' => null))) ?></li>
            <li class='y'><?php echo $paginator->sort('Price', 'rent', array('url' => array('page' => null))) ?></li>
          </ul>
        </div>
      </div>

      <div class='property-list'>
        <?php 
          foreach ($properties as $property): 
            $pid = $property['Property']['id'];
            $image = "/";
            foreach ($property['PropertyImage'] as $tmp_image) {
              if ($tmp_image['is_big'] == '1') {
                $image = $tmp_image['url'];
              }
            }
        ?>
         <table class="table property <?php echo "property_{$pid}" ?>">
          <tr>
            <td rowspan="3" width="210" class='image'><?php echo $html->link($html->image($image, array('class' => 'lazyLoad', 'width' => 200, 'height' => 116)), 
                array('action' => 'view', $property['Property']['id']), array('escape' => false)); ?></td>
            <td colspan="2" class='name'><em><?php echo $html->link($property['Property']['name_en'] . ' ' . $property['Property']['name_zh'], array('action' => 'view', $property['Property']['id'])) ?></em>
            </td>
            <td rowspan="2" width="100" class='payment'>
              <div class='price'><span class='¥'>¥ </span><?php echo number_format($property['Property']['rent']) ?></div>
              <div class='unit'>RMB per <?php echo $property['Property']['rent_unit']?></div>
            </td>
          </tr>
          <tr>
            <td class='layout'><?php echo $property['Property']['layout']?>&nbsp;Bedrooms&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $property['Property']['size']?>&nbsp;sqm</td>
            <td><?php echo $property['Area']['name']?></td>
          </tr>
          <tr>
            <td>Property ID : <?php echo $property['Property']['pid']?></td>
            <td><?php echo $property['Property']['property_type']?></td>
            <td class='action'>
              <div class='add icon z'><a title='Add to viewing list' href='javascript:;'> </a></div>
              <div class='map icon y'><?php echo $html->link(' ', array('controller' => 'compounds', 'action' => 'map', $property['Property']['compound_id']), array('target' => '_blank')) ?></div>
              <?php echo $form->hidden('property_id_'.$pid, array('value' => $pid)) ?>
            </td>
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

    <div class="frame-2-1-r">      
      <?php echo $this->element('online_arrange', array('arranged_properties', $arranged_properties)) ?>
    </div> <!-- end frame-2-1-r -->

