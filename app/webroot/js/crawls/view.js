$(document).ready(function() {

  var webroot = globalPageData.webroot,
  seedUrlDialog,
  seedUrlform,
  seedUrl = $("#seedUrl"),
  crawlId = $("#crawlId").val(),
  seedUrlFields = $([]).add(seedUrl),
  tips = $(".validateTips");

//  function addSeedUrl() {
//    var valid = true;
//    seedUrlFields.removeClass("ui-state-error");
//    valid = valid && checkLength(seedUrl, "Seed Url", 10, 1024);
//
//    if (valid) {
//      var data = {
//          'data[Seed][url]' : seedUrl.val(),
//          'data[Seed][crawl_id]' : crawlId
//      };
//
//      $.post(webroot + 'seeds/ajax_add/', data, function(result) {
//        var id = result['Seed']['id'];
//        var url = result['Seed']['url'];
//
//        var delUrl = webroot + "seeds/delete/" + id;
//        var delMessage = "return confirm('Are you sure you want to delete #" + id + "?';";
//        // var delAction = "<a href='" + delUrl + "' onclick='" + delMessage + "'>删除</a>";
//        var delAction = "<a class='del' data-seed-id=" + id + ">删除</a>";
//
//        $(".seeds tr").last().after("<tr><td>" + id + "</td><td>" + url + "</td><td class='actions'>" + delAction + "</td></tr>");
//
//        $(".seeds .actions .del").on("click", delSeedUrl);
//      }, 'json');
//
//      seedUrlDialog.dialog("close");
//    }
//
//    return valid;
//  } // add seed url

  // add/view/edit in a new layer
  $('#stage a').filter(function(index) {
    return this.href.length > 1 && this.href.indexOf('delete') == -1 && this.target != '_blank';
  }).on("click", function(event) {
	var params = {};
	if (this.href.indexOf('crawl_filter') !== -1) {
		params.title = "Move Me ";
		params.move = ".xubox_title";
	}
    openUrlInLayer(this.href, params);

    return false;
  });

  // popup confirm before delete
//  $('a').filter(function(index) {
//    return this.href.length > 1 && this.href.indexOf('delete') != -1 && this.target != '_blank';
//  }).on("click", function(event) {
//    var id = $(this).parent().parent().find('td.model-id').text();
//    var sure = layer.confirm("Are you sure you want to delete #" + id);
//
//    if (id && sure) {
//      $.get(this.href);
//    }
//
//    return false;
//  });

//  seedUrlDialog = $("#seed-url-dialog-form").dialog({
//    autoOpen: false,
//    height: 300,
//    width: 750,
//    modal: true,
//    buttons: {
//      "Add a seed url": addSeedUrl,
//      Cancel: function() {
//      seedUrlDialog.dialog("close");
//      }
//    },
//    close: function() {
//      seedUrlForm[0].reset();
//      seedUrlFields.removeClass("ui-state-error");
//    }
//  });
//
//  seedUrlForm = seedUrlDialog.find("form").on("submit", function(event) {
//    event.preventDefault();
//    addSeedUrl();
//  });

  var interval = setInterval(function() {
  // TODO : remove this line on product
    clearInterval(interval);

    var id = $('.model-id').text();
    $.getJSON('../ajax_getJobInfo/' + id, function(data) {
      if (data['state'] != undefined) {
        $("#jobInfo").html($("#jobInfoTemplate").render(data));
      }

      // $(".message").html('data : ' + data);

      if (data['state'] == undefined || data['state'] == 'FAILED') {
        clearInterval(interval);
      }
    });
  }, 2000);
});
