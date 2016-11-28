/** Date picker */
const datePickerDateFormat = "yy-mm-dd";
const datePickerOptions = {
  defaultDate : "+1w",
  changeMonth : true,
  numberOfMonths : 1,
  dateFormat : datePickerDateFormat
};

var solrParamQ = "";
var solrParams = {};

var chartOption = null;
var statAction = "statTrends";

var dateRange = {startTime : "NOW-30DAY/DAY", endTime : "NOW"};
var alertLevel = "";
var sentiment = "";
var resourceCategory = "";
var sourceSite = "";
var author = "";

function datePickerGetDate(element) {
  var date;
  try {
    date = $.datepicker.parseDate(datePickerDateFormat, element.value);
  } catch( error ) {
    date = null;
  }

  return date;
}

function calculateDateRange() {
  var dateFrom = $('.filter.datetime .date.selected').attr('data-start-date');
  var dateTo = $('.filter.datetime .date.selected').attr('data-end-date');

  var datePickerFrom = $("#dateFrom").val();
  var datePickerTo = $("#dateTo").val();
  if (datePickerFrom != "" && datePickerTo != "") {
    dateFrom = datePickerFrom + "T00:00:00Z";
    dateTo = datePickerTo + "T00:00:00Z";

    $('.filter.datetime .date').removeClass('selected');
  }

  if (!dateFrom || !dateTo) {
    dateFrom = "NOW-30DAY/DAY";
    dateTo = "NOW";
  }

  return {startTime : dateFrom, endTime : dateTo};
}

function calculateSolrParamQ() {
  solrParamQ = "";

  dateRange = calculateDateRange();
  alertLevel = $("#FilterAlertLevel").val();
  sentiment = $("#FilterSentiment").val();
  resourceCategory = $("#FilterResourceCategory").val();
  sourceSite = $("#FilterSourceSite").val();
  author = $("#FilterAuthor").val();

  if (dateRange.startTime != "" && dateRange.endTime != "") {
    solrParamQ += " AND publish_time:[" + dateRange.startTime + " TO " + dateRange.endTime + "]";
    // solrParamQ += " AND last_crawl_time:[" + dateRange.startTime + " TO " + dateRange.endTime + "]";
  }
  if (alertLevel != "" && alertLevel != "预警级别" && alertLevel != "无预警") {
    // solrParamQ += " AND alert_level:" + alertLevel;
  }
  if (sentiment != "" && sentiment != "正负面" && sentiment != "全部" ) {
    // solrParamQ += " AND sentiment:" + sentiment;
  }
  if (resourceCategory != "" && resourceCategory != "资源类型" && resourceCategory != "全部" ) {
    solrParamQ += " AND resource_category:" + resourceCategory;
  }
  if (sourceSite != "" && sourceSite != "来源") {
    solrParamQ += " AND (host:" + sourceSite + " OR site_name:" + sourceSite + ")";
  }
  if (author != "" && author != "作者") {
    solrParamQ += " AND (author:\"" + author + "\" OR director:\"" + author + "\")";
  }
  if (solrParamQ.indexOf(" AND ") == 0) {
    solrParamQ = solrParamQ.substr(" AND ".length);
  }

  return solrParamQ;
}

function reloadData() {
  if (queryAction == "monitor") {
    reloadMonitoredList();
  }
  else if (queryAction == "stat") {
    reloadStatChart();
  }
}

function reloadMonitoredList() {
  solrParamQ = calculateSolrParamQ();

  $('#reloadableArea').hide();
  layer.msg('加载中...', {icon : 16, shade : [0.5, '#f5f5f5'], scrollbar : false, time:10000});
  var url = "/u/topics/" + queryAction + "/" + topicId;

  var message = url + "<br />";
  message += solrParamQ + "<br />";
  $('.message').html(message);

  $.post(url, {solrParamQ: solrParamQ}, function (html) {
    layer.closeAll();

    var reloadableArea = $(html).find('#reloadableArea').get(0);
    $('#reloadableArea').html(reloadableArea.innerHTML).show();
  });
}

// 使用刚指定的配置项和数据显示图表
function reloadStatChart() {
  solrParamQ = calculateSolrParamQ();

  var url = "/u/topics/" + statAction + "/" + topicId + "/json";

  var message = url + "<br />";
  message += solrParamQ + "<br />";
  $('.message').html(message);
  // message += "<pre>" + JSON.stringify(chartOption, null, 4) + "</pre>" + "<br />";

  layer.msg('加载中...', {icon : 16, shade : [0.5, '#f5f5f5'], scrollbar : false, time:10000});
  $.post(url, {solrParamQ : solrParamQ, solrParams : solrParams, dateRange : dateRange}, function (result) {
    layer.closeAll();

    if (chartOption.xAxis && result.xAxis) {
      chartOption.xAxis = result.xAxis;
    }
    chartOption.series = result.series;

    mainChart.hideLoading();
    mainChart.setOption(chartOption);
    // mainChart.redraw(true);

    message += result['header']['request']['url'] + "<br />";
    // message += "<pre>" + JSON.stringify(result, null, 4) + "</pre><br />";
    // message += "<pre>" + JSON.stringify(chartOption, null, 4) + "</pre><br />";
    $('.message').html(message);
  }, "json");
}

