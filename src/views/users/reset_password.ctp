			<div id="retrie-frame">
				<div class="retrie-box">
					<span class="reset-info">请输入新密码以重置你的密码</span>
					<form id='retrievePasswordForm' action="<?php echo $html->url('/users/resetPassword'); ?>" method="post">
					<?php echo $form->hidden('User.hint');?>
					<table class="retrie-field" id="reset-pasword" border="0" cellspacing="0" cellpadding="0">
						<tr id="new-password">
							<th class="key">新密码</th>
							<td>
								<input class="textfield" type="password" name="data[User][password]" tabindex="2" maxlength="18" value="" />
								<div id="retrie-notice" style="display:none;"><img /><span></span></div>
							</td>
						</tr>
						<tr id="new-confirm">
							<th class="key">重复新密码</th>
							<td>
								<input class="textfield" name="data[User][confirm_password]" type="password" tabindex="3" maxlength="18" value="" />
								<div id="retrie-notice" style="display:none;"><img /><span></span></div>
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
