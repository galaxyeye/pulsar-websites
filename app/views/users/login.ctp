<div id='fit'>
  <div class='message'>
	  <p>本次发布中，不包含高级数据挖掘功能，也不涉及知识工程或者知识图谱构建。</p>
	  <br />
	  <p>本次发布的目标，是能够支持普通技术人员无障碍地使用来自互联网的海量数据资源。</p>
    <p>通俗地讲，任何一个的普通程序员，通过我们的服务，可以建立自己的垂直搜索引擎，把目标站点的网页转变成结构化的SQL数据，
最后能够自动生成一个网站原型或者APP原型。</p>
	  <div>请阅读<a href="/files/release-0.9.0.txt" target="_blank">发布说明</a>。</div>
  </div>
  <br />
  <br />
  <hr />
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
        <?php echo $form->button('登录', array('type' => 'submit', 'class' => 'submit')); ?>
      </div>
    </form>
  </div>
</div>
