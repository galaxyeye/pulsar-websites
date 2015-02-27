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
<title><?php echo $user['User']['email'] ?> - <?php echo date('Y-m-d H:m:s', $t) ?> - 乐够乐透网</title>
<script LANGUAGE="JavaScript"> 
<!--
	window.print();
//--> 
</script>
</head>

<body>
<div style="margin:auto">
  <table cellpadding="0" cellspacing="0" border="0" width="640" align="center">
    <tr>
      <td colspan="2"><img src="http://www.logoloto.com/img/customers/mandam_tussands/md_01.jpg" style="height:307px; width:640px; border:0; margin:0; padding:0;"/></td>
    </tr>
    <tr>
      <td  ><img src="http://www.logoloto.com/img/customers/mandam_tussands/ts_01.jpg"  style="height:261px; width:640px; border:0; margin:0; padding:0;"/></td>
    </tr>
    <tr align="left" >
      <td><table cellpadding="0" cellspacing="0" width="640" border="0">
          <tr>
            <td rowspan="2"><img src="http://www.logoloto.com/img/customers/mandam_tussands/ts_02.jpg" style="height:33px; width:514px; border:0; margin:0; padding:0;" /></td>
            <td bgcolor="#551c87" width="71" height="16"  style="color:#fff; padding-left:6px; font-size:12px;"><?php echo $user['User']['name'] ?></td>
            <td width="74"><img src="http://www.logoloto.com/img/customers/mandam_tussands/ts_04.jpg"  style="height:16px; width:68px; border:0; margin:0; padding:0;"/></td>
          </tr>
          <tr>
            <td  bgcolor="#551c87" width="71" height="16"  style="color:#fff; padding-left:6px; font-size:12px;"">MTL<?php echo $user['User']['id'] ?></td>
            <td width="74"><img src="http://www.logoloto.com/img/customers/mandam_tussands/ts_06.jpg" style="width:68px;height:17px" /></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td><img src="http://www.logoloto.com/img/customers/mandam_tussands/ts_08.jpg" style="height:62px; width:640px; border:0; margin:0; padding:0;" /></td>
    </tr>
    <tr>
      <td colspan="2"><img src="http://www.logoloto.com/img/customers/mandam_tussands/md_08.jpg" style=" height:307px; width:640px; border:0; margin:0; padding:0;"/></td>
    </tr>
  </table>
</div>
</body>
</html>
