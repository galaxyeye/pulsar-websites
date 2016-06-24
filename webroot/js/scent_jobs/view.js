$(document).ready(function() {
  $('.hidden').hide();

  layer.load('正在查询，请稍候......', 2);

  var interval = setInterval(function() {
    if (!$('body').hasClass('visible')) {
      return;
    }

    var id = $('.scentJobs.view .model-id').text();
    var url = getCakePHPUrl('scent_jobs', 'ajax_getJobInfo', id, 'true');
    $.getJSON(url, function(jobInfo) {
      processJobStatus(jobInfo);
    });
  }, 3000);

  function processJobStatus(jobInfo) {
    if (jobInfo['state'] == undefined) {
      layer.msg('任务已结束。', 5, {type : 1});
      clearInterval(interval);
      return;
    }

    if (jobInfo['state'] == 'FAILED') {
      clearInterval(interval);
      layer.msg('挖掘失败。', 5, {type : 5});
      return;
    }

    $("#jobInfoRaw").html(JSON.stringify(jobInfo, null, 4));

    var jobId = jobInfo['id'];
    var processedCount = jobInfo['status']['jobs'][jobId]['counters']['Extraction']['processed.count'];
    $('.extract-count').text(processedCount);

    if (jobInfo['state'] == 'RUNNING' && jobInfo['msg'] == 'OK') {
      layer.load('任务正在执行中，已处理 ' + processedCount + ' 个网页', 2);
    }

    if (jobInfo['state'] == 'FINISHED' && jobInfo['msg'] == 'OK') {
      clearInterval(interval);

      layer.msg('挖掘成功，正在分析挖掘结果......', 300, {type : 1});
      showMingingResult();
    }
  } // processJobStatus

  function showMingingResult() {
    layer.closeAll();
    $.layer({
        type: 1,
        title: false,
        border : true,
        shade: [0.5, '#000'],
        area: ['751px', 'auto'],
        page: {dom : '#mingingResult'}
    });
  }
});
