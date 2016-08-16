$(document).ready(function() {
  $('.layer').on('mouseenter', function() {
    var data = $(this).find('.data').html();
    layer.tips(data, this);
  });
});