$(document).ready(function() {
  /**
   * Query filters
   * */
  $('.filter.datetime .date').click(function () {
    $('.filter.datetime .date').removeClass('selected');
    $(this).addClass('selected');

    reloadData();
  });

  $('.filter button.submit').click(function () {
    reloadData();
  });

  $('#FilterSourceSite').on('focus', function () {
    var val = $(this).val();
    if (val == "来源") {
      $(this).val("").attr("style", "color:#222");
    }
  }).on('blur', function () {
    var val = $(this).val();
    if (val == "") {
      $(this).val("来源").attr("style", "color:#ccc");
    }
  });

  $('#FilterAuthor').on('focus', function () {
    var val = $(this).val();
    if (val == "作者") {
      $(this).val("").attr("style", "color:#222");
    }
  }).on('blur', function () {
    var val = $(this).val();
    if (val == "") {
      $(this).val("作者").attr("style", "color:#ccc");
    }
  });

  var from = $("#dateFrom").datepicker(datePickerOptions).on( "change", function() {
    to.datepicker( "option", "minDate", datePickerGetDate(this));
  });

  var to = $("#dateTo").datepicker(datePickerOptions).on( "change", function() {
    from.datepicker( "option", "maxDate", datePickerGetDate(this));
  });

  // ajaxUpdateMainChart(statAction, topicId, solrParamQ, solrParams);

  $("#FilterStatType").change(function () {
    // $(".message").text(this.value);

    if (this.value == "曝光量趋势") {
      chartOption = statTrends;
      statAction = "statTrends";
    }
    else if (this.value == "资源类型统计") {
      chartOption = statMediaDistribution;
      statAction = "statMediaDistribution";
    }
    else if (this.value == "资源类型分类统计") {
      chartOption = statTrendsGroupByMedia;
      statAction = "statTrendsGroupByMedia";
    }
    else if (this.value == "正负面统计") {
      chartOption = statSentiment;
      statAction = "statSentiment";
    }
    else if (this.value == "预警报告") {
      chartOption = statAlert;
      statAction = "statAlert";
    }
    else if (this.value == "焦点聚类") {
      chartOption = statHotWords;
      statAction = "statHotWords";
    }
    else if (this.value == "热点话题") {
      chartOption = statHotEvents;
      statAction = "statHotEvents";
    }
    else if (this.value == "标签对比") {
      chartOption = statTagComparation;
      statAction = "statTagComparation";
    }

    reloadStatChart(chartOption, statAction, topicId);
  }); // on change




  /**
   * Utilities
   * */
  $('.doc-list th input.select_all').click(function () {
    var checked = this.checked;
    $('.doc-list td input.select').each(function () {
      this.checked = checked;
    });
  });

  $('.markRead').click(function () {
    var message = "markRead" + "<br />";

    $('.doc-list td input.select').each(function () {
      if (this.checked) {
        var solrId = $(this).parent().find(".data").attr("data-solr-id");
        var url = "/u/monitor/mark/" + topicId + "/" + solrId + "/is_read/" + 1;
        // $.get(url);
        message += url + "<br />";
      }
    });

    $('.message').html(message);
  });

  $('.keep').click(function () {
    var message = "keep" + "<br />";

    $('.doc-list td input.select').each(function () {
      if (this.checked) {
        var solrId = $(this).parent().find(".data").attr("data-solr-id");
        var url = "/u/monitor/mark/" + topicId + "/" + solrId + "/is_keeped/" + 1;
        // $.get(url);
        message += url + "<br />";
      }
    });

    $('.message').html(message);
  });

  $('.cancelKeep').click(function () {
    var message = "cancelKeep" + "<br />";

    $('.doc-list td input.select').each(function () {
      if (this.checked) {
        var solrId = $(this).parent().find(".data").attr("data-solr-id");
        var url = "/u/monitor/mark/" + topicId + "/" + solrId + "/is_keeped/" + 0;
        // $.get(url);
        message += url + "<br />";
      }
    });

    $('.message').html(message);
  });

  $('.deleteRecord').click(function () {
    var message = "deleteRecord" + "<br />";

    $('.doc-list td input.select').each(function () {
      if (this.checked) {
        var solrId = $(this).parent().find(".data").attr("data-solr-id");
        var url = "/u/monitor/mark/" + topicId + "/" + solrId + "/is_deleted/" + 1;
        // $.get(url);
        message += url + "<br />";
      }
    });

    $('.message').html(message);
  });

  $('.sendEmail').click(function () {
    var message = "sendEmail" + "<br />";

    $('.doc-list td input.select').each(function () {
      if (this.checked) {
        var solrId = $(this).parent().find(".data").attr("data-solr-id");
        var url = "/u/monitor/sendEmail/" + topicId + "/" + solrId;
        // $.get(url);
        message += url + "<br />";
      }
    });

    $('.message').html(message);
  });

  $('.download').click(function () {
    var message = "download" + "<br />";

    $('.doc-list td input.select').each(function () {
      if (this.checked) {
        var solrId = $(this).parent().find(".data").attr("data-solr-id");
        var url = "/u/monitor/download/" + topicId + "/" + solrId;
        // $.get(url);
        message += url + "<br />";
      }
    });

    $('.message').html(message);
  });
  
  $('.show-mode .show-list').click(function () {
    $('.doc-list .article-title').show();
    $('.doc-list .abstract').hide();
  });
  
  $('.show-mode .show-abstract').click(function () {
    $('.doc-list .article-title').hide();
    $('.doc-list .abstract').show();
  });
});
