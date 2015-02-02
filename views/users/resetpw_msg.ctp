			<div id="retrie-frame">
				<div class="retrie-box">
					<span class="retrie-info">
					<?php if ($resetStatus == 'MAIL_SENT_OUT') : ?>
					请到你的 <?php echo $user['User']['email'] ?> 邮箱中查阅来自乐够乐透网的邮件, 按照邮件的提示重新设置你的密码。
					<?php elseif ($resetStatus == 'INVALID_LINK'): ?>
					抱歉，该请求已经失效，请重新请求更改密码。
					<?php elseif ($resetStatus == 'PASSWORD_CONFLICT'): ?>
					抱歉，你填入的新密码与重复新密码不符，密码设置失败！为了帐号安全，你需要重新点击忘记密码，获取新的密码修改邮件。
					<?php elseif ($resetStatus == 'RESET_PASSWORD_OK'): ?>
					修改密码成功！
					<?php endif; ?>
					</span>
				</div>
			</div>