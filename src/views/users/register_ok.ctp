			<div id="success-frame1">
				<div class="success-info">
					&nbsp;&nbsp;&nbsp;&nbsp;<span>注册成功，请立刻开通帐户</span><br/>
					<span class="red"><?php echo $email;?></span> 将收到一封注册确认邮件，请查收。<br/>
					点击邮件中的确认链接即可开通你的帐户。
				</div>
			</div>
			<div id="success-frame2">
				<?php if ($eurl != ''):?>
				<a href="http://<?php echo $eurl;?>" class="success-button" target="_blank"></a>
				<?php endif;?>
				<div class="go-ahead">
				  <?php echo $html->link('返回首页', '/') ?>，或者
				  <?php echo $html->link('我已激活，进入个人空间', '/profiles/basic') ?>
				</div>
				<div class="success-tip">
					<div class="success-tip-content">
						<span>没有收到激活邮件？</span>
						<ul>
							<li>检查注册邮箱是否正确：<?php echo $email;?></li>
							<li>在垃圾邮件夹里找找</li>
						</ul>
					</div>
					
					<div class="clear"></div>
				</div>
			</div>
			<div id="success-frame3">
			</div>
