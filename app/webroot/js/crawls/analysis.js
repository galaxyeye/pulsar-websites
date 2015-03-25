$(document).ready(function() {

  if (stepNo == 1) {
    processStep1();
  }
  else if (stepNo == 2) {
    processStep2();
  }
  else if (stepNo == 3) {
    processStep3();
  }
  else if (stepNo == 4) {
    processStep4();
  }
  else if (stepNo == 5) {
    processStep5();
  }

  function processStep1() {
    $('.submit input[type=submit]').click(function() {
      $(this).hide();
      layer.load('后台分析中，请稍候......', 30);
    });
  } // processStep1

  function processStep2() {
      $.layer({
          type: 1,
          title: false,
          border : false,
          shade: false,
          closeBtn: [0, true],
          maxmin: true,
          title: '链接模式',
          move: '.xubox_title',
          moveOut: true,
          moveType: 1,
          area: ['751px', 'auto'],
          page: {dom : '.add-wes.form'}
      });

      $('.choose.index').click(function() {
        var regex = $(this).parent().find('h2').text();
        $('#CrawlFilter0UrlFilter').val(regex);
      });

      $('.choose.detail').click(function() {
        var regex = $(this).parent().find('h2').text();
        $('#CrawlFilter1UrlFilter').val(regex);
      });
  } // processStep2

  function processStep3() {
      openTip('现在可以点击启动爬虫了。', '.submit input[type=submit]', 1, 30);
  } // processStep3

  function processStep4() {
    // layer.load('正在等待抓取服务器，请稍候......', 30);

    var open = $('#confirmExtraction').data('open');
    if (!open) openConfirmExtractionLayer(0);

    var interval = setInterval(function() {
      if (!$('body').hasClass('visible')) {
        return;
      }

      refreshNutchJobInfo();
      refreshCrawlView();
      refreshFetchedCount();
    }, 5 * 1000);
  } // processStep4

  function processStep5() {
    layer.load('正在分析挖掘结果，请稍候......', 300);

    var interval = setInterval(function() {
      if (!$('body').hasClass('visible')) {
        return;
      }

      var id = $('.scentJobs.view .model-id').text();
      var url = getCakePHPUrl('scent_jobs', 'ajax_getJobInfo', id, 'true');
      $.getJSON(url, function(results) {
        if (results['state'] == undefined || results['state'] == 'FAILED') {
          clearInterval(interval);
        }

        $("#scentJobInfoRaw pre").html(JSON.stringify(results, null, 4));

        if (results['state'] == 'FINISHED' && results['msg'] == 'OK') {
          clearInterval(interval);

          layer.msg('挖掘成功', 2, {type : 1});
          showExtractResultAsSQL();
        }
      });
    }, 2000);
  } // processStep5

  function refreshNutchJobInfo() {
      var id = $('.crawls.view .model-id').text();
      var url = getCakePHPUrl('crawls', 'ajax_getJobInfo', id);

      // request 1
      $.getJSON(url, function(data) {
        if (data['state'] != undefined) {
          $("#jobInfo").html($("#jobInfoTemplate").render(data));
        }

        if (data['state'] == undefined || data['state'] == 'FAILED') {
          $("#jobInfo").html("Something wrong in Nutch Server");
          $("#jobInfo").append("<pre>" + JSON.stringify(data, null, 4) + "</pre>");
        }
      });
  }

  function refreshCrawlView() {
      var id = $('.crawls.view .model-id').text();
      var url = getCakePHPUrl('crawls', 'ajax_get', id);

      $.getJSON(url, function(crawl) {
        $('#finishedRounds').text(crawl['Crawl']['finished_rounds']);
      });
  }

  function refreshFetchedCount() {
    var id = $('.crawls.view .model-id').text();
    var url = getCakePHPUrl('web_pages', 'ajax_getFetchedDetailPageCount', id);

    $.get(url, function(count) {
      $('.fetched.count').html(count);
    });
  }

  function openConfirmExtractionLayer(count) {
    layer.closeAll();

    $('#confirmExtraction').data('open', 'true');
    $.layer({
          type: 1,
          title: false,
          border : false,
//          shade: [0.5, '#000'],
          shade: [0],
          closeBtn: [0, true],
          maxmin: true,
          title: '准备抽取',
          move: '.xubox_title',
          moveOut: true,
          moveType: 1,
          area: ['751px', 'auto'],
          page: {dom : '#confirmExtraction'}
    });

    $('.create-rule').click(function() {
      var id = $('.pageEntities.view .model-id').text();
      var url = getCakePHPUrl('web_pages', 'indexByPageEntity', id, {page_entity_id : id});
      window.open(url);
    });

    $('.start-extraction').click(function() {
      $(this).hide();
      layer.load('抽取任务提交中，请稍候......', 30);

      startExtraction();
    });
  } // openConfirmExtractionLayer

  function startExtraction() {
    var id = $('.pageEntities.view .model-id').text();
    var url = getCakePHPUrl('page_entities', 'ajax_startExtraction', id);
    $.getJSON(url, function(status) {
      if (status.code == 200) {
        url = getCakePHPUrl('crawls', 'analysis', {stepNo : 5, page_entity_id : id});
        window.location = url;
      }
      else {
        layer.confirm("Failed to start extraction\n" + status.customMessage);
      }
    });
  } // startExtraction

  function showExtractResultAsSQL() {
    var id = $('.scentJobs.view .model-id').text();
    var url = getCakePHPUrl('scent_jobs', 'ajax_getExtractResultAsSQL', id);
    $.getJSON(url, function(sqls) {
      $("#sqlList").html($("#sqlListTemplate").render(sqls));
      if (sqls.length > 2) {
        $('.download').show();
      }
      // showExtractResultInLayer();
    });
  }

  function showExtractResultInLayer() {
    layer.closeAll();

    $.layer({
      type: 1,
      title: false,
      border : false,
//      shade: [0.5, '#000'],
      shade: [0],
      closeBtn: [0, true],
      maxmin: true,
      title: '挖掘结果',
      move: '.xubox_title',
      moveOut: true,
      moveType: 1,
      area: ['751px', 'auto'],
      page: {dom : '#sqlList'}
    });
  }
});
