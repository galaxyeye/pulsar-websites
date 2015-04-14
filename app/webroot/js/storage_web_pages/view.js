$(document).ready(function() {
  var draggableActived = true;
  var pageEntityFields = pageEntity['PageEntityField'];

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
    shift: 'left', //从左动画弹出
    page : {dom : '#systemPanel'},
    // zIndex : 19891010,
    success: function(layero) {
      // layero.find('.m').show();
      // layero.find('.actions').hide();
      // alert(dump(layero));
      // registerCommonEventHander();
    }
  });

  /**
   * @Deprecated due to too complex web interaction
   * */
  $('.analysis-extract-rule').click(function() {
    var target = getCakePHPUrl('scent_jobs', 'ajax_extract');
    var data = {url : storageWebPage['StorageWebPage']['url'], html : storageWebPage['StorageWebPage']['content'], format : 'all'}
    $.post(target, data, function(results) {
      $("#qiwurHtmlWrapper").html(results['result']);
    }, 'json');
  });

  $('.auto-analysis-rules').click(function() {
    var page_entity_id = pageEntity['PageEntity']['id'];
    var url = getCakePHPUrl('storage_web_pages', 'analysis', encodedUrl, {page_entity_id : page_entity_id});
    window.open(url);
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

  $('.hide-selected-ele').click(function() {
    var selector = $(".current-selector").text();
    selector = selector.replace("body", "#qiwurBody");
    $(selector).hide();
  });

  $('.save-extract-rule').click(function() {
    _saveExtractRules();
  });

  $('.clear-extract-rule').click(function() {
    pageEntityFields = [];
    _renderPageEntityFields();
  });

  $('.start-ruled-extract').click(function() {
    var id = pageEntity['PageEntity']['id'];
    var url = getCakePHPUrl('page_entities', 'view', id);

    _saveExtractRules(url);
  });

  function _saveExtractRules(redirect = false) {
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

  function _installDraggingDropping() {
    $('#qiwurHtmlWrapper *')
    .on('mousedown', function(event) {
      event.stopPropagation();
      var selector = _getSelector(this);

      layer.tips(selector, this, {
        maxWidth : 10000,
        guide : 0,
        time : 30,
        closeBtn:[0, true],
        style: ['background-color:#613D08; color:#FFDA68; text-align:left; font-size:120%', '#613D08']
      });

  	  $(this).attr('cssSelector', selector);
      $('.current-selector').html(selector);
      // alert(path);
    })
    .draggable({
      zIndex: $('.xubox_layer').css('z-index') + 1,
      grid: [ 50, 20 ],
      refreshPositions: true,
      revert: true,
      start: function(event, ui) {
        // $(this).width($(this).width() / 3);
        // alert('start' + dump($(this).data('ui-position')));
      },
      drag : function(event, ui) {
//         // save original position
//         $(this).data('ui-position', ui.position);
        $('.xubox_tips').parent().parent().addClass('qiwur-hidden').hide();
      },
      stop: function(event, ui) {
        // $(this).width($(this).width() * 3);

//        ui.positon = $(this).data('ui-position');
        // alert('stop' + dump($(this).data('ui-position')));
      }
    });

    // tolerance : 'touch'
    $(".extract-field-name .dropper").droppable({
      tolerance : 'touch',
      drop: function(event, ui) {
        var text = ui.draggable.text();
        text = text.replace(/[:：\s+]/ig, "");
        if (text.length > 40) {
          return false;
        }
        if (event.target.childNodes.length > 10) {
          return false;
        }

        $(this).find('.dropper-dropzone').val(text);
      }
    });

    $(".extract-field-value .dropper").droppable({
      tolerance : 'touch',
      drop: function(event, ui) {
        if ($(ui.draggable).find('div').size() * 2 > $('body').find('div').size()) {
          return;
        }

        var name = $('.extract-field-name input').val().trim();
        var selector = ui.draggable.attr('cssSelector');
        // selector = selector.replace(/>/g, ' &gt ');

        $(this).find('.dropper-dropzone').val(selector);
        $(this).find('.dropper-dropzone').attr('title', "当前字段值：" + ui.draggable.text().trim());

        _updatePageEntityFields(name, selector);
        _renderPageEntityFields();
      }
    });

    _renderPageEntityFields();
  } // _installDraggingDropping

  function _getSelector(ele) {
    var selectors = $(ele).getSelector();
    if (selectors.length == 0) {
      return null;
    }

    var selector = null;
    for (var i = 0; i < selectors.length; ++i) {
      if (selectors[i].indexOf("ui-") == -1) {
        selector = selectors[i];
      }
    }
    if (selector == null) {
      selector = selectors[0];
    }

    // selector = selector.replace(/>/g, ' &gt ');
    selector = selector.replace("#qiwurBody", "body");
    selector = selector.replace(/.ui-draggable|.ui-draggable-handle|.ui-draggable-disabled/g, "");
    selector = selector.replace(/>\s+>/g, "");

    return selector;
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

  function _updatePageEntityFields(name, css_path) {
	_delPageEntityFieldByName(name);
    pageEntityFields.push({name : name, css_path : css_path});
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
    $('#pageEntityFields')
      .resizable()
      .animate({ scrollTop: $("#pageEntityFields").scrollTop() + 30 }, 1000)
      .css('max-height', 0.45 * $(window).height())
  } // _renderPageEntityFields
});
