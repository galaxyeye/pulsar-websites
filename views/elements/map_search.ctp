<?php 
  $s = $search_options;
  
  function mark_if_checked($opt, $property_type) {
    $property_types = explode('|', $opt['property_types']);
    $property_types = array_unique($property_types);

    if (in_array($property_type, $property_types)) {
      echo 'checked=checked';
    }
  }

  function show_spec($s, $spec) {
    $text = '';
    if ($spec == 'Price') {
      if (!$s['js']) {
        $text = 'Price';
      }
      else {
        if ($s['rent'] == null) {
         $text = 'Price';
        }
        else if ($s['rent'] == '50000,1000000') {
         $text = 'Over 50000';
        }
        else {
         $text = str_replace(',', '-', $s['rent']);
        }

        // $text .= 'RMB';
      }
    }

    if ($spec == 'Size') {
      if (!$s['js']) {
        $text = 'Size';
      }
      else {
        if ($s['size'] == null) {
          $text = 'Size';
        }
        else if ($s['size'] == '300,1000000') {
          $text = 'Over 300';
        }
        else {
         $text = str_replace(',', '-', $s['size']);
        }
      }

      // $text .= 'sqm';
    }

    if ($spec == 'Bedrooms') {
      if (!$s['js']) {
       $text = 'Bedrooms';
      }
      else {
        if ($s['layout'] == null) {
          $text = 'Bedrooms';
        }
        else if ($s['layout'] == '1,1') {
          $text = '1'.' Br';
        }
        else if ($s['layout'] == '5,20') {
          $text = '5+'.' Brs';
        }
        else {
          $text = substr($s['layout'], 2).' Brs';
        }
      }
    }

    echo $text;
   }
