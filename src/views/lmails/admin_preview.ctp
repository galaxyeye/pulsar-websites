<?php 
	$this->layout = 'empty';

	App::import('Sanitize');
?>

<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $lmail['Lmail']['subject'] ?></title>
<?php echo $html->css('lmails/admin_preview') ?>
<script LANGUAGE="JavaScript"> 
<!--
	function fPrint(){
		document.getElementById("t1").style.display = "none";
		document.getElementById("t2").style.display = "none";
		window.print();
		document.getElementById("t1").style.display = "";
		document.getElementById("t2").style.display = "";
	}

	function format(s){	
		return s.substr(1, s.length-2);
	}
//--> 
</script> 
</head> 
 
 <body>
<!-- 读信 Start --> 
<div class="gRead" style=""> 
 
	<!--顶部工具栏--> 
	<div class="g-toolbar" id="t1"> 
		<div class="btngrp" > 
			<div class="btn btn-dft" onmouseover="this.className='btn btn-dft btn-dft-hover'" onmouseout="this.className='btn btn-dft'" onmousedown="this.className='btn btn-dft btn-dft-active'" onmouseup="this.className='btn btn-dft btn-dft-hover'"  onclick="fPrint()"><span>打印该邮件</span></div>	
		</div> 
		<div class="btngrp"> 
			<div class="btn btn-dft" onmouseover="this.className='btn btn-dft btn-dft-hover'" onmouseout="this.className='btn btn-dft'" onmousedown="this.className='btn btn-dft btn-dft-active'" onmouseup="this.className='btn btn-dft btn-dft-hover'" onclick="window.close();" ><span>关闭该页面</span></div> 
		</div> 
	</div> 
	<div class="ln-thin ln-c-mid"></div> 
 
	<!--邮件信息--> 
	<div class="gRead-info bg-cont"> 
		<div class="mailtit"> 
			<h2><?php echo $lmail['Lmail']['subject'] ?></h2> 
		</div> 
		<div class="mailinfo"> 
			<div class="item item-from"> 
				<label class="lb">发件人：</label> 
				<div class="cont"> 
					<script>document.write(format('[<?php echo Sanitize::html($lmail['Lmail']['from']) ?>]'));</script> 
				</div> 
			</div> 
			<div class="item item-time"> 
				<label class="lb">时　间：</label> 
				<div class="cont"> 
					<?php echo $lmail['Lmail']['created'] ?>
				</div> 
			</div> 
			<div class="item item-to">	<!--抄送：item-cc 密送：item-bc--> 
				<label class="lb">收件人：</label> 
				<div class="cont"> 
					<script>document.write(format('[<?php echo Sanitize::html($lmail['Lmail']['to']) ?>]'));</script> 
				</div>
			</div>
		</div> 
	</div> 
	<div class="ln-thin ln-c-mid"></div> 

	<!--邮件正文 根据邮件内容调整iframe高度--> 
	<div class="gRead-content" id="dvContent"> 
		<?php echo $lmail['Lmail']['content_html'] ?>
	</div> 

	<!--底部工具栏--> 
	<div class="ln-thin ln-c-mid"></div> 
	<div class="g-toolbar" id="t2"> 
		<div class="btngrp" > 
			<div class="btn btn-dft" onmouseover="this.className='btn btn-dft btn-dft-hover'" onmouseout="this.className='btn btn-dft'" onmousedown="this.className='btn btn-dft btn-dft-active'" onmouseup="this.className='btn btn-dft btn-dft-hover'"  onclick="fPrint()"><span>打印该邮件</span></div>	
		</div> 
		<div class="btngrp"> 
			<div class="btn btn-dft" onmouseover="this.className='btn btn-dft btn-dft-hover'" onmouseout="this.className='btn btn-dft'" onmousedown="this.className='btn btn-dft btn-dft-active'" onmouseup="this.className='btn btn-dft btn-dft-hover'" onclick="window.close();" ><span>关闭该页面</span></div> 
		</div> 
	</div> 
</div> 
 
 
 
</body> 
</html>