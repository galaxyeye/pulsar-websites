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
        $(this).siblings().slideToggle("slow");
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
