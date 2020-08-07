$(document).ready(function() {

  var interval = setInterval(function() {
    if (!$('body').hasClass('visible')) {
      // return;
    }

    var state = crawl['state'];
    if (state == 'CREATED') {
      return;
    }

    var id = $('.crawls.view .model-id').text();
    var url = getCakePHPUrl('crawls', 'ajax_getJobInfo', id);
    $.getJSON(url, function(jobInfo) {
      $("#jobInfo").html(JSON.stringify(jobInfo, null, 4));

      if (jobInfo == '' || jobInfo['state'] == undefined || jobInfo['state'] == 'FAILED' || jobInfo['state'] == 'NOT_FOUND') {
        clearInterval(interval);
      }
    });

    var url = getCakePHPUrl('crawls', 'ajax_get', id);
    $.getJSON(url, function(crawl) {
      $('.finished-rounds').text(crawl['Crawl']['finished_rounds']);
    });
  }, 5000);
});
