$(document).ready(function() {
  $('#PageEntityUrlFilter').parent().append("<button type='button' class='appended choose-input-mode'>手动填写</button>");
  $('#PageEntityUrlFilter2').parent().append("<button type='button' class='appended choose-input-mode'>选择填写</button>");

  $('#PageEntityTextFilter').parent().append("<button type='button' class='appended choose-input-mode'>手动填写</button>");
  $('#PageEntityTextFilter2').parent().append("<button type='button' class='appended choose-input-mode'>选择填写</button>");

  $('.choose-input-mode').click(function() {
    var input = $(this).parent().find(':input');

    input.attr('disabled', 'disabled').parent().hide();

    var target = input.attr('id');
    if (target.length - 1 === target.lastIndexOf('2')) {
      target = target.substr(0, target.length - 1);
    }
    else {
      target = target + '2';
    }

    $("#" + target).removeAttr('disabled').parent().show();
  });
});
