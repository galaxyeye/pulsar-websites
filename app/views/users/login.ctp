<div id='fit'>
  <div>
  <p>本次发布中，不包含高级数据挖掘功能，也不涉及知识工程或者知识图谱构建。</p>
  <br />
  <p>本次发布的目标，是能够支持任何一家公司的技术小白，在我们这边注册后，可以通过网页界面进行操作，抓到第三方网站中的网页，
最后把网页反向转换成SQL数据库，甚至直接生成自己的网站原型。</p>
  </div>
  <div>请阅读<a href="/s/release-0.9.0.txt">发布说明</a>。</div>
  <div class='box'>
    <h1>登录</h1>

    <form id='loginForm' action="<?php echo $html->url('/users/login'); ?>" method="post">
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
