$(document).ready(function() {

  $('.start-test-regex').click(function() {
	var pattern = $('#NutchJobRegex').val();
    var urls = $('#NutchJobTestUrls').val();
    var validUrls = [];
    var invalidUrls = [];
    var msg = "";

    if (!urls) {
      msg = "请输入待测试链接。";
      layer.alert(msg, 3);
      return;
    }

    if (urls) {
      var regex = new RegExp(pattern);

      $.each(urls.split(/\s+/), function(i, url) {
        if (url == "") return;

          if (url.match(regex)) {
            validUrls.push(url);
          }
          else {
            invalidUrls.push(url);
          }
      });
    }

    if (invalidUrls.length == 0) {
      msg += "<p class='green'>所有链接均匹配，测试通过！</p>";
        // layer.msg(msg, 5);
        $('.test.result').html(msg);
        return;
    }

    msg = "<div class='message'><p class='red'>以下链接不匹配：</p><pre>";
    if (invalidUrls.length != 0) {
      $.each(invalidUrls, function(i, url) {
        msg += url + "\n";
      });
    }
    msg += "</pre></div>";

    $('.test.result').html(msg);
    // layer.alert(msg, 3);
  });
});
