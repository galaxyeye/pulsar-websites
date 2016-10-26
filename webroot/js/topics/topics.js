$(document).ready(function() {

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

  var dateFormat = "yy-mm-dd";
  var from = $("#dateFrom").datepicker({
    defaultDate : "+1w",
    changeMonth : true,
    numberOfMonths : 1,
    dateFormat : dateFormat
  }).on( "change", function() {
    to.datepicker( "option", "minDate", getDate(this));
  });

  var to = $("#dateTo").datepicker({
    defaultDate : "+1w",
    changeMonth : true,
    numberOfMonths : 1,
    dateFormat : dateFormat
  }).on( "change", function() {
    from.datepicker( "option", "maxDate", getDate(this));
  });

  function getDate( element ) {
    var date;
    try {
      date = $.datepicker.parseDate(dateFormat, element.value);
    } catch( error ) {
      date = null;
    }

    return date;
  }

  $('.filter button.submit').click(function () {
    var dateFrom = $("#dateFrom").val();
    var dateTo = $("#dateTo").val();
    var alertLevel = $("#FilterAlertLevel").val();
    var sentiment = $("#FilterSentiment").val();
    var resourceCategory = $("#FilterResourceCategory").val();
    var sourceSite = $("#FilterSourceSite").val();
    var author = $("#FilterAuthor").val();

    var query = "";
    if (dateFrom != "" && dateTo != "") {
      query += " AND last_crawl_time:[" + dateFrom + "T00:00:00Z" + " TO " + dateTo + "T00:00:00Z" + "]";
    }
    if (alertLevel != "" && alertLevel != "预警级别" && alertLevel != "无预警") {
      // query += " AND alert_level:" + alertLevel;
    }
    if (sentiment != "" && sentiment != "正负面" && sentiment != "全部" ) {
      // query += " AND sentiment:" + sentiment;
    }
    if (resourceCategory != "" && resourceCategory != "资源类型" && resourceCategory != "全部" ) {
      query += " AND resource_category:" + resourceCategory;
    }
    if (sourceSite != "" && sourceSite != "来源") {
      query += " AND (host:" + sourceSite + " OR site_name:" + sourceSite + ")";
    }
    if (author != "" && author != "作者") {
      query += " AND (author:\"" + author + "\" OR director:\"" + author + "\")";
    }

    if (query.indexOf(" AND ") != -1) {
      query = query.substr(" AND ".length);
    }

    // var url = getCakePHPUrl("common", "symmetricEncode", query);
    var url = "/common/symmetricEncode";
    $.post(url, {text : query}, function (encodedQuery) {
      url = "/u/topics/monitor/" + topicId + "/" + encodedQuery;
      var message = query + "<br />";
      message += url + "<br />";
      $('.message').html(message);
      window.location = url;
    });

    // $('.message').html(dateFrom + "<br />"
    //     + dateTo+ "<br />"
    //     + alertLevel+ "<br />"
    //     + sentiment+ "<br />"
    //     + resourceCategory+ "<br />"
    //     + sourceSite+ "<br />"
    //     + author+ "<br />"
    // );
  });

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
});
