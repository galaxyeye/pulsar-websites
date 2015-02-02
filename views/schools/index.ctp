<?php

   if (isset($old_filter['property_type']) && $old_filter['property_type'] != 'null') {
     $title_for_layout = str_replace('{{property-type}}', $old_filter['property_type'], $title_for_layout);
   }
   else {
     $title_for_layout = str_replace('{{property-type}}', 'Apartments', $title_for_layout);
   }

   $this->set('title_for_layout', $title_for_layout);

	// This lines are for pagination
// 	$args = $this->passedArgs;
// 	unset($args['page']);
// 	$paginator->options(array('url'=>$args));

	unset($old_filter['sort']);
	unset($old_filter['page']);
	unset($old_filter['direction']);

	// pr($areas);
	// pr($schools);
	
// 	$school_ids = array();
// 	foreach ($schools as $school) {
// 	  $school_ids[] = $school['School']['id'];
// 	}
	// pr($school_ids);
	// $school_ids = implode(',', $school_ids);	
?>

    <div class="search_box cl">
      <div>
        <input type="text" value="School Name, Keywords..." />
        <input class='button' type="button" value="School Search" />
        <span><?php echo $this->Html->link('Map Search', array('controller' => 'compounds', 'action' => 'map'), array('target' => 'blank')) ?></span>
      </div>
    </div>

    <ul class="search_options">
      <li class='cl'>
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

    <div class="schools column frame-2-1-l">

      <div class="title">
        <div class='cl'>
          <ul class="tb">
            <li class="z title-text"><em><?php echo $school_count ?> Schools Found</em></li>
            <li class='y'><a href="/compounds/map" target='_blank' class='map-search'>Map Search</a></li>
            <li class='y'><?php echo $paginator->sort('A - Z', 'name_en') ?></li>
          </ul>
        </div>
      </div>

			<div class="school-list cl">
				<?php 
					foreach ($schools as $school): 
				?>
						<table class='table school'>
						  <tr>
						    <td rowspan="3" width="210" class='image'>
						      <?php echo $html->image($school['School']['image'], array('class' => 'lazyLoad', 'width' => 200, 'height' => 116)) ?></td>
						    <td colspan="3" class='blue name'><?php echo $school['School']['name_en']?></td>
						  </tr>
						  <tr>
						    <td colspan='2' class='may-split' title='<?php echo $school['School']['type'] ?>'><?php echo getShortName($school['School']['type'], 60)?></td>
						    <td rowspan="2" width="80"><div class='map icon'><?php echo $html->link(' ', array('controller' => 'compounds', 'action' => 'map', 'school_id' => $school['School']['id']), array('target' => '_blank')) ?></div></td>
						  </tr>
						  <tr>
						    <td><?php echo $school['Area']['name']?></td>
						    <td width="200"><a href='http://<?php echo $school['School']['website']?>' class='gray'><?php echo $school['School']['website'] ?></a></td>
						  </tr>
						</table>

					  <?php 
						  foreach ($school['Compound'] as $compound): 
						    $image = "/";
							  foreach ($compound['CompoundImage'] as $tmp_image) {
								  if ($tmp_image['is_big']) {
									  $image = $tmp_image['url'];
								  }
						    }
					  ?>

			      <table class="table compound">
			        <tr>
						    <td rowspan="3" width="210" class='image'><?php echo $html->link($html->image($image, array('width' => 200, 'height' => 116)), 
						    		array('controller' => 'compounds', 'action' => 'view', $compound['id']), array('escape' => false)); ?></td>
						    <td colspan="2"><?php echo $html->link($compound['name_en'] . ' ' . $compound['name_zh'], array('controller' => 'compounds', 'action' => 'view', $compound['id'])) ?>
						    </td>
						    <td rowspan="3" width="150" class='payment'>
						    	<div class='price'>¥<?php echo number_format($compound['rent_lower']) ?></div>
						    	<div class='delimiter'> - </div>
						    	<div class='price'>¥ <?php echo number_format($compound['rent_upper']) ?></div>
		  		        <div class='unit'>RMB per <?php echo $compound['rent_unit']?></div>
		  		      </td>
						  </tr>
						  <tr>
						    <td class='layout'><?php echo $compound['layout']?> Bedrooms</td>
						    <td><div class='may-split'><?php echo $compound['Area']['name']?></div></td>
						  </tr>
						  <tr>
						    <td><?php echo $compound['property_type'] ?></td>
						    <td><div class='map icon'><?php echo $html->link(' ', array('controller' => 'compounds', 'action' => 'map', $compound['id'])) ?></div></td>
						  </tr>
				    </table>
	        <?php endforeach; ?>
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
