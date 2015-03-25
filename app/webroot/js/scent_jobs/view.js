$(document).ready(function() {
  $('.hidden').hide();

  var interval = setInterval(function() {
    var id = $('.model-id').text();
    var url = getCakePHPUrl('scent_jobs', 'ajax_getJobInfo', id, 'true');
    $.getJSON(url, function(results) {
      if (results['state'] == undefined || results['state'] == 'FAILED') {
        clearInterval(interval);
        return;
      }

      $("#jobInfo").html($("#jobInfoTemplate").render(results));
      $("#jobInfoRaw pre").html(JSON.stringify(results, null, 4));

      if (results['state'] == 'FINISHED' && results['msg'] == 'OK') {
        clearInterval(interval);

        $('.view-extract-result').show();
        showExtractResultAsSQL();
        // openUrlInLayer(globalPageData.webroot + 'files');
      }
    });
  }, 2000);

  function showExtractResultAsSQL() {
    var id = $('.scentJobs.view .model-id').text();
    var url = getCakePHPUrl('scent_jobs', 'ajax_getExtractResultAsSQL', id);
    $.getJSON(url, function(sqls) {
      $("#sqlList").html($("#sqlListTemplate").render(sqls));
    });
  }
});
