$(document).ready(function() {
	var searchTip = "Compound Name, Keywords...";

	$('.search_box input[type=text]').focus(function() {
		if (this.value == searchTip) this.value = "";
	});

	$('.search_box input[type=text]').blur(function(){
		if (this.value == "") this.value = searchTip;
	});

	$('.search_box input[type=button]').click(function(){
		var key = $('.search_box input[type=text]').val();
		if (key != searchTip) {
			window.location = "/admin/compounds/bind/" + compound_id + "/key:" + key;
		}
		else {
			window.location = "/admin/compounds/bind/" + compound_id;
		}
	});
	
	$('.search_box input[type=text]').keyup(function(e){
		if(e.keyCode != 13) { return ;}

		var key = $('.search_box input[type=text]').val();
		if (key != searchTip) {
			window.location = "/admin/compounds/bind/" + compound_id + "/key:" + key;
		}
		else {
			window.location = "/admin/compounds/bind/" + compound_id;
		}
	});

	$('.check-all').click(function() {		
		$(".check-property").attr("checked", $(this).attr('checked'));
	});

	$('.bind-all').click(function() {
    $('.bind-all').data('pids', []);

    $(".check-property").each(function() {
      var ids = $('.bind-all').data('pids');

			if ($(this).attr('checked')) {
				ids.push($(this).attr('pid'));
				$('.bind-all').data('pids', ids);
			}
		});

		window.location = "/admin/compounds/bind/" + compound_id + "/pids:" + $('.bind-all').data('pids').join(',');
	});

	$('.unbind-all').click(function() {
    $('.bind-all').data('pids', []);

    $(".check-property").each(function() {
      var ids = $('.bind-all').data('pids');

			if ($(this).attr('checked')) {
				ids.push($(this).attr('pid'));
				$('.bind-all').data('pids', ids);
			}
		});

		window.location = "/admin/compounds/unbind/" + compound_id + "/pids:" + $('.bind-all').data('pids').join(',');
	});

});
