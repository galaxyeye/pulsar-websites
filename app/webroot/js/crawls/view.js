$(document).ready(function() {

  var interval = setInterval(function() {
    if (!$('body').hasClass('visible')) {
      return;
    }

    var state = crawl['state'];
    if (state == 'CREATED') {
      return;
    }

    var id = $('.crawls.view .model-id').text();
    var url = getCakePHPUrl('crawls', 'ajax_getJobInfo', id);
    $.getJSON(url, function(data) {
      $("#jobInfo").html("<pre>" + JSON.stringify(data, null, 4) + "</pre>");

      if (data == '' || data['state'] == undefined || data['state'] == 'FAILED' || data['state'] == 'NOT_FOUND') {
        clearInterval(interval);
      }
    });

    var url = getCakePHPUrl('crawls', 'ajax_get', id);
    $.getJSON(url, function(crawl) {
      $('.finishedRounds').text(crawl['Crawl']['finished_rounds']);
    });
  }, 5000);
});
