<?php 
$this->viewVars['css_for_layout'] = $html->css('admin', false);
$this->layout = 'blank';
?>

<div id='fit'>
	<div class='box'>
		<h1>登录</h1>

		<form id='loginForm' action="<?php echo $html->url('/admin/users/login'); ?>" method="post">
			<div class='email'>
				<label for='UserEmail'>邮箱地址</label>
				<?php echo $form->text('User.email', array('size' => 20)); ?>
				<span></span>
			</div>
			<div class='password'>
				<label for='UserPassword'>密码</label>
				<?php echo $form->password('User.password', array('size' => 18)); ?>
				<span></span>
			</div>
			<div>
				<?php echo $form->button('登录', array('type' => 'submit', 'class' => 'submit'));?>
			</div>
		</form>
	</div>
</div>
