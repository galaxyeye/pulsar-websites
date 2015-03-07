$(document).ready(function() {

  var webroot = globalPageData.webroot,
  seedUrlDialog,
  seedUrlform,
  seedUrl = $("#seedUrl"),
  crawlId = $("#crawlId").val(),
  seedUrlFields = $([]).add(seedUrl),
  tips = $(".validateTips");

  // add/view/edit in a new layer
  $('#stage a').filter(function(index) {
    return this.href.length > 1 && this.href.indexOf('delete') == -1 && this.target != '_blank';
  }).on("click", function(event) {
	var params = {};
	if (this.href.indexOf('crawl_filter') !== -1) {
		params.title = "Move Me ";
		params.move = ".xubox_title";
	}
    openUrlInLayer(this.href, params);

    return false;
  });

  var interval = setInterval(function() {
    // clearInterval(interval);

    var id = $('.crawls.view .model-id').text();
    $.getJSON('../ajax_getJobInfo/' + id, function(data) {
      if (data['state'] != undefined) {
        $("#jobInfo").html($("#jobInfoTemplate").render(data));
      }

      // $(".message").html('data : ' + data);

      if (data['state'] == undefined || data['state'] == 'FAILED') {
        clearInterval(interval);
      }
    });
  }, 5000);
});
