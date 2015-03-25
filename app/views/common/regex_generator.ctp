<div class='message related'>本工具试图从链接样例中学习出一个（简单的）正则表达式。</div>

<?php if (isset($regex)) : ?>
<div class="common related">
  <h3><?php __('学习结果');?></h3>
  <div id="generatedRegex"><?php echo $regex ?></div>
</div>
<?php endif; ?>

<div class="common form auto-validate">
<?php echo $this->Form->create('Common', array('action' => 'regexGenerator'));?>
  <fieldset>
     <legend><?php __('生成正则表达式'); ?></legend>
  <?php 
    $m = array(
        'urls' => "<p class='m hidden'>链接样例，每行一个。</p>",
    );
    
    global $regexSampleExample;
    echo $this->Form->input('urls', array(
    		'type' => 'textarea', 
    		'value' => $regexSampleExample, 
    		'div' => 'long input text required', 
    		'after' => $m['urls'],
    		'rows' => 15
    ));
  ?>
  </fieldset>
<?php echo $this->Form->end("确定"); ?>
</div>
