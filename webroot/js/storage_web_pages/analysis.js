$(document).ready(function() {
  var draggableActived = true;
  var pageEntityFields = pageEntity['PageEntityField'];

  $('#qiwurBody > div > table > tbody > tr').each(function(i, item) {
    var cols = $(item).find('td');
    var name = cols.get(0).textContent;
    var css_path = cols.get(2).textContent;
    if (name != "" && css_path != "") {
      if (!_findPageEntityFieldByName(name)) {
        pageEntityFields.push({name : name, css_path : css_path});  
      }
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

  $('.manual-add-rules').click(function() {
    var page_entity_id = pageEntity['PageEntity']['id'];
    var url = getCakePHPUrl('storage_web_pages', 'view', encodedUrl, {page_entity_id : page_entity_id});
    window.open(url);
  });

  $('.start-ruled-extract').click(function() {
    var page_entity_id = pageEntity['PageEntity']['id'];
    var url = getCakePHPUrl('page_entities', 'view', page_entity_id);

    _saveExtractRules(url);
  });

  function _saveExtractRules(redirect) {
    if ($.isEmptyObject(pageEntityFields)) {
      layer.alert('请至少指定一个字段！', 9);
      return;
    }
    var pageEntityId = pageEntity['PageEntity']['id'];

    var target = getCakePHPUrl('page_entities', 'ajax_addFields', pageEntityId);
    $.post(target, {data : JSON.stringify(pageEntityFields)}, function(data) {
      delete data.data;
      layer.msg("<p>挖掘规则已保存！</p><pre>" + dump(data) + "</pre>", 4, {type : 1})

      if (redirect) {
        location = redirect;
      }
    }, 'json');
  }

  function _findPageEntityFieldByName(name) {
    var found = false;
    for (var i = 0; i < pageEntityFields.length; ++i) {
      if (name == pageEntityFields[i]['name']) {
        found = pageEntityFields[i];
        break;
      }
    }

    return found;
  }

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

    $('#pageEntityFields')
      .resizable()
      .css('max-height', 0.45 * $(window).height());
  } // _renderPageEntityFields
});
