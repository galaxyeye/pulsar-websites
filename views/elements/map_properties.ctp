         <?php 
            $compound_id = $compound['Compound']['id']; 

            $rent_text = $compound['Compound']['rent_lower'];

            if ($compound['Compound']['rent_lower'] != $compound['Compound']['rent_upper']) {
             $rent_text = $compound['Compound']['rent_lower'].' - '.$compound['Compound']['rent_upper'];
            }
         ?>

         <div class='property-list'>
           <h5>
             <span><a class='red'><?php $property_count = count($compound['Property']); echo $property_count ?></a> <?php echo $property_count - 1 ? 'properties' : 'property' ?></span>
             <span class='rent'><a class='orange1'><?php echo $rent_text; ?></a>&nbsp;RMB / Month</span>
             <span class='order-by-price hidden'>
               <a target='_blank'>Price</a>
               <input type='hidden' value="/properties/index/comound_id:<?php echo $compound_id ?>/page:1/sort:rent/direction:asc" />
             </span>
           </h5>
           <input type='hidden' class='property-count' value="<?php echo count($compound['Property']) ?>" />
           <?php 
             foreach ($compound['Property'] as $property) : 
               $pid = $property['id'];
               $image = "/";
               foreach ($property['PropertyImage'] as $tmp_image) {
                 if ($tmp_image['is_big'] == '1') {
                   $image = $tmp_image['url'];
                 }
               }
           ?>
            <table class="table property <?php echo "property_{$pid}" ?>">
             <tr>
               <td rowspan="2" width="84" class='image'><?php 
                 echo $html->link(
                   $html->image($image, array('width' => 60)), 
                   array('controller' => 'properties', 'action' => 'view', $property['id']), 
                   array('escape' => false, 'target' => '_blank')); ?></td>
               <td class='layout'><?php echo $property['layout']?>&nbsp;Bedrooms&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $property['size']?>&nbsp;sqm</td>
               <td rowspan="2" width='65' class='payment'>
                 <div class='price'><?php echo '¥ '.number_format($property['rent']) ?></div>
               </td>
             </tr>
             <tr>
               <td><?php echo $property['property_type']?></td>
             </tr>
            </table>
           <?php endforeach; ?>
         </div>
