$(document).ready(function() {

  var enableIntelligentAnalysis = false;

  if (enableIntelligentAnalysis) {
    $.layer({
        type: 1,
        title: false,
        border : false,
        shade: [0.5, '#000'],
        closeBtn: [0, true],
        title: '智能分析',
        move: '.xubox_title',
        moveOut: true,
        moveType: 1,
        area: ['751px', 'auto'],
        page: {dom : '.intelligent-analysis'}
    });
  }

  var startUpTip = $('.start-up-tip').html();
  // layer.msg(startUpTip, 3, -1);

  var seedUrl = $('#Seed0Url').val();

  function checkUrlAvailable(target) {
    if (target.value == '') return;

    if (!isValidURL(target.value)) {
      layer.alert("链接格式错误！", 3);
    }

    if (target.value != seedUrl) {
      seedUrl = target.value;

      $('.seed-url-testing-message').html("<p class='orange'>链接可用性测试中，请稍候...</p>").show();
      var url = getCakePHPUrl('common', 'ajax_checkUrlAvailable');
      $.get(url, {u : seedUrl}, function(valid) {
        var msg = valid == "1" ? "<p class='green'>链接可用。</p>" : 
          "<p class='red larger'>链接无法访问！</p>";

        if (valid == 0) {
          layer.alert(msg, 3);
        }

        $('.seed-url-testing-message').html(msg);
      });
    }
  } // checkUrlAvailable

  $('.crawls .help').on('click', function() {
    openTip(startUpTip, '.crawls .help', 3, 30);
  });

  $('#Seed0Url').parent().append("<button type='button' class='appended analysis-seed-url'>分析</button>");
  $('#CrawlFilter0UrlFilter').parent().append("<button type='button' class='appended test-url-filter'>测试</button>");
  $('#CrawlFilter1UrlFilter').parent().append("<button type='button' class='appended test-url-filter'>测试</button>");

  $('div.input .analysis-seed-url').on('click', function() {
    checkUrlAvailable($('#Seed0Url').get(0));
  }); // $.div.input .analysis-seed-url.click

  $('#Seed0Url').on('blur', function() {
    checkUrlAvailable(this);
  });

  $('div.input .test-url-filter').click(function() {
    $('.test.result').html('');

    var regex = $(this).parent().find('input[type="text"]').val();
    $('.test.form .regex').text(regex);

    $.layer({
        type: 1,
        title: false,
        border : false,
        area: ['751px', 'auto'],
        moveType : 1,
        page: {dom : '.test.form'}
    });
  });

  $('.start-test-regex').click(function() {
    var pattern = $('.test.form .regex').text();
    var urls = $('.test.form .test-urls').val();
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

  $('.intelligent-analysis .analysis').click(function() {
    var seedUrl = $('#CrawlUrl').val();
    if (seedUrl == '') {
      openTip("请输入一个种子链接", '#CrawlUrl', 0);
      return false;
    }

    url = getCakePHPUrl('crawls', 'ajax_analysis');
    $.getJSON(url, {u : seedUrl}, function(outlinks) {
      layer.msg(dump(outlinks));
    });
  });
});
