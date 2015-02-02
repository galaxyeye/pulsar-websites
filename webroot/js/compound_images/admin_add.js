$(document).ready(function() {

  $('button').click(function() {
		if ($('#InfoBigImage').val() == '-1') {
			var result = confirm("你没有选择大图，确定吗？");
			if (result == true) {
			  $('form').submit();
			}
		}
		else {
			$('form').submit();
		}
	});

});
