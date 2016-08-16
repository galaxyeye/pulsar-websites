$(document).ready(function () {

    // for draggable
    var revertPosition = true;
    var alwaysShowShapeInformation = false;

    $(".shape.aligned").each(function () {
        var zIndex = $(this).css('z-index');
        $(this).css('z-index', zIndex + 1000);
    });

    $(".shape.aligned").mouseover(function () {
        // $(this).find(".detail").attr("style", "width:1000px").show();
        if (!alwaysShowShapeInformation) {
            $(this).find(".detail").show();
        }
    }).mouseout(function () {
        if (!alwaysShowShapeInformation) {
            $(this).find(".detail").hide();
        }
    });

    $('.hide-aligned-shapes').click(function() {
        $(".shape.aligned").hide();
    });

    $('.show-aligned-shapes').click(function() {
        $(".shape.aligned").show();
    });

    $('.hide-non-aligned-shapes').click(function() {
        $(".shape:not(.aligned)").hide();
    });

    $('.show-non-aligned-shapes').click(function() {
        $(".shape:not(.aligned)").show();
    });

    $('.show-shape-information').click(function() {
        alwaysShowShapeInformation = true;
        $(".shape .detail").show();
    });

    $('.hide-shape-information').click(function() {
        alwaysShowShapeInformation = false;
        $(".shape .detail").hide();
    });

    $('.show-all-shape-information').click(function() {
        $(".message").html("");
        $(".message").append("<ol class='shape-information'></ol>");
        $(".shape.aligned").each(function (i, item) {
            $(".message ol").append("<li>" + item.textContent + "</li>");
        });

        showSystemPanel();
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
        // $(".message").append("<ol class='shape-information'></ol>");
        // $(".shape.aligned").each(function (i, item) {
        //     // $(".message ol").append("<li>" + $(item).find(".detail > div:first").text() + "</li>");
        //     $(".message ol").append("<li>" + $(item).find(".detail > div:first").text() + "</li>");
        // });

        var json = JSON.stringify(alignedRectangles);
        json = json.replace(/\[{/g, "[\n\t{");
        json = json.replace(/},{/g, "},\n\t{");
        json = json.replace(/}\]/g, "}\n]");
        $(".message").append("<pre>" + json + "</pre>");

        showSystemPanel();
    });

    createGrid(100);

    enableDraggable();

    function createGrid(size) {
        var ratioW = Math.floor($(document).width() / size),
            ratioH = Math.floor($(document).height() / size);

        var parent = $('<div />', {
            class: 'grid',
            width: ratioW  * size,
            height: ratioH  * size
        }).addClass('grid').appendTo('.canvas');

        for (var i = 0; i < ratioH; i++) {
            for(var p = 0; p < ratioW; p++) {
                $('<div />', {
                    width: size - 1,
                    height: size - 1
                }).appendTo(parent);
            }
        }
    }

    function enableDraggable() {
        $('div.shapes .shape').draggable({
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
        layer.open({
            type : 1,
            title : "Message",
            maxmin: true,
            shift: 'left', //从左动画弹出
            content: $("#autoExtractResult")
        });
    }
});
