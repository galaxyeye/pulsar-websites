<?php 
	$html->script('users/registration_checker', array('inline' => false));	
?>

			<div id="retrie-frame">
				<div class="retrie-box">
					<span class="retrie-info">
					<?php 
						if(isset($authMessage)) {
							echo '<span style="color:red;">'.$authMessage.'</span>';
						} else {
							echo '请输入你的登录帐号, 系统会将密码修改邮件发到你的邮箱。';
						}	
					 ?>
					</span>
					<form id='retrievePasswordForm' action="<?php echo $html->url('/users/retrievePassword'); ?>" method="post">
					<table class="retrie-field" border="0" cellspacing="0" cellpadding="0">
						<tr id="email">
							<th class="key">帐&nbsp;&nbsp;&nbsp;号</th>
							<td>
								<input class="textfield" type="text" name="data[User][email]" tabindex="2" maxlength="30" />
								<div id="retrie-notice" style="display:none;"><img /><span></span></div>
							</td>
						</tr>
						<tr id="captcha">
							<th class="key">验证码</th>
							<td>
								<input class="captcha" name="data[User][secure_code]" type="text" tabindex="3" maxlength="4" />
        						<div class="secureImg"><label>&nbsp;</label><img id="verifyPic" src=<?php echo $html->url('/users/securimage/0.2312735271.png') ?> class="capimg" /></div>
        						<div class="changeImg"><label>&nbsp;</label><a href="#" id="refresh">看不清楚</a></div><!-- 注意：不能把#改成javascript:;,否则IE6bug -->
							</td>
						</tr>
						<tr class="retrie-button">
							<th>&nbsp;</th>
							<td>
					 			<?php echo $form->button('', array('type' => 'submit', 'class' => 'button', 'tabindex' => 4));?>
							</td>
						</tr>
					</table>
					</form>
				</div>
			</div>
