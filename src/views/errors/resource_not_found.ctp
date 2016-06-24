<style>
	p { margin:40px 0 40px 120px;}
</style>

<p>
<?php echo $html->image('common/error404.gif', array('width' => '694px', 'height' => '295px')); ?>

<script language='javascript' type='text/javascript'>
    var secs =5; //倒计时的秒数
    var URL='<?php echo $this->webroot;?>';
    for(var i=secs;i>=0;i--) {
         window.setTimeout('doUpdate(' + i + ')', (secs-i) * 1000);       
	}
   
    function doUpdate(num) {
    	if(num == 0) { window.location=URL;  }
    }
</script>
</p>
