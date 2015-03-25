function getcookie(name) {
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

function getCakePHPUrl() {
  var len = arguments.length;
  if (len == 0) {
    return globalPageData.webroot;
  }

  var controller = arguments[0];
  var action = (len > 1) ? arguments[1] : '';

  var url = globalPageData.webroot + controller;
  url += (len > 1) ? "/" + action : '';

  for (var i = 2; i < len; ++i) {
    var params = arguments[i];

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
  } // for

  return url;
}

function parseChecker(url) {
  
}

function registerCommonEventHander() {
  // Form Auto Validation
  $('div.form.auto-validate').submit(function() {
    var notEmpty = true;
    $('div.input.required input').not(':hidden').each(function(i) {
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

  // Collaspe
  $('.view h2, .view h3, .view h4, .related h2, .related h3, .related h4').click(function() {
    $(this).siblings().slideToggle("slow");
  });

  // add/view/edit in a new layer
  $("a[target='layer']").on("click", function(event) {
    openUrlInLayer(this.href);
    return false;
  });
} // registerCommonEventHander

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

/**
 * The Page Visibility API now allows us to more accurately detect when a page is hidden to the user.
 * The following code makes use of the API, falling back to the less reliable blur/focus method in incompatible browsers.
 * Current browser support:
 *
 *    Chrome 13+
 *    Internet Explorer 10+
 *    Firefox 10+
 *    Opera 12.10+ [read notes]
 *
 * */
(function() {
  var hidden = "hidden";

  // Standards:
  if (hidden in document)
    document.addEventListener("visibilitychange", onchange);
  else if ((hidden = "mozHidden") in document)
    document.addEventListener("mozvisibilitychange", onchange);
  else if ((hidden = "webkitHidden") in document)
    document.addEventListener("webkitvisibilitychange", onchange);
  else if ((hidden = "msHidden") in document)
    document.addEventListener("msvisibilitychange", onchange);
  // IE 9 and lower:
  else if ("onfocusin" in document)
    document.onfocusin = document.onfocusout = onchange;
  // All others:
  else
    window.onpageshow = window.onpagehide
    = window.onfocus = window.onblur = onchange;

  function onchange (evt) {
    var v = "visible", h = "hidden",
        evtMap = {
          focus:v, focusin:v, pageshow:v, blur:h, focusout:h, pagehide:h
        };

    evt = evt || window.event;
    if (evt.type in evtMap)
      document.body.className = evtMap[evt.type];
    else
      document.body.className = this[hidden] ? "hidden" : "visible";
  }

  // set the initial state (but only if browser supports the Page Visibility API)
  if( document[hidden] !== undefined )
    onchange({type: document[hidden] ? "blur" : "focus"});
})();

/*
jQuery-GetPath v0.2, by Francois-Guillaume Ribreau.

http://blog.geekfg.net/2010/06/trouver-le-selecteur-jquery-dun-element.html

Copyright (c)2010 Francois-Guillaume Ribreau. All rights reserved.
Released under the Creative Commons BY-SA Conditions.
  http://creativecommons.org/licenses/by-sa/3.0/

Usage:
var path = $('#foo').getPath();
*/
$(function(){(function($) {

  $.fn.getPath = function() {
    return $.getPath(this);
  };

  $.getPath = function(el) {
    if (!el) return false;
    if(el.jquery) el = el[0];

    if(el.nodeName && el.nodeName.toLowerCase() == '#document')
      return 'jQueryPath_document';// == window.document

    if(el.location)
      return 'jQueryPath_window';// == window
    
    var path = findBestSelector(el, true);

    while (  el.parentNode && el.parentNode.nodeName !== '#document'
        && (!(el.id && el.id.indexOf('.') == -1))) {
      el = el.parentNode;
      path = findBestSelector(el) + ' > ' + path;
    }

    return path;
  } // getPath

  /*
  * Helpers
  */

   //Helper (we use jQuery as less as possible)
  var next = (function() {
     var t = $('<div><p></p><p></p></div>')[0].childNodes[1];

     if (t.previousElementSibling && typeof(t.previousElementSibling) === 'object') {
       return function(el) {
       return el.previousElementSibling;
       };
     } else {
       return function(el) {
         return $(el).prev()[0]
       };
     }
  })();

  //Retreive the index of an element
  var getIndex = function(el) {
    if (el.previousElementSibling === null) {
       return 0;
    }

    var _el = el, i = 0, elT = el.nodeName;

    while (_el = next(_el)) {
     if (_el.nodeName == elT) {
         i++;
     }
    } // while
    return i;
  } // getIndex

  var findBestSelector = function(el, firstEl) {
    var first = firstEl || false,
       sel = '',
       index = false;

    if (el.id && el.id.indexOf('.') == -1) {
     //because $('#my.id') didn't work width jQuery
     sel += '#' + el.id;
    } else {
     sel += el.nodeName.toLowerCase();
    
     var indexEl = getIndex(el);
     if (indexEl || first) {
       sel += ':eq(' + indexEl + ')';
     }
    }
    return sel;
  } // findBestSelector
}(jQuery));});

$(document).ready(function() {
  registerCommonEventHander();

  var flashMessage = $('#flashMessage').text();
  if (false && flashMessage) {
    layer.msg($('#flashMessage').html(), 3, 1);
  }
});
