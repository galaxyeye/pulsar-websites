function getcookie(name) {
	var cookie_start = document.cookie.indexOf(name);
	var cookie_end = document.cookie.indexOf(";", cookie_start);
	return cookie_start == -1 ? '' : unescape(document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length)));
}

function setcookie(cookieName, cookieValue, seconds, path, domain, secure) {
	var expires = new Date();
	expires.setTime(expires.getTime() + seconds);
	document.cookie = escape(cookieName) + '=' + escape(cookieValue)
		+ (expires ? '; expires=' + expires.toGMTString() : '')
		+ (path ? '; path=' + path : '/')
		+ (domain ? '; domain=' + domain : '')
		+ (secure ? '; secure' : '');
}

$(document).ready(function(){
	// open edit mode and bind upd event
	var searchTip = $('.search_box input[type=text]').val() || "";
	var orignalTip = "keywords, ...";
	if (searchTip.substr("keywords")) {
		searchTip = $('.search_box input[type=text]').val();
	}
	else {
		searchTip = orignalTip;
	}

	$('.search_box input[type=text]').focus(function() {
		if (this.value == searchTip) this.value = "";
	});

	$('.search_box input[type=text]').blur(function(){
		if (this.value == "") this.value = searchTip;
	});

	$('#nv_compounds .search_box input[type=button]').click(function(){
		var key = $('.search_box input[type=text]').val();
		if (key != searchTip) {
			window.location = "/compounds/index/key:" + key;
		}
	});

	$('#nv_properties .search_box input[type=button]').click(function(){
		var key = $('.search_box input[type=text]').val();
		if (key != searchTip) {
			window.location = "/properties/index/key:" + key;
		}
		else {
			window.location = "/properties";
		}
	});

	$('#nv_schools .search_box input[type=button]').click(function(){
		var key = $('.search_box input[type=text]').val();
		if (key != searchTip) {
			window.location = "/schools/index/key:" + key;
		}
		else {
			window.location = "/schools";
		}
	});

	$('#nv_compounds .search_box input[type=text]').keyup(function(e){
		if(e.keyCode != 13) { return ;}

		var key = this.value;
		if (key != searchTip) {
			window.location = "/compounds/index/key:" + key;
		}
		else {
			window.location = "/compounds";
		}
	});

	$('#nv_properties .search_box input[type=text]').keyup(function(e){
		if(e.keyCode != 13) { return ;}

		var key = this.value;
		if (key != searchTip) {
			window.location = "/properties/index/key:" + key;
		}
	});

	$('#nv_schools .search_box input[type=text]').keyup(function(e){
		if(e.keyCode != 13) { return ;}
		
		var key = this.value;
		if (key != searchTip) {
			window.location = "/schools/index/key:" + key;
		}
	});

	$('#collapseSearchBox').click(function() {
		$('.search_options').hide();
	});

	// property image effect
	$('.gallery .small-image img').mouseover(function(e) {
		$('.gallery .big-image img').attr('src', e.target.src);
	});

	$('.gallery .small-image img').mouseout(function(e) {
		$('.gallery .big-image img').attr('src', $('#hidden-big-image img').attr('src'));		
	});

	// arranged properties
	if (arranged_properties != undefined) {
		if (arranged_properties.length != 0) {
			// show arranged properties
			$('.default-arrange-item').hide();
		
			var template = $.templates("#arrange-item-template");
			var items = template.render(arranged_properties);
	
			$(".arrange-items ul").append(items);
			$(".arrange-items ul li").last().find('div.detail').removeClass('bottom-dotted');
	
			// for enquiries
			$('#nv_enquiries .action .del a').click(function(){
				var property_id = $(this).parent().parent().find('input').val();
				$('.arrange-item-' + property_id).remove();
	
				__rebuild_property_cookie();
	
				var items = $('.arrange-items li');
				if (items.length == 1) {
					$('.default-arrange-item').show();
				}
	
				$('.number').text(items.length - 1);
	
				$(".arrange-items ul li").find('div.detail').addClass('bottom-dotted');
				$(".arrange-items ul li").last().find('div.detail').removeClass('bottom-dotted');
			});
	
			// for arrange a viewing
			$('.del-item a').click(function(){
				$(this).parent().parent().parent().remove();
				__rebuild_property_cookie();
	
				var items = $('.arrange-items li');
				if (items.length == 1) {
					$('.default-arrange-item').show();
				}
	
				$(".arrange-items ul li").find('div.detail').addClass('bottom-dotted');
				$(".arrange-items ul li").last().find('div.detail').removeClass('bottom-dotted');
			});
	
			 __rebuild_property_cookie();
	  } // end arranged properties not empty
	} // end arranged properties no undefined

	// add a new property
	$('.property .action .add').click(function(){
		$('.default-arrange-item').hide();

		var id = $(this).parent().find("input").val();
		if (id == undefined || id == null) return;

		var property = "";
		for (p in properties) {
			if (properties[p].id == id) property = properties[p];
		}

		if (property == "") return;
		// already arranged
		if ($(".arrange-items ul").find('.arrange-item-' + id).length != 0) return;

		var template = $.templates("#arrange-item-template");
		var item = template.render(property);

		$(".arrange-items ul").append(item);

		$('.del-item a').click(function(){
			$(this).parent().parent().parent().remove();
			__rebuild_property_cookie();

			var items = $('.arrange-items li');
			if (items.length == 1) {
				$('.default-arrange-item').show();
			}

			$(".arrange-items ul li").find('div.detail').addClass('bottom-dotted');
			$(".arrange-items ul li").last().find('div.detail').removeClass('bottom-dotted');
		});
	
		__rebuild_property_cookie();

		$(".arrange-items ul li").find('div.detail').addClass('bottom-dotted');
		$(".arrange-items ul li").last().find('div.detail').removeClass('bottom-dotted');
	});

	$('#EnquiryCity').change(function() {
		$('#EnquiryPreferredAreas').val('');

		var selector = '#nv_enquiries li.' + this.value;

		$('#nv_enquiries li.area-list').hide();
		$(selector).show();
	});

  	var EnquiryUserCityTip = 'Other City Name';
  	// enquiries
	$('#EnquiryCity').change(function(){
		if (this.value == 'Other') {
			$(this).parent().append("<input type='text' class='text input' id='EnquiryUserCity' name='data[Enquiry][user_city]' value='Other City Name'/>");

			$('#EnquiryUserCity').focus(function(){
				if (this.value == EnquiryUserCityTip) this.value = '';
			});
		
			$('#EnquiryUserCity').blur(function(){
				if (this.value == '') this.value = 'Other City Name';
			});
		}
		else {
			$('#EnquiryUserCity').remove();
		}
	});

	$('#EnquiryPreferredAreas').focus(function() {
		if (this.value == defaultEnquiryPreferredAreasTip) this.value = '';
	});

	$('#EnquiryPreferredAreas').blur(function() {
		if (this.value == '') this.value = defaultEnquiryPreferredAreasTip;
	});

	// perferred areas for online enquires
	$('#nv_enquiries .area-list a').click(function() {
		if ($('#EnquiryPreferredAreas').val() == defaultEnquiryPreferredAreasTip) {
			$('#EnquiryPreferredAreas').val('');
		}

		var areas = $('#EnquiryPreferredAreas').val();

		$('#EnquiryPreferredAreas').val(areas + this.innerHTML + ', ');
	});

	$('#EnquiryArrangeForm').submit(function() {
		$('.property-list').find('input').each(function() {
			$('#EnquiryArrangeForm').append(this);
		});
	});

	$('#compound-map .order-by-price').click(function() {
		// $(this).find('a').attr('href', $(this).find('input').val());
		$(this).find('input').val();
	});

	function __rebuild_property_cookie() {
		// $.cookie("property_ids", "null", {path : '/'});
		setcookie("property_ids", "null", 3600 * 24 * 180, '/');

		$(".arrange-items ul li").not('.default-arrange-item').each(function(index) {
			var id = $(this).find('input').val();
			if (id != undefined) {
				if (id != null)	__tidy_property_cookie(index, id);
			}
		});
	}

	function __tidy_property_cookie(index, added_id) {
		var property_ids = getcookie("property_ids");

		if (property_ids == "null") property_ids = "";
		if (index != 0) property_ids += ','
		property_ids += added_id;

		// $.cookie("property_ids", property_ids, {path : '/'});
		setcookie("property_ids", property_ids, 3600 * 24 * 180, '/');
	}

});
