  <div class='compound-list z'>
		<?php 
			foreach ($compounds as $compound): 
			  $image = "/";
				foreach ($compound['CompoundImage'] as $tmp_image) {
					if ($tmp_image['is_big'] == '1') {
						$image = $tmp_image['url'];
					}
			  }

			  $compound_id = $compound['Compound']['id'];
		?>

		<div class='z' id="compound_<?php echo $compound_id ?>">
		  <div class='compound compound-<?php echo $compound_id ?> cl'>
    		  <h4 class='green_backgroud2 white'>
    		    <?php 
    		      if ($compound["Compound"]['property_type'] != 'Old House' && $compound["Compound"]['property_type'] != 'Courtyard') {
    		        echo $html->link(
    		          $compound["Compound"]['name_en'] . ' ' . $compound["Compound"]['name_zh'], 
    		          array('action' => 'view', $compound_id), 
    		          array('class' => 'white', 'target' => '_blank'));
    		      }
    		      else {
    		        echo "<a class='white'>".$compound["Compound"]['name_en'] . ' ' . $compound["Compound"]['name_zh'].'</a>';
    		      }
    		    ?>
    		    <span class='area'><?php echo $compound["Area"]['name'] ?></span>
    		  </h4>
    		  <div class='frame-1-3 z'>
    		    <div class='filter col-l'>
    		      <div class='bedrooms'>
    		        <h5>Bedrooms:<a class="orange1" onclick="javascript:on_bedrooms_inplace_changed(<?php echo $compound_id ?>, 0, 0);">All</a></h5>
                <a onclick="javascript:on_bedrooms_inplace_changed(<?php echo $compound_id ?>, 1, 1);">1Br</a>
                <a onclick="javascript:on_bedrooms_inplace_changed(<?php echo $compound_id ?>, 2, 2);">2Brs</a>
                <a onclick="javascript:on_bedrooms_inplace_changed(<?php echo $compound_id ?>, 3, 3);">3Brs</a>
                <a onclick="javascript:on_bedrooms_inplace_changed(<?php echo $compound_id ?>, 4, 4);">4Brs</a>
                <a onclick="javascript:on_bedrooms_inplace_changed(<?php echo $compound_id ?>, 5, 10);">5Brs+</a>
    		      </div>
    		      <div class='size'>
    			      <h5>Size(sqm):<a class="orange1" onclick="javascript:on_size_inplace_changed(<?php echo $compound_id ?>, 0, 0)">All</a></h5>
                <a onclick="javascript:on_size_inplace_changed(<?php echo $compound_id ?>, 50, 100)">50 ~ 100</a>
                <a onclick="javascript:on_size_inplace_changed(<?php echo $compound_id ?>, 100, 150)">100 ~ 150</a>
                <a onclick="javascript:on_size_inplace_changed(<?php echo $compound_id ?>, 150, 200)">150 ~ 200</a>
                <a onclick="javascript:on_size_inplace_changed(<?php echo $compound_id ?>, 200, 300)">200 ~ 300</a>
                <a onclick="javascript:on_size_inplace_changed(<?php echo $compound_id ?>, 300, 1000000)">over 300</a>    			      
    		      </div>
    		    </div>
    			  <div class='col-r mutable-property-list-view'>

              <?php echo $this->element('map_properties', array('compound' => $compound)) ?>

  			    </div>
			  </div> <!-- compound  -->
		  </div> <!-- compound wrapper -->

    </div> <!-- compound_{compound_id} -->
    <?php endforeach; ?>

  </div>
