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

    var timerCounter = 0;
    var interval = setInterval(function() {
      if (!$('body').hasClass('visible')) {
        return;
      }

      var sucess = refreshNutchJobInfo();
      if (!status) sucess = refreshCrawlView();

      if (!sucess) {
        clearInterval(interval);
      }

      ++timerCounter;
    }, 10 * 1000);
  } // processStep4

  function processStep5() {
    layer.load('正在查询挖掘进展，请稍候......', 300);

    var interval = setInterval(function() {
      if (!$('body').hasClass('visible')) {
        return;
      }

      var id = $('.scentJobs.view .model-id').text();
      var url = getCakePHPUrl('scent_jobs', 'ajax_getJobInfo', id, 'true');
      $.getJSON(url, function(results) {
          if (results['state'] == undefined || results['state'] == 'FAILED') {
            clearInterval(interval);
            layer.msg('挖掘失败', 5, {type : 5});
            return;
          }

          $("#jobInfoRaw").html(JSON.stringify(results, null, 4));

          var jobId = results['id'];
          var processedCount = results['status']['jobs'][jobId]['counters']['Extraction']['processed.count'];
          $('.extract-count').text(processedCount);

          if (results['state'] == 'RUNNING' && results['msg'] == 'OK') {
            layer.load('任务正在执行中，已处理 ' + processedCount + ' 个网页', 2);
          }

          if (results['state'] == 'FINISHED' && results['msg'] == 'OK') {
            clearInterval(interval);

            layer.msg('挖掘成功，正在分析挖掘结果......', 300, {type : 1});
            showMiningResult();
          }
      });
    }, 2000);
  } // processStep5

  function refreshNutchJobInfo() {
    var id = $('.crawls.view .model-id').text();
    var url = getCakePHPUrl('crawls', 'ajax_getJobInfo', id);
    $.getJSON(url, function(jobInfo) {
      if (jobInfo['state'] == undefined || jobInfo['state'] == 'FAILED') {
        $("#jobInfo").html("<p class='red'>出现故障</p>");
        return false;
      }

      $("#jobInfo").html(JSON.stringify(jobInfo, null, 4));

      var jobId = jobInfo['id'];
      var counters = jobInfo['status']['jobs'][jobId]['counters'];
      if (counters != undefined) {
          var fetchedPages = counters['FetcherStatus']['FetchedPages'];
          var fetchedIndexPages = counters['FetcherStatus']['FetchedIndexPages'];
          var fetchedDetailPages = counters['FetcherStatus']['FetchedDetailPages'];

          $('.fetched.count').text(fetchedPages);
          $('.fetched.index.count').text(fetchedIndexPages);
          $('.fetched.detail.count').text(fetchedDetailPages);    	  
      }

      return true;
    });
  }

  function refreshCrawlView() {
    var id = $('.crawls.view .model-id').text();
    var url = getCakePHPUrl('crawls', 'ajax_get', id);

    $.getJSON(url, function(crawl) {
      $('.finishedRounds').text(crawl['Crawl']['finished_rounds']);
    });

    return true;
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
      var regex = $('.pageEntities.view .regex').text();

      var url = "/storage_web_pages?regex=" + regex + "&page_entity_id=" + id;
      window.open(url);
    });

    $('.start-ruled-extract').click(function() {
      $(this).hide();
      layer.load('抽取任务提交中，请稍候......', 30);

      startRuledExtraction();
    });

    $('.start-auto-extract').click(function() {
      $(this).hide();
      layer.load('抽取任务提交中，请稍候......', 30);

      startAutoExtraction();
    });
  } // openConfirmExtractionLayer

  function startRuledExtraction() {
    var id = $('.pageEntities.view .model-id').text();
    var url = getCakePHPUrl('page_entities', 'ajax_startRuledExtract', id);
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

  function startAutoExtraction() {
    var id = $('.pageEntities.view .model-id').text();
    var url = getCakePHPUrl('page_entities', 'ajax_startAutoExtract', id);
    $.getJSON(url, function(status) {
      if (status.code == 200) {
        url = getCakePHPUrl('crawls', 'analysis', {stepNo : 5, page_entity_id : id});
        window.location = url;
      }
      else {
        layer.confirm("Failed to start extraction\n" + status.customMessage);
      }
    });
  } // startAutoExtraction

  function showExtractResultAsWebsite(outFolder) {
    url = getCakePHPUrl('web_pages', 'showExtractResultAsWebsite', outFolder);
    $('#autoExtractResult').show();
    $('#autoExtractResult a').attr('href', url);

    layer.closeAll();
    $.layer({
        type: 1,
        title: false,
        border : true,
        shade: [0.5, '#000'],
        area: ['751px', 'auto'],
        page: {dom : '#autoExtractResult'}
    });
  } // showExtractResultAsWebsite

  function showMiningResult() {
    layer.closeAll();
    $.layer({
        type: 1,
        title: false,
        border : true,
        shade: [0.5, '#000'],
        area: ['751px', 'auto'],
        page: {dom : '#miningResult'}
    });
  }
});
