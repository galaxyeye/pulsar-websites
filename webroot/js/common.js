const SCHEDULE_COOKIE_NAME = "warps.ui.schedule";
const SCHEDULE_PERIOD = 15; // seconds

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

/**
 * Helper function for jquery-ui
 * */
function checkLength(o, n, min, max) {
    if (o.val().length > max || o.val().length < min) {
        o.addClass("ui-state-error");
        updateTips("Length of " + n + " must be between " + min + " and " + max + ".");
        return false;
    } else {
        return true;
    }
} // check length

/**
 * Helper function for jquery-ui
 * */
function checkRegexp(o, regexp, n) {
    if (!(regexp.test(o.val()))) {
        o.addClass("ui-state-error");
        updateTips(n);
        return false;
    } else {
        return true;
    }
} // check regex

/**
 * Helper function for jquery-ui
 * */
function updateTips(t) {
    tips.text(t).addClass("ui-state-highlight");

    setTimeout(function () {
        tips.removeClass("ui-state-highlight", 1500);
    }, 500);
} // update tips

/**
 * Check if a url is valid
 * */
function isValidURL(url) {
    var reg = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

    if (reg.test(url)) {
        return true;
    }
    else {
        return false;
    }
}

/**
 * Base64
 * */
/**
 *
 *  Base64 encode / decode
 *  http://www.webtoolkit.info/
 *
 **/
var Base64 = {

// private property
    _keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

// public method for encoding
    encode : function (input) {
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        input = Base64._utf8_encode(input);

        while (i < input.length) {

            chr1 = input.charCodeAt(i++);
            chr2 = input.charCodeAt(i++);
            chr3 = input.charCodeAt(i++);

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }

            output = output +
                this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

        }

        return output;
    },

// public method for decoding
    decode : function (input) {
        var output = "";
        var chr1, chr2, chr3;
        var enc1, enc2, enc3, enc4;
        var i = 0;

        input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

        while (i < input.length) {

            enc1 = this._keyStr.indexOf(input.charAt(i++));
            enc2 = this._keyStr.indexOf(input.charAt(i++));
            enc3 = this._keyStr.indexOf(input.charAt(i++));
            enc4 = this._keyStr.indexOf(input.charAt(i++));

            chr1 = (enc1 << 2) | (enc2 >> 4);
            chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
            chr3 = ((enc3 & 3) << 6) | enc4;

            output = output + String.fromCharCode(chr1);

            if (enc3 != 64) {
                output = output + String.fromCharCode(chr2);
            }
            if (enc4 != 64) {
                output = output + String.fromCharCode(chr3);
            }

        }

        output = Base64._utf8_decode(output);

        return output;

    },

