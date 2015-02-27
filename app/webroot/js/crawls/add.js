$(document).ready(function() {

	  var startUpTip = $('.start-up-tip').html();
	  // layer.msg(startUpTip, 3, -1);

	  $('.crawls .help').on('click', function() {
		  openTip(startUpTip, '.crawls .help', 3);
	  });
});
