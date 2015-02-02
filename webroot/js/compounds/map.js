// JavaScript Document

// The five markers show a secret message when clicked
// but that message is not within the marker's instance data
function attachInfoWindow(marker, info) {
 var infowindow = new google.maps.InfoWindow({
	 content: info
 });

 google.maps.event.addListener(marker, 'click', function() {
	 var openinfowindow = marker.getMap().get("openinfowindow");

	 if (openinfowindow != 'undefined' && openinfowindow != null) {
		 openinfowindow.close();
	 }

	 infowindow.open(marker.getMap(), marker);
	 marker.getMap().set("openinfowindow", infowindow);
 });
} // end attachCompoundInfo

function initialize_page() {
	
}

// Init google map
function initialize_map() {
	// load map
	// Shanghai Center

	var chinaBound = new google.maps.LatLngBounds(new google.maps.LatLng(), 
		new google.maps.LatLng(23.315173, 74.596987));
	var position = new google.maps.LatLng(31.214228, 121.444212);

	var mapOptions = {
		center : position,
		zoom : 16,
		mapTypeId : google.maps.MapTypeId.ROADMAP
	};

	var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

	if (compounds.length == 0) {
		return;
	}

  if (schools.length == 1) {
		for (var i = 0; i < schools.length; i++) {
			if (schools[i]["School"]["lng"] != null && schools[i]["School"]["lat"] != null) {
				position = new google.maps.LatLng(schools[i]["School"]["lat"], schools[i]["School"]["lng"]);
			}
		}
	}
	else {
		for (var i = 0; i < compounds.length; i++) {
			if (compounds[i]["Compound"]["lng"] != null && compounds[i]["Compound"]["lat"] != null) {
				position = new google.maps.LatLng(compounds[i]["Compound"]["lat"], compounds[i]["Compound"]["lng"]);
			}
		}
	}
	// map.setCenter(position);

	// Calculate bounds
	var lat = position.lat();
	var lng = position.lng();
	var lat2 = position.lat();
	var lng2 = position.lng();

  if (schools.length == 1) {
		for (var i = 0; i < schools.length; i++) {
			if (schools[i]["School"]["lat"] == null || schools[i]["School"]["lng"] == null) continue;
	
			if (schools[i]["School"]["lat"] < lat) lat = schools[i]["School"]["lat"];
			if (schools[i]["School"]["lng"] < lng) lng = schools[i]["School"]["lng"];
	
			if (schools[i]["School"]["lat"] > lat2) lat2 = schools[i]["School"]["lat"];
			if (schools[i]["School"]["lng"] > lng2) lng2 = schools[i]["School"]["lng"];
		} // end for
	}
	else {
		for (var i = 0; i < compounds.length; i++) {
			if (compounds[i]["Compound"]["lat"] == null || compounds[i]["Compound"]["lng"] == null) continue;
	
			if (compounds[i]["Compound"]["lat"] < lat) lat = compounds[i]["Compound"]["lat"];
			if (compounds[i]["Compound"]["lng"] < lng) lng = compounds[i]["Compound"]["lng"];
	
			if (compounds[i]["Compound"]["lat"] > lat2) lat2 = compounds[i]["Compound"]["lat"];
			if (compounds[i]["Compound"]["lng"] > lng2) lng2 = compounds[i]["Compound"]["lng"];
		} // end for
	}

	var southWest = new google.maps.LatLng(lat, lng);
	var northEast = new google.maps.LatLng(lat2, lng2);

  if (schools.length == 1 || compounds.length == 1) {
		map.setCenter(position);
	}
	else {
		var bounds = new google.maps.LatLngBounds(southWest, northEast);
		map.fitBounds(bounds);
	}

	// Test code
	var latSpan = northEast.lat() - southWest.lat();
	var lngSpan = northEast.lng() - southWest.lng();

	for (var i = 0; i < 5; i++) {
		continue;

		var position = new google.maps.LatLng(
				southWest.lat() + latSpan * Math.random(),
				southWest.lng() + lngSpan * Math.random());

		var marker = new google.maps.Marker({
			position: position,
			map: map
		});

		marker.setTitle("Title" + (i + 1).toString());
		attachCompoundInfo(marker, "Info : " + (i + 1).toString());
	} // end for

	// Our Schools
	for (var i = 0; i < schools.length; i++) {
		if (schools[i]["School"]["lat"] == null || schools[i]["School"]["lng"] == null) continue;

		var position = new google.maps.LatLng(schools[i]["School"]["lat"], schools[i]["School"]["lng"]);

		if (position.lat() == 0 || position.lng() == 0) continue;

		 var icon = '/img/sinorelo/schoolpin.gif';
		 var marker = new google.maps.Marker({
			 position : position,
			 map : map,
			 icon : icon
		 });

		 marker.setTitle(schools[i]["School"]["name_en"]);
		 attachInfoWindow(marker, schools[i]["School"]["name_en"]);
	} // end for

	// Our Compounds
	for (var i = 0; i < compounds.length; i++) {
		if (compounds[i]["Compound"]["lat"] == null || compounds[i]["Compound"]["lng"] == null) continue;

		var position = new google.maps.LatLng(compounds[i]["Compound"]["lat"], compounds[i]["Compound"]["lng"]);

		if (position.lat() == 0 || position.lng() == 0) continue;

		 var marker = new google.maps.Marker({
			 position: position,
			 map: map
		 });

		 marker.setTitle(compounds[i]["Compound"]["name_en"]);
		 attachInfoWindow(marker, document.getElementById('compound_' + compounds[i]["Compound"]["id"]).innerHTML);
	} // end for

} // end initialize

