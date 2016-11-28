/** Date picker */
const datePickerDateFormat = "yy-mm-dd";
const datePickerOptions = {
  defaultDate : "+1w",
  changeMonth : true,
  numberOfMonths : 1,
  dateFormat : datePickerDateFormat
};

var solrParamQ = "";

var dateRange = {startTime : "NOW-30DAY/DAY", endTime : "NOW"};

function datePickerGetDate(element) {
  var date;
  try {
    date = $.datepicker.parseDate(datePickerDateFormat, element.value);
  } catch(error) {
    date = null;
  }

  return date;
}

function calculateDateRange() {
  var startTime = $("#startTime").val();
  var endTime = $("#endTime").val();

  if (!startTime || !endTime) {
    startTime = "NOW-30DAY/DAY";
    endTime = "NOW";
  }

  return {startTime : startTime, endTime : endTime};
}

function calculateSolrParamQ() {
  solrParamQ = "";

  dateRange = calculateDateRange();

  if (dateRange.startTime != "" && dateRange.endTime != "") {
    solrParamQ += " AND last_modified:[" + dateRange.startTime + " TO " + dateRange.endTime + "]";
  }

  return solrParamQ;
}

function reloadData() {
  solrParamQ = calculateSolrParamQ();

  $('#reloadableArea').hide();
  layer.msg('加载中...', {icon : 16, shade : [0.5, '#f5f5f5'], scrollbar : false, time:10000});
  var url = "/ec/index?" + "/" + solrParamQ;

  var message = url + "<br />";
  message += solrParamQ + "<br />";
  $('.message').html(message);

  $.post(url, {solrParamQ: solrParamQ}, function (html) {
    layer.closeAll();

    var reloadableArea = $(html).find('#reloadableArea').get(0);
    $('#reloadableArea').html(reloadableArea.innerHTML).show();
  });
}

$(document).ready(function() {
  var from = $("#startTime").datepicker(datePickerOptions).on("change", function() {
    to.datepicker( "option", "minDate", datePickerGetDate(this));
  });

  var to = $("#endTime").datepicker(datePickerOptions).on("change", function() {
    from.datepicker( "option", "maxDate", datePickerGetDate(this));
  });

  $('input.submit').click(function () {
    reloadData();
  });
});
