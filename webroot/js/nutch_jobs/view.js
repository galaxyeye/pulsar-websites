$(document).ready(function() {

  var interval = setInterval(function() {
    if (!$('body').hasClass('visible')) {
        // return;
      }

      var id = $('.crawls.view .model-id').text();
      var url = getCakePHPUrl('crawls', 'ajax_getJobInfo', id);
      $.getJSON(url, function(data) {
        $("#jobInfo").html("<pre>" + JSON.stringify(data, null, 4) + "</pre>");

        if (data == '' || data['state'] == undefined || data['state'] == 'FAILED' || data['state'] == 'NOT_FOUND') {
          clearInterval(interval);
        }
      });
    }
  }, 3000);
});
