<?php 
   if (isset($old_filter['property_type']) && $old_filter['property_type'] != 'null') {
     $title_for_layout = str_replace('{{property-type}}', $old_filter['property_type'], $title_for_layout);
   }
   else {
     $title_for_layout = str_replace('{{property-type}}', 'Apartments', $title_for_layout);
   }

   $this->set('title_for_layout', $title_for_layout);

?>

<script type="text/javascript">
  var arranged_properties = <?php echo get_property_js_array($arranged_properties) ?>;
</script>

<script id="arrange-item-template" type="text/x-jsrender">

    <li class='arrange-item arrange-item-{{:id:}}'>
      <table class="table property">
          <tbody><tr>
            <td width="210" class="image" rowspan="3"><a href="/properties/view/{{:id:}}" target="_blank" ><img width="200" height="116" alt="" class="lazyLoad" src="/img/{{:image:}}"></a></td>
            <td class="name" colspan="2"><em><a href="/properties/view/{{:id:}}" target="_blank" >{{:name:}}</a></em>
            </td>
            <td width="100" class="payment" rowspan="2">
              <div class="price"><span class="¥">¥ </span>{{:rent:}}</div>
              <div class="unit">RMB per Month</div>
            </td>
          </tr>
          <tr>
            <td class="layout">{{:layout:}}&nbsp;Bedrooms&nbsp;&nbsp;&nbsp;&nbsp;{{:size:}}&nbsp;sqm</td>
            <td>{{:area:}}</td>
          </tr>
          <tr>
            <td>Property ID : {{:pid:}}</td>
            <td>{{:property_type:}}</td>
            <td class="action">
              <div class='del icon z'><a href='javascript:;'></a></div>
              <input type="hidden" id="property_id_{{:id:}}" value={{:id:}} name="data[Enquiry][property_ids][{{:id:}}]">
              <div class='map icon y'><a target="_blank" href="/compounds/map/compound_id:{{:compound_id:}}"></a></div>
            </td>
          </tr>
         </tbody>
      </table>
    </li>

</script>

<div class="enquiries form">
  <h2>Arrange a Viewing</h2>
  <p>Please send us the following viewing request to make a viewing appointment. You could also call our hotline <span class='orange1'>+86 181 4978 6973</span> if you have any questions.</p>

  <?php if (isset($arranged_properties) && !empty($arranged_properties)) : ?>
  <h4>Viewing List&nbsp;&nbsp;<span class='number orange1'><?php echo count($arranged_properties) ?></span></h4>
  <div class='cl'>
    <div class='view-list arrange-items property-list'>
      <ul>
        <li class='default-arrange-item'>No property choosed</li>
      </ul>
    </div>
  </div>
  <?php endif; ?>

  <?php echo $this->Form->create('Enquiry');?>
  <h4>Personal Profile</h4>
  <fieldset class='profile'>
    <ul class='frame-1-1-l'>
    <?php 
        echo $this->Form->input_item('gender', array('options' => array('Mr.' => 'Mr.', 'Ms.' => 'Ms.')));
        echo $this->Form->input_item('cell_phone');
        echo $this->Form->input_item('nationality');
    ?>
    </ul>
    <ul class='frame-1-1-r'>
    <?php 
        echo $this->Form->input_item('full_name');
        echo $this->Form->input_item('email');
        echo $this->Form->input_item('company');
    ?>
    </ul>
    <ul>
    <?php 
        echo $this->Form->input_item('viewing_trip', array('options' => array('Immediately' => 'Immediately', 'Couple of weeks' => 'Couple of weeks', 'About a month' => 'About a month', '1 - 3 months' => '1 - 3 months')));
        echo $this->Form->input_item('comments', array('label' => 'Please put any special requirements in below box'));
    ?>
    </ul>
  </fieldset>

  <?php echo $this->Form->end('Submit'); ?>
</div>
<br />
<br />
