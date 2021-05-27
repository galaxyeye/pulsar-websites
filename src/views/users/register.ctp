<?php 
	$html->script(array('users/regist', 'users/registration_checker'), array('inline' => false));	
?>

<!--[if IE 6]><style type="text/css">@import <?php echo $html->css('users/register_ie6_fix') ?></style><![endif]-->

			<div id="register-frame">
				<div class="register-title"></div>
				<div class="register-page">
					<div class="register-broad">
						<div class="register-broad-img"></div>
						<div class="register-broad-txt">
						<?php
							if (isset($regErrors)) {
								echo $regErrors;
							}
							else {
								echo '注册柏拉图智能，赚金豆、玩游戏，百万大奖等你拿！';
							}
						 ?>
						</div>
					</div>
					<?php echo $form->create('User', array('action' => 'register')); ?>
					<div class="register-row colored-bg" id="reg-email">
						<div class="key"><span class="mark">*</span>邮箱地址：</div>
						<div class="tframe">
						<?php echo $form->input('email', array('label' => false, 'tabindex' => 1, 'div' => false, 
							'maxlength' => 30, 'type' => 'text', 'class' => 'textfield'));?>
						</div>
						<div class="description" id="reg-email-description1">请输入正确的邮箱，完成注册</div>
						<div class="description" id="reg-email-description2" style="display:none;"><img /><span></span></div>
					</div>
					<div class="register-row" id="reg-password">
						<div class="key"><span class="mark">*</span>设置密码：</div>
						<div class="tframe">
						<?php echo $form->input('password', array('label' => false, 'tabindex' => 2, 'div' => false, 
							'type' => 'password', 'maxlength' => 18, 'class' => 'textfield', 'default' => ''));?>
						</div>
						<div class="description" id="reg-password-description1">密码必须由6-18个字符组成</div>
						<div class="description" id="reg-password-description2" style="display:none;"><img /><span></span></div>
					</div>
					<div class="register-row colored-bg" id="reg-repeat">
						<div class="key"><span class="mark">*</span>重复密码：</div>
						<div class="tframe">
						<?php echo $form->input('confirm_password', array('label' => false, 'tabindex' => 3, 'div' => false, 
							'type' => 'password', 'maxlength' => 18, 'class' => 'textfield', 'default' => ''));?>
						</div>
						<div class="description" id="reg-repeat-description1">请再输一遍密码</div>
						<div class="description" id="reg-repeat-description2" style="display:none;"><img /><span></span></div>
					</div>
					<div class="register-row" id="reg-name" id="reg-name">
						<div class="key"><span class="mark">*</span>会员名：</div>
						<div class="tframe">
						<?php echo $form->input('name', array('label' => false, 'tabindex' => 4, 'div' => false, 
							'type' => 'text', 'maxlength' => 12, 'class' => 'textfield'));?>
						</div>
						<div class="description" id="reg-name-description1">会员名由3-12个字符组成</div>
						<div class="description" id="reg-name-description2" style="display:none;"><img /><span></span></div>
					</div>
					<div class="register-row colored-bg" id="reg-captcha">
						<div class="key"><span class="mark">*</span>验证码：</div>
						<div class="tframe">
						<?php echo $form->input('secure_code', array('label' => false, 'tabindex' => 5, 'div' => false, 
							'type' => 'text', 'maxlength' => 4, 'class' => 'captcha'));?>
						</div>
						<div class="description" id="reg-captcha-description" style="display:none;"><img /><span></span></div>
						<div class="secureImg"><label>&nbsp;</label><img id="verifyPic" src=<?php echo $html->url('/users/securimage/0.2312735271.png') ?> class="capimg" /></div>
						<div class="changeImg"><label>&nbsp;</label><a href="#" id="refresh">看不清楚</a></div><!-- 注意：不能把#改成javascript:;,否则IE6bug -->
					</div>
					<div class="register-row">
						<div class="auto">
							<div class="auto1"><?php echo $form->checkbox('agreement', array('checked' => true)); ?></div>
							<div class="auto2">我已认真阅读并同意接受</div>
							<div class="auto3">
								<?php echo $html->link('Logoloto 用户注册协议', '/pages/agreement', array('target' => '_blank')); ?>
							</div>
						</div>
					</div>
					<div class="register-button" id="reg-submit">
						<?php 
						  if (isset($this->data['User']['referrer'])) {
						    echo $form->hidden('referrer');
						  }
						  else {
						    echo $form->hidden('referrer', array('value' => 0));
						  }
						?>
						<button id="submit" class="button" tabindex="6" type="button"> </button>
						<span id="regist-loading" style="color:red; display:none;">正在注册中，请稍候...</span>
					</div>
					<?php echo $form->end(); ?>
<?php if (false): ?>
					<div class="register-notice">
						<span>友情提醒：</span>
						<div>1、广告是Logoloto非常重要的组成部分，在体验广告的过程中，必须按广告流程真实体验。<br/>2、严禁一个人使用多个帐号，任何代替他人注册、登录、使用帐号的行为均属违规行为。</div>
					</div>
<?php endif; ?>
				</div>
			</div>
