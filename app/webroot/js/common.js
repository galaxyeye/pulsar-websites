﻿function getcookie(name) {
  var cookie_start = document.cookie.indexOf(name);
  var cookie_end = document.cookie.indexOf(";", cookie_start);
  return cookie_start == -1 ? '' : unescape(document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length)));
}

function setcookie(cookieName, cookieValue, seconds, path, domain, secure) {
  var expires = new Date();
  expires.setTime(expires.getTime() + seconds);
  document.cookie = escape(cookieName) + '=' + escape(cookieValue)
    + (expires ? '; expires=' + expires.toGMTString() : '')
    + (path ? '; path=' + path : '/')
    + (domain ? '; domain=' + domain : '')
    + (secure ? '; secure' : '');
}

function checkLength(o, n, min, max ) {
  if (o.val().length > max || o.val().length < min ) {
    o.addClass("ui-state-error");
    updateTips("Length of " + n + " must be between " + min + " and " + max + ".");
    return false;
  } else {
    return true;
  }
} // check length

function checkRegexp(o, regexp, n) {
  if (!(regexp.test(o.val()))) {
    o.addClass("ui-state-error");
    updateTips(n);
    return false;
  } else {
    return true;
  }
} // check regex

function updateTips(t) {
  tips.text(t).addClass("ui-state-highlight");

  setTimeout(function() {
    tips.removeClass("ui-state-highlight", 1500);
  }, 500);
} // update tips

function isValidURL(url){
  var reg = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

  if(reg.test(url)) {
    return true;
  }
  else {
    return false;
  }
}

function exponentialIncrease(base, ceil) {
  base *= 2;
  if (base > ceil) base = ceil;

  return base;
}

function exponentialDecrease(base, floor) {
  base /= 2;
  if (base < floor) base = floor;

  return base;
}

function getCakePHPUrl(controller, action, params) {
	var url = globalPageData.webroot + controller 
		+ "/" + action;

	var type = typeof params;
	if (type === 'boolean' || type === 'number' || type === 'string') {
		url += "/";
		url += params;
	}
	else if (type === 'object') {
		for (var key in params) {
			url += "/";
			url += key + ":" + params[key];
		}
	}

	return url;
}

function parseChecker(url) {
	
}

function registerCommonEventHander() {
  $('div.form.auto-validate').submit(function() {
    var notEmpty = true;
    $('div.input.required input').each(function(i) {
      if (notEmpty && this.value == '') {
        notEmpty = false;
        openTip("This field must not be empty", this, 1);
      }
    });

    return notEmpty;
  });

  // Tips
  $('form div.input input')
  .add('form div.input textarea')
  .add('form div.input select')
  .add('div.view h2 span')
  .add('div.related h3 span')
  .on('mouseenter', function() {
	// $(".xubox_tips+.xubox_close").trigger("click");
    var tip = $(this).parent().find('.m.hidden').html();
    if (tip) {
      openTip(tip, this, 1, 60);
    }
  })
  .on('mouseout', function() {
    $(".xubox_tips").parent().parent().hide();
  })
  .on('blur', function() {
	$(".xubox_tips").parent().parent().hide();
   });
}

function openUrlInLayer(url, params = {}) {
  $.layer({
    type : 1,
    // title : '弹性分布式网页集概要',
    title : params.title ? params.title : false,
    border : false,
    move: params.move ? params.move : ".movable",
    // move : ".xubox_title",
    moveType : 1,
    area: ['751px', 'auto'],
    shift: 'left', //从左动画弹出
    page : {'url' : url},
    // zIndex : 19891010,
    success: function(layero) {
      // layero.find('.m').show();
      // layero.find('.actions').hide();
      // alert(dump(layero));
      // registerCommonEventHander();
    }
  });
}

function openTip(tip, target, guide, time) {
    if (!guide) guide = 0;
    if (!time) time = 5;

    layer.tips(tip, target, {
      maxWidth : 450,
      guide : guide,
      time : time,
      closeBtn:[0, true],
      style: ['background-color:#613D08; color:#FFDA68; text-align:left; font-size:120%', '#613D08'],
    });
}

$(document).ready(function() {
  registerCommonEventHander();

  var flashMessage = $('#flashMessage').text();
  if (flashMessage) {
    layer.msg($('#flashMessage').html(), 3, 1);
  }
});
