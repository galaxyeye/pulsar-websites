$(document).ready(function() {

  var startUpTip = $('.start-up-tip').html();
  // layer.msg(startUpTip, 3, -1);

  $('.crawls .help').on('click', function() {
    openTip(startUpTip, '.crawls .help', 3);
  });

  $('.add').on('click', function() {
    var ele = $(this).parent().get(0);
    var models = parseInt(ele.attributes['models'].value);
    var maxModels = parseInt(ele.attributes['max-models'].value);
    if (models < maxModels) {
    	ele.attributes['models'].value++;
    	__adjustModel(ele);
    }
  });

  $('.del').on('click', function() {
    var ele = $(this).parent().get(0);
    var models = parseInt(ele.attributes['models'].value);
    var minModels = parseInt(ele.attributes['min-models'].value);
    if (models > minModels) {
    	ele.attributes['models'].value--;
    	__adjustModel(ele);
    }
  });

  $('fieldset.related').each(function(i, ele) {
  	__adjustModel(ele);
  });

  function __adjustModel(ele) {
    var count = parseInt(ele.attributes['models'].value);
    var maxCount = parseInt(ele.attributes['max-models'].value);

	$(ele).find('div.fieldset:lt(' + count + ')').show();
	$(ele).find('div.fieldset:eq(' + count + ')').hide();
	$(ele).find('div.fieldset:gt(' + count + ')').hide();

    for (var i = 0; i < maxCount; ++i) {
    	var cls = ".i_" + i;
    	if (i < count) {
    		$(ele).find(cls + ' input').removeAttr('disabled');
    		$(ele).find(cls + ' select').removeAttr('disabled');
    		$(ele).find(cls + ' textarea').removeAttr('disabled');
    	}
    	else {
    		$(ele).find(cls + ' input').attr('disabled', 'disabled');
    		$(ele).find(cls + ' select').attr('disabled', 'disabled');
    		$(ele).find(cls + ' textarea').attr('disabled', 'disabled');
    	}
    }
  }
});
