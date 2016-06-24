<?php 
	$this->layout = 'empty';
	if (!$t || $s != md5($user['User']['email'])) {
		echo '请从邮件中点击访问此页面';

		exit();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>杜莎夫人蜡像馆代金券免费大赠送</title>
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

<style type="text/css">
#mandam-tussands td, p { font:Arial, Verdana, "Lucida Grande", Helvetica, sans-serif; font-size:12px; color:#343434; }
#mandam-tussands td ol { line-height:28px; }
#advertisement { margin-left:auto; margin-right:auto; width:750px; }
#advertisement img { display:inline; margin:0; padding:0; }
</style>
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
			<h2>你获得了杜莎夫人蜡像馆50元代金券一张 - 乐够乐透联合杜莎夫人蜡像馆倾情回馈</h2> 
		</div> 
		<div class="mailinfo"> 
			<div class="item item-from"> 
				<label class="lb">发件人：</label> 
				<div class="cont"> 
					<script>document.write(format('[乐够乐透客服 &lt;service@logoloto.com&gt;]'));</script> 
				</div> 
			</div> 
			<div class="item item-time"> 
				<label class="lb">时　间：</label> 
				<div class="cont">
					<?php echo date('Y-m-d H:m:s', $t) ?></div> 
			</div> 
			<div class="item item-to">	<!--抄送：item-cc 密送：item-bc--> 
				<label class="lb">收件人：</label> 
				<div class="cont"> 
					<script>document.write(format('[<?php echo $user['User']['email'] ?>]'));</script> 
				</div>

			</div>
		</div> 
	</div> 
	<div class="ln-thin ln-c-mid"></div> 

	<!--邮件正文 根据邮件内容调整iframe高度--> 
	<div class="gRead-content" id="dvContent">
	
	
	

<div id='mandam-tussands'>
  <div class='conent'>
    <table cellpadding="0" cellspacing="0" width="100%" border="0">
      <tr>
        <td align="center" valign="top"><table cellpadding="0" cellspacing="0" width="750" border="0">
            <tbody align="left">
              <tr>
                <td colspan="2" style="padding-bottom:14px; font-size:12px; font-weight:bold"><?php echo $user['User']['name'] ?>，你好： </td>
              </tr>
              <tr>
                <td colspan="2" style="text-indent:2em; line-height:18px; font-size:12px; color:#343434;">欢迎加入乐够乐透网！想让你的生活更加有趣吗？快来加入我们新会员大回馈的活动吧！</td>
              </tr>
              <tr>
                <td colspan="2" style="text-indent:2em; line-height:18px; font-size:12px; color:#343434;"><p><a href="www.logoloto.com" style="color:#FF0000; text-decoration:none">乐够乐透网&nbsp;</a>和<span  style="color:#FF0000;">&nbsp;杜莎夫人蜡像馆&nbsp;</span>真情合作，开展免费赠送杜莎夫人蜡像馆代金券活动。
                	活动期间，凡成功注册并激活乐够乐透网的会员，都将免费获得杜莎夫人蜡像馆50元代金券一张！ </p></td>
              </tr>
              <tr>
                <td colspan="2" style="font-size:12px;">使用方法：</td>
              </tr>
              <tr>
                <td colspan="2"><ol>
                    <li style="font-size:12px; color:#343434;"> 请将本邮件中的代金券打印出来，并携带本人身份证（身份证上的名字必须与代金券上的名字一致）直接至上海杜莎夫人蜡像馆售票处购买门票。</li>
                    <li style="font-size:12px; color:#343434;"> 每张代金券可购买一张门票，每张门票可抵扣50元！</li>
                  </ol></td>
              </tr>
              <tr>
                <td colspan="2" style="text-align:center; padding:10px;">
                	<a style="font-size:16px; font-weight:bolder; color:#F00;" href="http://www.logoloto.com/lmails/printMandomTussand/<?php echo $user['User']['id'] ?>?t=<?php echo time() ?>&s=<?php echo md5($user['User']['email']) ?>">打印代金券</a></td></tr>
            </tbody>
          </table></td>
      </tr>
      <tr>
        <td id="advertisement"><table cellpadding="0" cellspacing="0" border="0" width="750" align="center">
            <tr>
              <td colspan="2"><img src="http://www.logoloto.com/img/customers/mandam_tussands/md_01.jpg" style="height:361px; width:750px; border:0; margin:0; padding:0;"/></td>
            </tr>
            <tr>
              <td  ><img src="http://www.logoloto.com/img/customers/mandam_tussands/ts_01.jpg"  style="height:261px; width:750px; border:0; margin:0; padding:0;"/></td>
            </tr>
            <tr align="left" >
              <td><table cellpadding="0" cellspacing="0" width="750" border="0">
                  <tr>
                    <td rowspan="2"><img src="http://www.logoloto.com/img/customers/mandam_tussands/ts_02.jpg" style="height:38px; width:605px; border:0; margin:0; padding:0;" /></td>
                    <td bgcolor="#551c87" width="71" height="19"  style="color:#fff; padding-left:6px; font-size:12px; line-height:15px"><?php echo $user['User']['name'] ?></td>
                    <td width="74"><img src="http://www.logoloto.com/img/customers/mandam_tussands/ts_04.jpg"  style="height:19px; width:74px; border:0; margin:0; padding:0;"/></td>
                  </tr>
                  <tr>
                    <td  bgcolor="#551c87" width="71" height="19"  style="color:#fff; padding-left:6px; font-size:12px; line-height:15px">MTL<?php echo $user['User']['id'] ?></td>
                    <td width="74"><img src="http://www.logoloto.com/img/customers/mandam_tussands/ts_06.jpg" style="width:74px;height:19px" /></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td><img src="http://www.logoloto.com/img/customers/mandam_tussands/ts_08.jpg" style="height:62px; width:750px; border:0; margin:0; padding:0;" /></td>
            </tr>
            <tr>
              <td colspan="2"><img src="http://www.logoloto.com/img/customers/mandam_tussands/md_08.jpg" style=" height:361px; width:750px; border:0; margin:0; padding:0;"/></td>
            </tr>
      <tr>
      	<td colspan="2" style="text-align:center; padding:10px;">
        	<a style="font-size:16px; font-weight:bolder; color:#F00;" href="http://www.logoloto.com/lmails/printMandomTussand/<?php echo $user['User']['id'] ?>?t=<?php echo time() ?>&s=<?php echo md5($user['User']['email']) ?>">打印代金券</a></td></tr>
            
            <tr>
              <td colspan="2" style="color:#777777; padding-top:25px; line-height:18px; font-size:12px; color:#343434;">此信是由乐够乐透网系统发出，系统不接收回信，请勿直接回复。<br />
                乐够乐透网，免费让你乐够乐透！ http://www.logoloto.com/ <br /></td>
            </tr>
          </table></td>
      </tr>
  	</table>
  </div>
</div>

	
	
	
	
	
	
	
	
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
