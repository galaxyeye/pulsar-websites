$(document).ready(function() {

  var interval = setInterval(function() {
    // clearInterval(interval);

    var jobId = $('#NutchJobJobId').val();
    if (jobId != 0) {
      var url = getCakePHPUrl('nutch_jobs', 'ajax_getJobInfo', jobId);
	  $.getJSON(url, function(data) {
		  $('#flashMessage').hide();

	      if (data['result'] != undefined) {
	    	delete data['result']['Headers'];
	    	delete data['result']['Metadata'];

	    	var result = data['result'];
	        $("#parseText").html(result.ParseText);
	        $("#outlinks").html(result.Outlinks);
	        $("#discardOutlinks").html(result.DiscardOutlinks);

		    if (result.Outlinks.length > 20) {
		      clearInterval(interval);
		    }
	      } // if result not undefined
	  });
    }
  }, 3000);
});
