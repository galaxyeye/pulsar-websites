<?php 
  $this->layout = 'empty';

  // pr($compounds);
  
  if (!empty($compounds)) : 
    echo $this->element('map_properties', array('compound' => $compounds[0]));
  else :
?>

         <div class='property-list'>
           <h5>
             <span><a class='red'>No property found</a></span>
           </h5>
         </div>
<?php endif; ?>
