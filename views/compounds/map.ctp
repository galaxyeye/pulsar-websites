<?php 
   if (isset($old_filter['property_type']) && $old_filter['property_type'] != 'null') {
     $title_for_layout = str_replace('{{property-type}}', $old_filter['property_type'], $title_for_layout);
   }
   else {
     $title_for_layout = str_replace('{{property-type}}', 'Apartments', $title_for_layout);
   }

   $this->set('title_for_layout', $title_for_layout);
?>

<?php $this->layout = "empty" ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Properties search in Shanghai, properties search in Beijing, properties search in Guangzhou, compounds search in shanghai, compounds search in Beijing, compounds search in Guangzhou, Relocation, China relocation, relocation China, Shanghai relocation, relocation in Shanghai, Beijing relocation, relocation in Beijing, Guangzhou relocation, relocation in Guangzhou, China home search, home search in Shanghai, home search in Beijing, home search in Guangzhou, orientation, China school search, temporary accommodation search, international move, settling-in, bank account opening, maid search, driver search, car rent, insurance purchasing, tenancy management, expenses management, language and culture training, China apartments, rent apartments in China, apartments for rent in China, China apartment rent, China apartments for rent, serviced apartments in China, rent serviced apartments China , living in China, expats in China, properties in China, Shanghai apartment for rent, rent apartment in Shanghai, Beijing apartment for rent, rent apartment in Beijing, Guangzhou apartment for rent, rent apartment in Guangzhou, Sinorelo." />
<meta name="description" content="Properties map search. Sinorelo provides all kinds of relocation services in China, including home search, school search, immigration, payroll and incorporation." />
<title>Property map search, compounds in China, China apartments for rent, living in China, Sinorelo.</title>

<link href="/css/default.css" rel="stylesheet" type="text/css" />
<link href="/css/compounds/map.css" rel="stylesheet" type="text/css" />

</head>

<body id='compound-map'>

<div class="top-header">
	<div class='wp'>
	  <a href="/compounds/map/city_id:1" title="Shanghai" class='<?php mark_current_city(1, $currentCity) ?> city'>Shanghai</a>
	  <span>|</span>
	  <a href="/compounds/map/city_id:2" title="Beijing" class='<?php mark_current_city(2, $currentCity) ?> city'>Beijing</a>
	  <span>|</span>
	  <a href="/compounds/map/city_id:3" title="Guangzhou" class='<?php mark_current_city(3, $currentCity) ?> city'>Guangzhou</a>
  </div>
</div>

<script type="text/javascript">
  var compounds = <?php echo json_encode($compounds) ?>;
  var schools = <?php echo json_encode($schools) ?>;

  var default_search_options = <?php echo json_encode($default_search_options) ?>; // search_options
  var s = <?php echo json_encode($search_options) ?>; // search_options
  var choosed_property_types = s.property_types.split('|') || '';

  function initialize_page() {
    s.key = document.getElementById('search_key').value = '';
  }
</script>

<?php 
	// echo $this->element('sql_dump');
	

?>

<table class='!hidden' width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr><?php echo $this->element("map_search", array('search_options' => $search_options)) ?></tr>
  <tr>
    <td height="85%"><div style="height: 100%;" id="map_canvas"></div></td>
  </tr>
</table>

<div class="warning" style='display: none'>We Suggest You Set The Resolution Over 1024*768 To Browse This Page.</div>
<div style="position: absolute; left: 35%; top: 28%; display: none" id="compounds_show" > </div>

<div class='hidden'>
  <?php echo $this->element('map_compounds', array('compounds' => $compounds, 'area_schools' => $area_schools)); ?>
</div>

</body>

<script type="text/javascript" src="<?php echo GOOGLE_MAP?>"></script>
<script type="text/javascript" src="/js/jquery/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/compounds/map.js"></script>

</html>
