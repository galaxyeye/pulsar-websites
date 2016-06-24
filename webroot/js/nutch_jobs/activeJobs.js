$(document).ready(function() {
  $('.layer').on('mouseenter', function() {
    var data = $(this).find('.data').html();
    openTip(data, this, 1, 30);
  });
});
