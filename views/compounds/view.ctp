<?php 
  $cities = array('1' => 'Shanghai', '2' => 'Beijing', '3' => 'Guangzhou');
  $title_for_layout = $compound['Compound']['name_en'].' '.$compound['Compound']['name_zh'].' - '.$cities[$compound['Compound']['city_id']].' '.$compound['Compound']['property_type'].' for rent - Sinorelo';
  $this->set('title_for_layout', $title_for_layout);

  if (!empty($compound['Compound']['meta_keywords'])) $this->set('meta_keywords', $compound['Compound']['meta_keywords']);
  if (!empty($compound['Compound']['meta_description'])) $this->set('meta_description', $compound['Compound']['meta_description']);

  // pr($compound);

  $relative_properties = array();
  foreach ($compound['Property'] as $property) {
    $p = array();
    $p['Property'] = $property;
    $p['Area'] = $compound['Area'];
    $p['PropertyImage'] = $property['PropertyImage'];
 
    array_push($relative_properties, $p);
  }

  // pr($properties);

  // pr(get_property_js_array($properties));
?>

    <?php if (!empty($compound["Compound"]["lat"])) : ?>
    <script type="text/javascript" src="<?php echo GOOGLE_MAP?>"></script>
    <?php endif; ?>

    <script type="text/javascript">
      var compound = <?php echo json_encode($compound) ?>;
      var properties = <?php echo get_property_js_array($relative_properties) ?>
    </script>

    <h1 class="compound-title"><?php echo $compound['Compound']['name_en'].' '.$compound['Compound']['name_zh']; ?></h1>

    <div class="gallery z">
      <div class="cl">
        <div class="big-image z">

        <?php 
          $big_image = '/';
          $small_images = array();

          foreach ($compound['CompoundImage'] as $image) {
  	        if ($image['is_big'] == '1') {
  	          $big_image = $image;
  		        echo $html->image($big_image['url'], array('width' => '300', 'height' => 175));
  	        }
  	        else {
  	          array_push($small_images, $image);
  	        }
          }
         ?>
        </div>

        <div id='hidden-big-image' class='hidden'><?php echo $html->image($big_image['url']) ?></div>

        <div class="small-image z">
          <?php 
            $image_count = count($small_images);

            for ($l = 0; $l < 2; ++$l) {
              $i = 0;

              echo "<div class='row_{$l}'>";
              for (; $i < $image_count && $i < 4; ++$i) {
                if ($l * 4 + $i >= $image_count) break;

                $image = $small_images[$l * 4 + $i];
                if ($image['is_big'] == '0') {
                  echo '<span>'.$html->image($image['url'], array('width' => 145, 'height' => 81)).'</span>';
                } // if
              } // foreach
              echo '</div>';
            }
          ?>
        </div>
      </div>
    </div>

      <div class="compound frame-2-1-l">
      <div class="title">
        <ul class="cl">
          <li class='z'><a class='information' href="#Compound Information">Compound Information</a>|<a class='location'  href="#Location Map">Location Map</a></li>
        </ul>
        <hr />
      </div>

      <a name="Compound Information"></a>
      <table width="98%" class='table compound z'>
        <tr>
          <td width="38%">Property Type : <?php echo $compound['Compound']['property_type']?></td>
          <td width="46%" class='may-split'>Compound :  <?php echo $compound['Compound']['name_en'] . ' ' . $compound['Compound']['name_zh'] ?></td>
          <td width="16%" rowspan="2" class='payment'>
            <div class='price'>¥ <?php echo number_format($compound['Compound']['rent_lower'])?></div>
            <div class='delimiter'> - </div>
            <div class='price'>¥ <?php echo number_format($compound['Compound']['rent_upper'])?></div>
            <div class='unit'>RMB per <?php echo $compound["Compound"]['rent_unit']?></div>
          </td>
        </tr>
        <tr>
          <td>Layout : <?php echo $compound['Compound']['layout']?> Bedrooms</td>
          <td>Area : <?php echo $compound['Area']['name']?></td>
        </tr>
      </table>
  
      <?php if (strlen($compound['Compound']['desc']) > 15) : ?>
      <div class="description">
        <h4>Description</h4>
        <p>
          <?php echo $compound['Compound']['desc'] ?>
        </p>
      </div>
      <?php endif; ?>

      <?php if (strlen($compound['Compound']['features']) > 15) : ?>
      <div class="description features">
        <h4>Features</h4>
        <p>
          <?php echo $compound['Compound']['features'] ?>
        </p>
      </div>
      <?php endif; ?>

      <?php if (strlen($compound['Compound']['locations']) > 15) : ?>
      <div class="description locations">
        <h4>Locations</h4>
        <p>
          <?php echo $compound['Compound']['locations'] ?>
        </p>
      </div>
      <?php endif; ?>

      <?php if (strlen($compound['Compound']['facilities']) > 15) : ?>
      <div class="description facility">
        <h4>Facility</h4>
        <p>
          <?php echo $compound['Compound']['facilities'] ?>
        </p>
      </div>
      <?php endif; ?>

      <?php if (!empty($compound['CompoundLayout'])) : ?>
      <div class="description layout">
         <h4>Main Layouts</h4>
         <table class="table relative layout">
           <tr>
             <th>Size (sqm)</th>
             <th>Layout</th>
             <th>Rental (RMB Per Month)</th>
           </tr>
           <?php foreach ($compound['CompoundLayout'] as $layout): ?>
           <tr>
             <td><?php echo $layout['size'] ?></td>
             <td><?php echo $layout['layout'] ?></td>
             <td><?php echo $layout['rent_desc'] ?></td>
           </tr>
          <?php endforeach; ?>
         </table>
      </div>
      <?php endif; ?>

      <?php if (!empty($compound["Compound"]["lat"])) : ?>
      <div class="description location-map">
      <a name="Location Map"></a>
      <h4>Location Map<a class='blue' href='/compounds/map/compound_id:<?php echo $compound['Compound']['id'] ?>' target='_blank'>Show Big Map</a></h4>
      <div style="height: 400px;" id="map_canvas"></div>
      </div>
      <?php endif; ?>

      <?php if (!empty($compound['Property'])) : ?>
      <div class='property-list'>
          <h4>Properties of This Compound</h4>
            <?php 
              foreach ($compound['Property'] as $pro): 
                $pid = $pro['id'];
        				$image = "/";
                foreach ($pro['PropertyImage'] as $tmp_image) {
                  if ($tmp_image['is_big']) {
                    $image = $tmp_image['url'];
                  }
                }
            ?>

         <table class="table relative property <?php echo "property_{$pid}" ?>">
          <tr>
            <td rowspan="3" width="210" class='image'><?php echo $html->link($html->image($image, array('class' => 'lazyLoad', 'width' => 200, 'height' => 116)), 
                array('controller' => 'properties', 'action' => 'view', $pro['id']), array('escape' => false)); ?></td>
            <td colspan="2" class='name'><em><?php echo $html->link($pro['name_en'] . ' ' . $pro['name_zh'], array('controller' => 'properties', 'action' => 'view', $pro['id'])) ?></em>
            </td>
            <td rowspan="2" width="100" class='payment'>
              <div class='price'><span class='¥'>¥ </span><?php echo number_format($pro['rent']) ?></div>
              <div class='unit'>RMB per <?php echo $pro['rent_unit']?></div>
            </td>
          </tr>
          <tr>
            <td class='layout'><?php echo $pro['layout']?>&nbsp;Bedrooms&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pro['size']?>&nbsp;sqm</td>
            <td><?php echo $compound['Area']['name']?></td>
          </tr>
          <tr>
            <td>Property ID : <?php echo $pro['pid']?></td>
            <td><?php echo $pro['property_type']?></td>
            <td class='action'>
              <div class='add icon z'><a  title='Add to viewing list' href='javascript:;'></a></div>
              <div class='map icon y'><?php echo $html->link(' ', array('controller' => 'compounds', 'action' => 'map', $pro['compound_id']), array('target' => '_blank')) ?></div>
              <?php echo $form->hidden('property_id_'.$pid, array('value' => $pid)) ?>
            </td>
          </tr>
         </table>

        <?php endforeach; ?>
      </div>
      <?php endif;?>

      <div class="pages content-pages"> 
        <?php 
//           echo $paginator->first('previous page', array('class' => 'back'));
//           echo ' ';
//           echo $paginator->numbers(array('separator' => ' '));
//           echo ' ';
//           echo $paginator->next('next page');
         ?>
      </div>

    </div> <!-- end frame-2-1-l -->

    <div class="column frame-2-1-r">
      <?php echo $this->element('online_arrange', array('arranged_properties', $arranged_properties)) ?>
    </div> <!-- end frame-2-1-r -->

    
    
    
    
    

<?php if (!empty($compound["Compound"]["lat"])) : ?>
<script type="text/javascript">

// Init google map
function initialize_map() {
  // load map
  // Shanghai Center

  var position = new google.maps.LatLng(compound["Compound"]["lat"], compound["Compound"]["lng"]);

  var mapOptions = {
    center : position,
    zoom : 16,
    mapTypeId : google.maps.MapTypeId.ROADMAP
  };

  var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

  var marker = new google.maps.Marker({
    position: position,
    map: map,
    title: compound["Compound"]["name_en"]
  });
} // end initialize

function initialize() {
  initialize_map();
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
<?php endif; ?>
