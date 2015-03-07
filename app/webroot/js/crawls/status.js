$(document).ready(function() {
	var requestPeriod = 5000;
	var lastResponse = "<!-- no message yet -->";
	var lastRequest = new Date().getTime();

	var interval = setInterval(function() {
		// TODO : buggy?
		var now = new Date().getTime();
		if (now - lastRequest < requestPeriod) {
			return;
		}

		lastRequest = now;

		var id = $('.model-id').text();
		$.getJSON('../ajax_getJobInfo/' + id + '/true', function(data) {
			if (lastResponse == data) {
				requestPeriod = exponentialIncrease(requestPeriod, 30 * 1000);
			}
			else {
				requestPeriod = exponentialDecrease(requestPeriod, 2000);
				lastResponse = data;
			}

			if (data['state'] != undefined) {
				$("#jobInfo").html($("#jobInfoTemplate").render(data));
			}

			$("#jobInfoRaw pre").html(JSON.stringify(data, null, 4));

			if (data['state'] == undefined || data['state'] == 'FAILED') {
				clearInterval(interval);
			}
		});

		$.getJSON('../ajax_get/' + id, function(crawl) {
			$('#finishedRounds').text(crawl['Crawl']['finished_rounds']);
		});
	}, 2000);
});
