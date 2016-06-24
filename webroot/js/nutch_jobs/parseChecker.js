$(document).ready(function() {

  var jobId = $('#NutchJobJobId').text();
  if (jobId != '') {
    layer.load('正在查询抓取服务器，请稍候......', 60);
  }

  var interval = setInterval(function() {
    if (!$('body').hasClass('visible')) {
      return;
    }

    var jobId = $('#NutchJobJobId').text();
    if (jobId != 0) {
      var url = getCakePHPUrl('nutch_jobs', 'ajax_getJobInfo', jobId);
	  $.getJSON(url, function(data) {
		  $('#flashMessage').hide();

		  if (data['state'] == undefined || data['state'] == 'NOT_FOUND') {
			layer.msg("任务失败", 3, -1);
            clearInterval(interval);
		  }

	      if (data['result'] != undefined) {
			layer.closeAll();

	    	delete data['result']['Headers'];
	    	delete data['result']['Metadata'];

	    	var result = data['result'];
	        $("#parseText").text(result.ParseText);
	        $("#outlinks").text(result.Outlinks);
	        $("#discardOutlinks").text(result.DiscardOutlinks);

		    if (data['state'] == 'FINISHED') {
		      clearInterval(interval);
		    }
	      } // if result not undefined
	  });
    }
  }, 3000);
});
