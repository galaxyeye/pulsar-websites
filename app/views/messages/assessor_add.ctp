<div class="actions">
  <ul>
    <li><?php echo $this->Html->link('短信清单', array('action' => 'index')); ?> </li>
  </ul>
</div>

<div class="info">
  <h2>管理员 - 发短信</h2>
</div><!--info-->

<?php echo $this->Session->flash() ?>

<div class="frame2 clearfix">
	<div class="messages form column1 clearfix">
	<?php echo $this->Form->create('Message');?>
		<fieldset>
		  <legend>T<span class="smaller">o</span>:合作方</legend>
			<?php 
				echo $this->Form->input('contact', array('label' => '姓名', 'id' => 'MessageName', 'options' => $allPartners, 'multiple' => 'multiple'));
				echo $this->Form->input('content', array('label' => '短信内容', 'id' => 'MessageContent1', 'div' => 'content input textarea required', 'cols' => 30, 'rows' => 3));
				echo $this->Form->hidden('to', array('value' => 'partner'));
			?>
    <div>还可以输入：<span id="wordCounter1">70</span>个字</div>
		</fieldset>
		<div class="buttons">
      <a class="button submit" href="javascript:;">发送</a>
    </div>
  <?php echo $this->Form->end(); ?>
	</div>

  <div class="messages form clearfix column2">
		<?php echo $this->Form->create('Message');?>
		  <fieldset class='other'>
		    <legend>T<span class="smaller">o</span>:其他联系人</legend>
		    <div id="recipientPrototype" class='hidden'>
		      <ul class='clearfix'>
		        <li class='recipient item'>
	            <span class='recipient'></span>
	            <input type='hidden' class='contact' />
	            <a href="javascript:;" class='close'>x</a>
	          </li>
		      </ul>
		    </div>
		    <div id="recipientList" class="recipients required items hidden">
		      <label>发送给：</label>
		      <ul class='clearfix'></ul>
		    </div>

			  <div class="fieldset3 clearfix">
				  <?php 
				    echo $this->Form->input('contact_', array('label' => '姓名', 'id' => 'MessageRecipient', 'div' => 'input text required col1'));
		        echo $this->Form->input('mobile', array('label' => '手机号', 'div' => 'input text required col2'));
            echo $this->Form->hidden('to', array('value' => 'other'));
		      ?>
		      <div title="加入" class="col3"><a tabindex="10005" id="addRecipient" class="button" href="javascript:;">+</a></div>
	      </div>
			  <?php echo $this->Form->input('content', array('label' => '短信内容','id' => 'MessageContent2', 'div' => 'content input textarea required', 'cols' => 30, 'rows' => 3)); ?>
        <div>还可以输入：<span id="wordCounter2">70</span>个字</div>			  
		  </fieldset>
	    <div class="buttons">
	      <a class="button submit" href="javascript:;">发送</a>
	    </div>
    <?php echo $this->Form->end(); ?>
  </div>
</div>