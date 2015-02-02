<?php 
  $cities = array('1' => 'Shanghai', '2' => 'Beijing', '3' => 'Guangzhou');
  $title_for_layout = $property['Property']['name_en'].' '.$property['Property']['name_zh'].' - '.$cities[$property['Property']['city_id']].' '.$property['Property']['property_type'].' for rent - Sinorelo';
  $this->set('title_for_layout', $title_for_layout);
  
  if (!empty($property['Property']['meta_keywords'])) $this->set('meta_keywords', $property['Property']['meta_keywords']);
  if (!empty($property['Property']['meta_description'])) $this->set('meta_description', $property['Property']['meta_description']);

  // pr($this);

  // pr($property);

  $relative_properties = array();
  if (!empty($property['Compound']['Property'])) {
    foreach ($property['Compound']['Property'] as $pro) {
     $p = array();
     $p['Property'] = $pro;
     $p['Area'] = $pro['Area'];
     $p['PropertyImage'] = $pro['PropertyImage'];

     array_push($relative_properties, $p);
    }
  }

?>

  <h1 class="property-title">
  	<?php echo $property['Property']['name_en'] ?>&nbsp; -
		<?php echo $property['Property']['layout']?>&nbsp;brs - 
		<?php echo $property['Property']['size']?>&nbsp;sqm -
		<?php echo $property['Property']['name_zh']; ?>
  </h1>

  <div class="gallery z">
    <div class="cl">
      <div class="z big-image">
        <?php 
          $big_image = '/';
          $small_images = array();

          foreach ($property['PropertyImage'] as $image) {
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

      <div class="z small-image">
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

  <div class="property frame-2-1-l">
    <div class="title">
      <ul class="cl">
        <li class='z'><a class='information' href="#Property Information">Property Information</a>|<a class='location'  href="#Location Map">Location Map</a></li>
        <li class='y add-to-list last action'>
          <a class='add' title='Add to viewing list'>>> Add to Viewing List</a>
          <?php echo $form->hidden('property_id_'.$property["Property"]["id"], array('value' => $property["Property"]["id"])) ?>
        </li>
      </ul>
      <hr />
    </div>

    <a name="Property Information"></a>
    <table width="98%" class='table property-main'>
    <tr>
      <td width="38%">Property ID : <?php echo $property['Property']['pid']?></td>
      <td width="46%">Compound : 
       <?php 
        if ($property['Property']['is_alone'] == 1) {
          echo "None";
				}
				else {
					echo $html->link($property['Compound']['name_en'] . ' ' . $property['Compound']['name_zh'],
					    array('controller' => 'compounds', 'action' => 'view', $property['Property']['compound_id']), array('class' => 'blue'));
				}
			?>
      </td>
      <td width="16%" rowspan="3" class='payment'>
        <div class='price'>¥<?php echo number_format($property['Property']['rent']) ?><br /></div>
        <div>RMB per <?php echo $property['Property']['rent_unit']?></div>
      </td>
    </tr>
    <tr>
      <td>Layout : <?php echo $property['Property']['layout']?>&nbsp;Bedrooms</td>
      <td>Property Type : <?php echo $property['Property']['property_type']?></td>
    </tr>
    <tr>
      <td>Size : <?php echo $property['Property']['size']?>&nbsp;sqm</td>
      <td>Area : <?php echo $property['Area']['name']?></td>
    </tr>
    </table>

    <?php if (strlen($property['Property']['desc']) > 15) : ?>
    <div class="description">
    <h4>Description</h4>
      <p>
        <?php echo $property['Property']['desc'] ?>
      </p>
    </div>
    <?php endif; ?>

    <?php if (strlen($property['Property']['location']) > 15) : ?>
    <div class="description location">
    <h4>Location</h4>
      <p>
        <?php echo $property['Property']['location'] ?>
      </p>
    </div>
    <?php endif; ?>

    <?php if (!empty($property["Property"]["lat"])) : ?>
    <div class="description location-map">
      <a name="Location Map"></a>
      <h4>Location Map<a class='blue' href='/compounds/map/compound_id:<?php echo $property["Property"]['compound_id'] ?>' target='_blank'>Show Big Map</a></h4>
      <div style="height: 400px;" id="map_canvas"></div>
    </div>
    <?php endif; ?>

    <?php if (!empty($property['Property']['compound_id']) && count($property['Compound']['Property']) > 1) : ?>
    <div class='property-list'>
      <h4>More of This Compound</h4>
      <?php 
        foreach ($property['Compound']['Property'] as $pro) : 
          $id = $pro['id'];
        	if ($property['Property']['id'] == $id) continue;
        	$image = "/";
	        foreach ($pro['PropertyImage'] as $tmp_image) {
  	        if ($tmp_image['is_big']) {
    	      $image = $tmp_image['url'];
          }
        }
      ?>

         <table class="table relative property <?php echo "property_{$id}" ?>">
          <tr>
            <td rowspan="3" width="210" class='image'><?php echo $html->link($html->image($image, array('class' => 'lazyLoad', 'width' => 200, 'height' => 116)), 
                array('action' => 'view', $pro['id']), array('escape' => false)); ?></td>
            <td colspan="2" class='name'><em><?php echo $html->link($pro['name_en'] . ' ' . $pro['name_zh'], array('action' => 'view', $pro['id'])) ?></em>
            </td>
            <td rowspan="2" width="100" class='payment'>
              <div class='price'><span class='¥'>¥ </span><?php echo number_format($pro['rent']) ?></div>
              <div class='unit'>RMB per <?php echo $pro['rent_unit']?></div>
            </td>
          </tr>
          <tr>
            <td class='layout'><?php echo $pro['layout']?>&nbsp;Bedrooms&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $pro['size']?>&nbsp;sqm</td>
            <td><?php echo $property['Area']['name']?></td>
          </tr>
          <tr>
            <td>Property ID : <?php echo $pro['pid']?></td>
            <td><?php echo $pro['property_type']?></td>
            <td class='action'>
              <div class='add icon z'><a  title='Add to viewing list' href='javascript:;' class='add'></a></div>
              <div class='map icon y'><?php echo $html->link(' ', array('controller' => 'compounds', 'action' => 'map', $pro['compound_id']), array('target' => '_blank')) ?></div>
              <?php echo $form->hidden('property_id_'.$id, array('value' => $id)) ?>
            </td>
          </tr>
         </table>

      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="pages content-pages">
    <?php 
//       echo $paginator->first('previous page', array('class' => 'previous_page'));
//       echo ' ';
//       echo $paginator->numbers(array('separator' => ' '));
//       echo ' ';
//       echo $paginator->next('next page', array('class' => 'next_page'));
     ?>
    </div>

  </div> <!-- end frame-2-1-l -->

  <div class="column frame-2-1-r">
     <?php echo $this->element('online_arrange', array('arranged_properties', $arranged_properties)) ?>
  </div> <!-- end frame-2-1-r -->

<script type="text/javascript">
 var property = <?php echo json_encode($property) ?>;
 var properties = <?php echo get_property_js_array($relative_properties) ?>
</script>

<?php if (!empty($property["Property"]["lat"]) && !empty($property["Property"]["lng"])) : ?>

<script type="text/javascript" src="<?php echo GOOGLE_MAP?>"></script>

<script type="text/javascript">

var property = <?php echo json_encode($property) ?>;
var properties = <?php echo get_property_js_array($relative_properties) ?>

// Init google map
function initialize_map() {
  // load map
  // Shanghai Center

  var position = new google.maps.LatLng(property["Property"]["lat"], property["Property"]["lng"]);

  var mapOptions = {
    center : position,
    zoom : 16,
    mapTypeId : google.maps.MapTypeId.ROADMAP
  };

  var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

  var marker = new google.maps.Marker({
    position: position,
    map: map,
    title: property["Property"]["name_en"]
  });
} // end initialize

function initialize() {
  initialize_map();
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
<?php endif; ?>
