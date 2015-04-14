$(document).ready(function() {
  var draggableActived = true;
  var pageEntityFields = pageEntity['PageEntityField'];

  $('#qiwurBody > div > table > tbody > tr').each(function(i, item) {
    var cols = $(item).find('td');
    var name = cols.get(0).textContent;
    var css_path = cols.get(2).textContent;
    if (name != "" && css_path != "") {
      pageEntityFields.push({name : name, css_path : css_path});
    }
  });

  $.layer({
    type : 1,
    // title : '弹性分布式网页集概要',
    title : "齐物数据引擎操作界面",
    border : false,
    shade : [0],
    move : ".xubox_title",
    moveType : 1,
    moveOut : true,
    area: ['751px', 'auto'],
    maxmin: true,
    offset : ['', ''],
    shift: 'left', // 从左动画弹出
    page : {dom : '#systemPanel'},
    success: function(layero) {
      _renderPageEntityFields();
    }
  });

  $('.analysis-extract-rule').click(function() {
    var target = getCakePHPUrl('scent_jobs', 'ajax_extract');
    var data = {url : webPage['WebPage']['url'], html : webPage['WebPage']['content'], format : 'all'}
    $.post(target, data, function(results) {
      $("#qiwurHtmlWrapper").html(results['result']);
    }, 'json');
  });

  $('.start-extract-rule').click(function() {
    $('.info-box').addClass('qiwur-hidden').hide();
    $('.css-path-collector').removeClass('qiwur-hidden').show();

//    var target = globalPageData.here + "/onlyContent:true";
//    $("#qiwurHtmlWrapper").load(target);
    $("#qiwurHtmlWrapper").removeClass('qiwur-hidden');
    $("#qiwurHtmlWrapper").fadeIn('slow');

    _installDraggingDropping();
  });

  $('.save-extract-rule').click(function() {
    if ($.isEmptyObject(pageEntityFields)) {
      layer.alert('请至少指定一个字段！', 9);
      return;
    }
    var pageEntityId = pageEntity['PageEntity']['id'];

    var target = getCakePHPUrl('page_entities', 'ajax_addFields', pageEntityId);
    $.post(target, {data : JSON.stringify(pageEntityFields)}, function(data) {
      layer.msg("<p>挖掘规则已保存！</p><pre>" + dump(data) + "</pre>", 5, {type : 1})
    }, 'json');
  });

  $('.clear-extract-rule').click(function() {
    pageEntityFields = [];
    _renderPageEntityFields();
  });

  $('.start-ruled-extract').click(function() {
    var id = pageEntity['PageEntity']['id'];
    var url = getCakePHPUrl('page_entities', 'view', id);
    window.open(url);
  });

  function _delPageEntityFieldByName(name) {
    var tmp = [];
    $.each(pageEntityFields, function(i, field) {
      if (name != field['name']) {
        tmp.push(field);
      }
      return field;
    });
    pageEntityFields = tmp;
  }

  function _renderPageEntityFields() {
    $("#pageEntityFields").html($("#pageEntityFieldsTemplate").render(pageEntityFields));

    // install events
    $("#pageEntityFields .del").click(function() {
      var name = $(this).parent().find('.k').text().trim();
      _delPageEntityFieldByName(name);
      _renderPageEntityFields();
    });

    // $('#pageEntityFields').scroll();
    $("#pageEntityFields").animate({ scrollTop: $("#pageEntityFields").scrollTop() + 30 }, 1000);
  } // _renderPageEntityFields
});
