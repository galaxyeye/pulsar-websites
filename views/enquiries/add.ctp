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
  var defaultEnquiryPreferredAreasTip = 'Please indicate your preferred areas or refer to the following list';
</script>

<div class="enquiries form">
  <h2>Online Enquiry</h2>
  <p>Thank you for choosing SINORELO. Please fill in the following form,
    we will assign our experienced consultant to contact you as soon as
    possible.</p>

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
  </fieldset>

  <h4>House Requirements</h4>
  <fieldset class='requirement'>
    <ul class='frame-1-1-l'>
      <li>
        <div class="input text budget">
          <label for="EnquiryBudget">Budget (RMB / Month)</label>
          <div class='frame-1-1'>
            <div class='col-l'><span>From:&nbsp;&nbsp;</span><input type="text" id="EnquiryBudgetLower" maxlength="6" name="data[Enquiry][budget_lower]"></div>
            <div class='col-r'><span>To:&nbsp;&nbsp;</span><input type="text" id="EnquiryBudgetUpper" maxlength="6" name="data[Enquiry][budget_upper]"></div>
          </div>
        </div>
      </li>

    <?php 
        echo $this->Form->input_item('lease_term', array('options' => array('3 - 6 Months' => '3 - 6 Months', '6 - 12 Months' => '6 - 12 Months', '12 Months +' => '12 Months +'), 'type' => 'radio', 'div' => 'input radio lease-term'));
        echo $this->Form->input_item('bedrooms', array('options' => array('1 Br' => '1 Br', '2 Brs' => '2 Brs', '3 Brs' => '3 Brs', '4 Brs' => '4 Brs', '5 Brs+' => '5 Brs+'), 'type' => 'radio', 'div' => 'input radio bedrooms'));
        echo $this->Form->input_item('house_type', array('options' => array('Apartment' => 'Apartment', 'Serviced-Apartment' => 'Serviced-Apartment', 'Villa' => 'Villa', 'Old House' => 'Old House', 'Courtyard' => 'Courtyard'), 'multiple' => 'checkbox'));
        echo $this->Form->input_item('furnishings', array('options' => array('Fully Furnished' => 'Fully Furnished', 'Partly Furnished' => 'Partly Furnished', 'Unfurnished' => 'Unfurnished'), 'multiple' => 'checkbox'));
    ?>
    </ul>
    <ul class='frame-1-1-r'>
      <?php 
        echo $this->Form->input_item('city', array('options' => array('Shanghai' => 'Shanghai', 'Beijing' => 'Beijing', 'Guangzhou' => 'Guangzhou', 'Other' => 'Other'), 'default' => 'Shanghai', 'div' => 'city input select'));
        echo $this->Form->input_item('preferred_areas', array('default' => 'Please indicate your preferred areas or refer to the following list', 'div' => 'input text preferred_areas'));
      ?>
      <li class='area-list Shanghai <?php if ($currentCity != 1) echo 'hidden' ?>'>
        <div> 
          <?php
            $i = 0; 
            foreach ($areas1 as $area_id => $area_name) {
              if ($i++ != 0) echo ', ';
              echo '<a>'.$area_name.'</a>';
            }
           ?>
        </div>
      </li>
      <li class='area-list Beijing <?php if ($currentCity != 2) echo 'hidden' ?>'>
        <div>          
          <?php
            $i = 0; 
            foreach ($areas2 as $area_id => $area_name) {
              if ($i++ != 0) echo ', ';
              echo '<a>'.$area_name.'</a>';
            }
           ?>
        </div>
      </li>
      <li class='area-list Guangzhou <?php if ($currentCity != 3) echo 'hidden' ?>'>
        <div>          
          <?php
            $i = 0; 
            foreach ($areas3 as $area_id => $area_name) {
              if ($i++ != 0) echo ', ';
              echo '<a>'.$area_name.'</a>';
            }
           ?>
        </div>
      </li>
      <?php echo $this->Form->input_item('comments'); ?>
    </ul>
  </fieldset>

  <?php echo $this->Form->end('Submit'); ?>
</div>
<br />
<br />
