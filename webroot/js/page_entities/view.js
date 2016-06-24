$(document).ready(function() {

  $('.pageEntityFields.index .del').click(function() {
    var row = $(this).parent().parent();
    $.get(this.href, function() {
      row.hide();
    });

    return false;
  });

});
