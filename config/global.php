<?php 
  global $all_property_types, $all_layouts, $all_ownerships, $all_property_status, $all_price_ranges, $all_size_ranges;

  $all_property_types = array('Apartment' => 'Apartment', 'Serviced-Apartment' => 'Serviced-Apartment', 'Old House' => 'Old House', 'Villa' => 'Villa', 'Courtyard' => 'Courtyard');
  $all_layouts = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9);
  $all_ownerships = array('None' => 'None', 'Individual' => 'Individual', 'Developer' => 'Developer');
  $all_property_status = array('Published' => 'Published', 'Waiting' => 'Waiting');

  $all_price_ranges = array(10 => 15, 15 => 20,  20 => 25,  25 => 30,  30 => 40,  40 => 50,  50 => 1000000);
  $all_size_ranges = array(50 => 100,  100 => 150,  150 => 200,  200 => 300,  300 => 1000000);
