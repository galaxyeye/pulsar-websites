$(document).ready(function() {

  $.layer({
    type : 1,
    // title : '弹性分布式网页集概要',
    title : "操作界面",
    border : false,
    shade : [0],
    move : ".xubox_title",
    moveType : 1,
    moveOut : true,
    area: ['751px', 'auto'],
    offset : ['', ''],
    shift: 'left', //从左动画弹出
    page : {dom : '#systemPanel'},
    // zIndex : 19891010,
    success: function(layero) {
      // layero.find('.m').show();
      // layero.find('.actions').hide();
      // alert(dump(layero));
      // registerCommonEventHander();
    }
  });

});