// private method for UTF-8 encoding
    _utf8_encode : function (string) {
        string = string.replace(/\r\n/g,"\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

// private method for UTF-8 decoding
    _utf8_decode : function (utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while ( i < utftext.length ) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i+1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i+1);
                c3 = utftext.charCodeAt(i+2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }
};

/**
 * Increase a variable exponentially, eg : 1, 2, 4, 8, 16, 32, 64, ...
 * */
function exponentialIncrease(base, ceil) {
    base *= 2;
    if (base > ceil) base = ceil;

    return base;
}

/**
 * Descrease a variable exponentially, eg : 64, 32, 16, 8, 4, 2, 1, 0
 * */
function exponentialDecrease(base, floor) {
    base /= 2;
    if (base < floor) base = floor;

    return base;
}

/**
 * TODO : support prefix : admin_, manage_, ajax_, etc
 * */
function getCakePHPUrl() {
    var webroot = "/";
    if (globalPageData) {
        webroot = globalPageData.webroot;
    }
    
    var len = arguments.length;
    if (len == 0) {
        return webroot;
    }

    var controller = arguments[0];
    var action = (len > 1) ? arguments[1] : '';

    var url = webroot + controller;
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

/**
 * Register event handlers for the whole site
 * */
function registerCommonEventHandler() {
    // Form Auto Validation
    $('div.form.auto-validate').submit(function () {
        var notEmpty = true;
        $('div.input.required input').not(':hidden').each(function (i) {
            if (notEmpty && this.value == '') {
                notEmpty = false;
                layer.tips("This field must not be empty", this);
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
        .on('mouseenter', function () {
            // $(".xubox_tips+.xubox_close").trigger("click");
            var tip = $(this).parent().find('.m.hidden').html();
            if (tip) {
                layer.tips(tip, this);
            }
        })
        .on('mouseout', function () {
            $(".layui-layer-rim").hide();
        })
        .on('blur', function () {
            $(".layui-layer-rim").hide();
        });

    // Collaspe
    $('.view h2, .view h3, .view h4, ' +
        '.index h2, .index h3, .index h4, ' +
        '.related h2, .related h3, .related h4').click(function () {
        // $(this).siblings().slideToggle("slow");
    });

    // add/view/edit in a new layer
    $("a[target='layer']").on("click", function (event) {
        openUrlInLayer(this.href, {title: 'brief', 'move': '.layui-layer-title'});
        return false;
    });

    // Active schedule routine
    setInterval(function () {
        var now = Date.now(); // unix timestamp in milliseconds
        var lastScheduleTime = getcookie(SCHEDULE_COOKIE_NAME);
        if (now - lastScheduleTime > SCHEDULE_PERIOD * 1000) {
            setcookie(SCHEDULE_COOKIE_NAME, now, 60 * 60 * 1, "/");

            $.get(getCakePHPUrl("nutch_jobs", "schedule"));
        }
    }, SCHEDULE_PERIOD * 1000);
} // registerCommonEventHandler

function openMessagePanel() {
    var tabs = [{
        title: 'Nutch',
        content: ""
    }, {
        title: 'Scent',
        content: ""
    }];

    // openInfoLayer(tabs);
}

function openInfoLayer(tab) {
    layer.tab({
        area: ['100%', "100px"],
        offset: 'rb',
        shade: 0,
        move: false,
        tab: tab
    });
}

/**
 * @param url {string}
 * @param params {object}
 * */
function openUrlInLayer(url, params) {
    $.get(url, {}, function(html) {
        layer.open({
            type: 1,
            title: params.title ? params.title : false,
            skin: 'layui-layer-rim', //加上边框
            move: params.move ? params.move : ".movable",
            moveType: 1,
            area: ['800px', '500px'],
            maxmin: true,
            shift: 'left', //从左动画弹出
            scrollbar: true,
            content: html,
            // zIndex : 19891010,
            success: function (layero, index) {
                // Collaspe
                $('.view h2, .view h3, .view h4, ' +
                    '.index h2, .index h3, .index h4, ' +
                    '.related h2, .related h3, .related h4').click(function () {
                    $(this).siblings().slideToggle("slow");
                });

//      layero.find('.view').resizable().css('max-height', 0.45 * $(window).height());
            }
        });
    });
}

/**
 * display a object by property-name/property-value pairs
 * */
function object2html(obj) {
    if (!obj) return "";

    if (typeof(obj) === 'string') {
        return obj;
    }

    if (typeof(obj) !== 'object') {
        return '';
    }

    var html = '<ul>';

    $.each(obj, function (name, value) {
        html += '<li>';

        if (typeof(value) === 'string') {
            html += name + " : " + value;
        } else if (typeof(value) === 'object') {
            html += object2html(value);
        }

        html += '</li>';
    });
    html += '</ul>';

    return html;
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
(function () {
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

    function onchange(evt) {
        var v = "visible", h = "hidden",
            evtMap = {
                focus: v, focusin: v, pageshow: v, blur: h, focusout: h, pagehide: h
            };

        evt = evt || window.event;
        if (evt.type in evtMap)
            document.body.className = evtMap[evt.type];
        else
            document.body.className = this[hidden] ? "hidden" : "visible";
    }

    // set the initial state (but only if browser supports the Page Visibility API)
    if (document[hidden] !== undefined)
        onchange({type: document[hidden] ? "blur" : "focus"});
})();

$(document).ready(function () {
    registerCommonEventHandler();
    openMessagePanel();

    var flashMessage = $('#flashMessage').text();
    if (false && flashMessage) {
        layer.msg($('#flashMessage').html(), 3, 1);
    }
});
