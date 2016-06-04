$(document).ready(function() {
　　function query(action) {
    var url = getCakePHPUrl('wiki', action);
    $.getJSON(url, function(result) {
      $('.message').html(object2html(result));
    });
　　}

  $('.actions a').click(function() {
    query($(this).prop('class'));
  });
});