?>

    <td height="15%" valign="top">
      <table width="100%" >
      <tr>
        <td width="20%" height="110" align="center" class="logo">
          <table width="282" >
            <tr><td width="282" align="center"><a href="/"><img width="200" height="60" alt="" style="cursor: pointer;" src="/img/logo.gif"></a></td></tr>
          </table>
        </td>

          <td width="37%" valign="bottom"><table width="520">
              <tr>
                  <td width="85%">
                    <input type="text" name="search" class="search large" value="Compound Name, Keywords..." id="search_key"  onkeyup="on_search_key_change()"/>
                    <div id="compound_key"></div>
                  </td>
                  <td width="15%" align="center"><input type="image" src="/img/sinorelo/search.gif" class="button" onclick="reload()" /></td>
              </tr>

              <tr>
                <td colspan="2"><table width="85%">
                    <tr>
                      <td width="16%" height="50">Search by </td>
                      <td width="84%" class="organization">

                        <div class="map-menu-area">
                           <span>Area</span>
                           <div class="div_areas float_layer hidden">
                             <a  onclick="javascript:choose_area(null)">All</a>
                             <?php foreach ($areas as $area_id => $area_name) : ?>
                             <a  onclick="javascript:choose_area('<?php echo $area_id ?>')"><?php echo $area_name ?></a>
                             <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="map-menu-school">
                            <span>School</span>
  
                            <div class="div_area_schools float_layer hidden">
                              <div>
                                <a onclick="javascript:choose_school(null)">All</a>
                              </div>
  
                              <?php 
                                $i = 0;
                                foreach ($area_schools as $schools) : 
                                  ++$i;
                                  $area_id = $schools['Area']['id'];
                                  $area_name = $schools['Area']['name'];
  
                                  unset($schools['Area']);
  
                                  $school_ids_by_area = '';
                                  for ($i = 0; $i < count($schools); ++$i) {
                                    if ($i > 0) $school_ids_by_area .= ',';
                                    $school_ids_by_area .= $schools[$i]['School']['id'];
                                  }
                              ?>
                              <div class='div_schools'>
                                <a onclick="javascript:choose_school(<?php echo $school_ids_by_area ?>)"><?php echo $area_name ?></a>
                                <div class="schools float_layer hidden area-<?php echo $i ?>>">
                                  <?php foreach($schools as $school) : ?>
                                  <a onclick="javascript:choose_school(<?php echo $school['School']['id'] ?>)"><?php echo $school['School']['name_en'] ?></a>
                                  <?php endforeach; ?>
                                </div>
                              </div>
                              <?php endforeach; ?>
                          </div>

                        </div>

                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          </td>
          <td width="43%" align="right" valign="bottom" class="back-home"></td>
        </tr>

        <tr>
          <td height="26" colspan="3" bgcolor="#E5EBF9" class="chooser">
            <table width="100%" >
              <tr>
                <td width="39%">

                  <div class="price-chooser">
                    <div class='chooser'>
                      <span><?php show_spec($s, 'Price') ?></span>
                      <div class="float_layer hidden">
                        <a onclick="javascript:on_price_changed(0, 0)" >All (RMB)</a>
                        <a onclick="javascript:on_price_changed(10000, 15000)" >10000 ~ 15000</a>
                        <a onclick="javascript:on_price_changed(15000, 20000)" >15000 ~ 20000</a>
                        <a onclick="javascript:on_price_changed(20000, 25000)" >20000 ~ 25000</a>
                        <a onclick="javascript:on_price_changed(25000, 30000)" >25000 ~ 30000</a>
                        <a onclick="javascript:on_price_changed(30000, 40000)" >30000 ~ 40000</a>
                        <a onclick="javascript:on_price_changed(40000, 50000)" >40000 ~ 50000</a>
                        <a onclick="javascript:on_price_changed(50000, 1000000)" >over 50000</a>
                      </div>
                    </div>
                  </div>
                  <div></div>

                  <div class="size-chooser">
                    <div class='chooser'>
                      <span><?php show_spec($s, 'Size') ?></span>
                      <div class="float_layer hidden">
                        <a onclick="javascript:on_size_changed(0, 0)">All (sqm)</a>
                        <a onclick="javascript:on_size_changed(50, 100)">50 ~ 100</a>
                        <a onclick="javascript:on_size_changed(100, 150)">100 ~ 150</a>
                        <a onclick="javascript:on_size_changed(150, 200)">150 ~ 200</a>
                        <a onclick="javascript:on_size_changed(200, 300)">200 ~ 300</a>
                        <a onclick="javascript:on_size_changed(300, 1000000)">over 300</a>
                      </div>
                    </div>
                  </div>
                  <div></div>

                  <div class="bedrooms-chooser">
                    <div class='chooser'>
                      <span><?php show_spec($s, 'Bedrooms') ?></span>
                      <div class="float_layer hidden">
                        <a onclick="javascript:on_bedrooms_changed(0, 0);">All (Brs)</a>
                        <a onclick="javascript:on_bedrooms_changed(1, 1);">1Br</a>
                        <a onclick="javascript:on_bedrooms_changed(2, 2);">2Brs</a>
                        <a onclick="javascript:on_bedrooms_changed(3, 3);">3Brs</a>
                        <a onclick="javascript:on_bedrooms_changed(4, 4);">4Brs</a>
                        <a onclick="javascript:on_bedrooms_changed(5, 10);">5Brs+</a>
                      </div>
                    </div>
                  </div>
                </td>

                <td width="61%">
                  <label>
                    <input type="checkbox" id="apartment_checker" onclick="javascript:tigger_property_type('apartment_checker', 'Apartment');" <?php mark_if_checked($s, 'Apartment') ?>>
                    <span class="apartment">Apartments</span>
                  </label>
                  <label>
                    <input type="checkbox" id="villa_checker" onclick="javascript:tigger_property_type('villa_checker', 'Villa');" <?php mark_if_checked($s, 'Villa') ?>>
                    <span class="villa">Villas</span>
                  </label>
                  <label>
                    <input type="checkbox"  id="old_house_checker" onclick="javascript:tigger_property_type('old_house_checker', 'Old House');"  <?php mark_if_checked($s, 'Old House') ?>>
                    <span class="old-house">Old Houses</span>
                  </label>
                  <label>
                    <input type="checkbox"  id="serviced_apartment_checker" onclick="javascript:tigger_property_type('serviced_apartment_checker', 'Serviced-Apartment');"  <?php mark_if_checked($s, 'Serviced-Apartment') ?>>
                    <span class="apartment">Serviced-Apartment</span>
                  </label>
                  <label>
                    <input type="checkbox"  id="courtyard_checker" onclick="javascript:tigger_property_type('courtyard_checker', 'Courtyard');"   <?php mark_if_checked($s, 'Courtyard') ?>>
                    <span class="villa">Courtyard</span>
                  </label>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
</td>
