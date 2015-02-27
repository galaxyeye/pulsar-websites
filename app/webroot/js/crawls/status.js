$(document).ready(function() {
	var interval = setInterval(function() {
		var id = $('.model-id').text();
		$.getJSON('../ajax_getJobInfo/' + id + '/true', function(data) {
			if (data['state'] != undefined) {
				$("#jobInfo").html($("#jobInfoTemplate").render(data));
			}

			$("#jobInfoRaw pre").html(JSON.stringify(data, null, 4));

			if (data['state'] == undefined || data['state'] == 'FAILED') {
				clearInterval(interval);
			}
		});
	}, 2000);
});
