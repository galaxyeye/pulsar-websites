<!---------------------------------------------------------->
<!-- 第一步：种子链接 -->
<!---------------------------------------------------------->
<div class="crawls analysis step-1 form auto-validate">
  <?php echo $this->Form->create('Crawl', array('action' => 'analysis')); ?>
  <fieldset>
    <legend><?php __('输入种子链接开始分析'); ?></legend>
  <?php 
    $m = [
        'url' => '<p class="m hidden">输入种子链接开始分析，推荐使用商品列表页</p>'
    ];

    echo $this->Form->hidden('stepNo', ['value' => 1]);
    echo $this->Form->input('url', ['label' => '种子链接', 'div' => 'input text long', 'after' => $m['url']]);
  ?>
  </fieldset>
  <?php echo $this->Form->end(__('Submit', true)); ?>
  <div class='analysis result'></div>
</div>