function initialize() {
	initialize_page();
	initialize_map();
}

/*******************events********************************/

var searchTip = 'Compound Name, Keywords...';

function tigger_property_type(id, pro_type) {
	if(document.getElementById(id).checked) {
		choosed_property_types.push(pro_type);
	}
	else {
		var i = choosed_property_types.lastIndexOf(pro_type);
		if (i != -1) {
			choosed_property_types.splice(i, 1);
		}
	}

	reload();
}

function choose_school(id) {
	s.school_id = id;

	reload();
}

function choose_area(id) {
	s.area_id = id;

	reload();
}

function reload() {
	if (choosed_property_types[0] == '') choosed_property_types.splice(0, 1);
	s.js = true;
	s.property_types = choosed_property_types.join('|');
	s.key = document.getElementById('search_key').value;
	if (s.key == searchTip) s.key = '';

	var path = '/compounds/map';
	for (var prop in s) {
		if (s[prop] != undefined && s[prop] != null && s[prop] != 'null' && s[prop] != '') {
			path += '/' + prop + ':' + s[prop];
		}
	}

	window.location = path;
}

function inplace_reload(compound_id) {
	if (choosed_property_types[0] == '') choosed_property_types.splice(0, 1);
	s.js = true;
	s.property_types = choosed_property_types.join('|');
	s.key = document.getElementById('search_key').value;
	if (s.key == searchTip) s.key = '';

	var path = '/compounds/map/view:map_properties/compound_id:' + compound_id;
	for (var prop in s) {
		if (s[prop] != undefined && s[prop] != null && s[prop] != 'null' && s[prop] != '') {
			path += '/' + prop + ':' + s[prop];
		}
	}

  var selector = '.compound-' + compound_id;
	$(selector).find('.mutable-property-list-view .property-list').remove();
	var html = jQuery.ajax({type: 'get', url: path, async: false}).responseText;
	$(selector).find('.mutable-property-list-view').append(html);
}

function on_price_changed(lower, upper) {
	s.rent = lower + ',' + upper;
	if (upper == 0) s.rent = null;

	reload();
}

function on_size_changed(lower, upper) {
	s.size = lower + ',' + upper;
	if (upper == 0) s.size = null;

	reload();
}

function on_bedrooms_changed(lower, upper) {
	s.layout = lower + ',' + upper;
	if (upper == 0) s.layout = null;

	reload();
}

function on_size_inplace_changed(compound_id, lower, upper) {
	s.size = lower + ',' + upper;
	if (upper == 0) s.size = null;

	inplace_reload(compound_id);
}

function on_bedrooms_inplace_changed(compound_id, lower, upper) {
	s.layout = lower + ',' + upper;
	if (upper == 0) s.layout = null;

	inplace_reload(compound_id);
}

function on_search_key_change() {
	s.key = key;

	if(e.keyCode == 13) { reload(); }
}

$(document).ready(function(){
	initialize();

  // search box
	$('#compound-map #search_key').focus(function() {
		if (this.value == searchTip) this.value = "";
	});

	$('#compound-map #search_key').blur(function(){
		if (this.value == "") this.value = searchTip;
	});

  // areas
	$('.map-menu-area').mouseover(function(e) {
		$('.div_areas').show();
	});

	$('.map-menu-area').mouseout(function() {
		$('.div_areas').hide();
	});

  // schools
	$('.map-menu-school').mouseover(function(e) {
		$('.div_area_schools').show();
	});

	$('.map-menu-school').mouseout(function() {
		$('.div_area_schools').hide();
	});

	$('.map-menu-school .div_schools').mouseover(function(e) {
		$(this).find('.schools').show();
	});

	$('.map-menu-school .div_schools').mouseout(function() {
		$(this).find('.schools').hide();
	});

	// price-chooser
	$('.price-chooser').mouseover(function(e) {
		$('.price-chooser .float_layer').show();
	});

	$('.price-chooser').mouseout(function() {
		$('.price-chooser .float_layer').hide();
	});

  // size	
	$('.size-chooser').mouseover(function(e) {
		$('.size-chooser .float_layer').show();
	});

	$('.size-chooser').mouseout(function() {
		$('.size-chooser .float_layer').hide();
	});

  // bedrooms
	$('.bedrooms-chooser').mouseover(function(e) {
		$('.bedrooms-chooser .float_layer').show();
	});

	$('.bedrooms-chooser').mouseout(function() {
		$('.bedrooms-chooser .float_layer').hide();
	});

});
