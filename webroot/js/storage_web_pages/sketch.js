$(document).ready(function () {

    // for draggable
    var revertPosition = true;
    var alwaysShowShapeInformation = false;

    $(".shape.trimed").each(function () {
        var zIndex = $(this).css('z-index');
        $(this).css('z-index', zIndex + 1000);
    });

    $(".shape.trimed").mouseover(function () {
        // $(this).find(".detail").attr("style", "width:1000px").show();
        if (!alwaysShowShapeInformation) {
            $(this).find(".detail").show();
        }
    }).mouseout(function () {
        if (!alwaysShowShapeInformation) {
            $(this).find(".detail").hide();
        }
    });

    $('.hide-trimed-shapes').click(function() {
        $(".shape.trimed").hide();
    });

    $('.show-trimed-shapes').click(function() {
        $(".shape.trimed").show();
    });

    $('.hide-non-trimed-shapes').click(function() {
        $(".shape:not(.trimed)").hide();
    });

    $('.show-non-trimed-shapes').click(function() {
        $(".shape:not(.trimed)").show();
    });

    $('.show-shape-information').click(function() {
        alwaysShowShapeInformation = true;
        $(".shape .detail").show();
    });

    $('.hide-shape-information').click(function() {
        alwaysShowShapeInformation = false;
        $(".shape .detail").hide();
    });

    // $('.trigger-shape-information').click(function() {
    //     alwaysShowShapeInformation = false;
    //     $(".shape .detail").hide();
    // });

    $('.disable-revert-position').click(function() {
        revertPosition = false;

        enableDraggable();
    });

    $('.get-shape-selectors').click(function() {
        $(".message").html("");
        $(".message").append("<ol class='shape-information'></ol>");
        $(".shape.trimed").each(function (i, item) {
            $(".message ol").append("<li>" + item.textContent + "</li>");
        });

        showSystemPanel();
    });

    enableDraggable();

    function enableDraggable() {
        $('div.shapes *').draggable({
            zIndex: $('.xubox_layer').css('z-index') + 1,
            grid: [50, 20],
            refreshPositions: true,
            revert: revertPosition,
            start: function (event, ui) {
                if (!alwaysShowShapeInformation) {
                    $(this).find(".detail").show();
                }
            },
            drag: function (event, ui) {
            },
            stop: function (event, ui) {
                if (!alwaysShowShapeInformation) {
                    $(this).find(".detail").hide();
                }
            }
        });
    }

    function showSystemPanel() {
        $("#systemPanel").show();
        $.layer({
            type : 1,
            // title : '弹性分布式网页集概要',
            title : "Message",
            border : false,
            shade : 0,
            move : ".xubox_title",
            moveType : 1,
            moveOut : true,
            area: ['751px', 'auto'],
            maxmin: true,
            offset : ['', ''],
            shift: 'left', //从左动画弹出
            page : {dom : '#systemPanel'},
            // zIndex : 19891010,
            success: function(layero) {
            }
        });
    }
});
