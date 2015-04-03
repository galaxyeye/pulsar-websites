$(document).ready(function() {
  $('.hidden').hide();

  layer.msg('正在查询任务信息，请稍候......', 300, {type : 1});

  var interval = setInterval(function() {
      if (!$('body').hasClass('visible')) {
        return;
      }

      var id = $('.scentJobs.view .model-id').text();
      var url = getCakePHPUrl('scent_jobs', 'ajax_getJobInfo', id, 'true');
      $.getJSON(url, function(results) {
        if (results['state'] == undefined || results['state'] == 'FAILED') {
          layer.closeAll();
          clearInterval(interval);
        }

        $("#scentJobInfoRaw pre").html(JSON.stringify(results, null, 4));

        if (results['state'] == 'FINISHED' && results['msg'] == 'OK') {
          clearInterval(interval);

          layer.msg('挖掘成功，正在分析挖掘结果......', 300, {type : 1});
          showExtractResultAsSQL();
        }
        else if (results['state'] == 'FAILED') {
          layer.msg('挖掘失败', 5, {type : 5});
        }
      });
  }, 2000);

  function showExtractResultAsSQL() {
	    var id = $('.scentJobs.view .model-id').text();
	    var url = getCakePHPUrl('scent_jobs', 'ajax_getExtractResultAsSQL', id);
	    $.getJSON(url, function(sqls) {
	      layer.closeAll();
	      $("#sqlList").html($("#sqlListTemplate").render(sqls));
	      if (sqls.length > 2) {
	        $('.download').show();
	      }
	    });
  }
});
