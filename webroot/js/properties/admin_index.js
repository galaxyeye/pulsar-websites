$(document).ready(function() {
	var searchTip = "Property Name, Keywords...";

	$('.search_box input[type=text]').focus(function() {
		if (this.value == searchTip) this.value = "";
	});

	$('.search_box input[type=text]').blur(function(){
		if (this.value == "") this.value = searchTip;
	});

	$('.search_box input[type=button]').click(function(){
		var key = $('.search_box input[type=text]').val();
		if (key != searchTip) {
			window.location = "/admin/properties/index/key:" + key;
		}
		else {
			window.location = "/admin/properties";
		}
	});

	$('.search_box input[type=text]').keyup(function(e){
		if(e.keyCode != 13) { return ;}

		var key = $('.search_box input[type=text]').val();
		if (key != searchTip) {
			window.location = "/admin/properties/index/key:" + key;
		}
		else {
			window.location = "/admin/properties";
		}
	});
});
