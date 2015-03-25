$(document).ready(function() {
  var draggableActived = true;
  var pageEntityFields = pageEntity['PageEntityField'];

  $.layer({
    type : 1,
    // title : '弹性分布式网页集概要',
    title : "操作界面",
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

  $('.xubox_title').on('mouseover', function() {
    if (draggableActived) {
      _disableDraggable();
    }
  });

  $('.xubox_title').on('mouseout', function() {
    if (draggableActived) {
      _enableDraggable();
    }
  });

  $('.active-draggable').click(function() {
    _enableDraggable();
    draggableActived = true;
  });

  $('.deactive-draggable').click(function() {
    _disableDraggable();
    draggableActived = false;
  });

  $('.hide-info-box').click(function() {
    $('.info-box').hide();
    $('.show-info-box').show();
  });

  $('.show-info-box').click(function() {
    $('.info-box').show();
    $('.hide-info-box').show();
  });

  $('.start-extract-rule').click(function() {
    $('.info-box').hide();
    $('.css-path-collector').show();

//    var target = globalPageData.here + "/onlyContent:true";
//    $("#qiwurHtmlWrapper").load(target);
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
       layer.msg("<pre>" + dump(data) + "</pre>", 5, {type : 1})
     }, 'json');
  });

  $('.clear-extract-rule').click(function() {
    pageEntityFields = [];
    _renderPageEntityFields();
  });

  function _installDraggingDropping() {
    $('*')
    .not('.xubox_layer')
    .not('.xubox_layer *')
    .on('mouseover', function(event) {
      event.stopPropagation();
      var path = $(this).getPath().replace(/>/g, ' &gt ');
      path = path.replace("#qiwurBody", "body");

      layer.tips(path, this, {
        maxWidth : 10000,
        guide : 2,
        time : 30,
        closeBtn:[0, true],
        style: ['background-color:#613D08; color:#FFDA68; text-align:left; font-size:120%', '#613D08']
      });

      // $('#currentCssPath').html(path);
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
        $('.xubox_tips').parent().parent().hide();
      },
      stop: function(event, ui) {
        // $(this).width($(this).width() * 3);

//        ui.positon = $(this).data('ui-position');
        // alert('stop' + dump($(this).data('ui-position')));
      }
    });

    // tolerance : 'touch'
    $(".extract-field-name .dropper").droppable({
      drop: function(event, ui) {
        var text = ui.draggable.text().trim().replace(/[:：]/g, '');
        if (text.length > 40) {
          return false;
        }
        if (event.target.childNodes.length > 10) {
          return false;
        }

        $(this).find('.dropper-dropzone').text(text);
      }
    });

    $(".extract-field-value .dropper").droppable({
      tolerance : 'touch',
      drop: function(event, ui) {
        if ($(ui.draggable).find('div').size() * 2 > $('body').find('div').size()) {
          return;
        }

        var name = $('.extract-field-name').text().trim();
        var cssPath = ui.draggable.getPath().trim();
        cssPath = cssPath.replace("#qiwurBody", "body");

        $(this).find('.dropper-dropzone').text(cssPath);
        $(this).find('.dropper-dropzone').attr('title', "当前字段值：" + ui.draggable.text().trim());

        _updatePageEntityFields(name, cssPath);
        _renderPageEntityFields();
      }
    });

    _renderPageEntityFields();
  } // _installDraggingDropping

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

  function _updatePageEntityFields(name, cssPath) {
    var found = false;
    $.each(pageEntityFields, function(i, field) {
      if (name == field['name']) {
        field['css_path'] = cssPath;
        found = true;
      }
      return field;
    });

    if (!found) {
      var field = {name:name, css_path:cssPath};
      pageEntityFields.push(field);
    }
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

  function _enableDraggable() {
      $('*')
        .not('.xubox_layer')
        .not('.xubox_layer *')
        .draggable('enable');
  } // _enableDraggable

  function _disableDraggable() {
      $('*')
        .not('.xubox_layer')
        .not('.xubox_layer *')
        .draggable('disable');
  } // _disableDraggable
});
