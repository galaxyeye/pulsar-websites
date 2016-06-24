$(document).ready(function() {
	function displayFilterMode(mode) {
	  if (mode == 'BASIC') {
	    $('.filter-mode.basic').show();
	  }
	  else {
	    $('.filter-mode.advanced').show();
	  }
	}

	$('.filter-mode').hide();
	var mode = $('#CrawlFilterFilterMode').val();
	displayFilterMode(mode);

	$('#CrawlFilterFilterMode').on('change', function() {
	  $('.filter-mode').hide();
	  displayFilterMode(this.value);
	});
});
