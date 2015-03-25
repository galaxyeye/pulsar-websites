$(document).ready(function() {
	$('.js-view').not('.raw').hide();

	var interval = setInterval(function() {
        if (!$('body').hasClass('visible')) {
	      return;
        }

		var id = $('.model-id').text();
	    var url = getCakePHPUrl('crawls', 'ajax_getJobInfo', id, "true");
		$.getJSON(url, function(data) {
			$("#jobInfoRaw pre").html(JSON.stringify(data, null, 4)).show();

			$('.js-view').not('.raw').hide();

			if (data['state'] != undefined) {
				$("#jobInfo").html($("#jobInfoTemplate").render(data)).show();
			}

			if (data['exception'] != undefined) {
				$("#jobException").html($("#jobExceptionTemplate").render(data)).show();
			}


			if (data['state'] == undefined || data['state'] == 'FAILED') {
				clearInterval(interval);
			}
		});

		$.getJSON('../ajax_get/' + id, function(crawl) {
			$('#finishedRounds').text(crawl['Crawl']['finished_rounds']);
		});
	}, 2000);
});
