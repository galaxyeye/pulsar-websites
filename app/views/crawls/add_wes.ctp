<?php echo $this->element('crawls/subnav') ?>

<div class='message start-up-tip hidden'>
说明：
<br />I.    创建一个"网络实体集(Web Entity Set, WES)"，系统将下载网页、抽取实体并构建知识图谱
<br />II.   一个典型的WES是由一个网站中某物品的所有的详细页构成，如电子商务、酒店、房产、旅游线路、票务详细页等等
<br />III.  任务创建完毕后，可以通过编辑界面深度控制爬虫行为以满足其他需求
</div>
<div class="crawls form auto-validate">
<div class='help small gray right'>帮助</div>
<?php echo $this->Form->create('Crawl'); ?>
  <fieldset>
     <legend><?php __('创建弹性分布式网络实体集(RDWES)'); ?></legend>
    <?php 

    $m = [
        'name' => '<p class="m hidden">任务名称，默认自动生成</p>',
        'rounds' => '<p class="m hidden">抓取深度。爬虫采用广度优先算法，即：<br />
                I : 爬种子链接，得到第一层网页集；<br />
               II : 抽取第一层网页集中的URL，作为第二层网页集合的种子，并开始爬第二层网页；<br />
              III : 反复重复I, II两个步骤，直到所有目标网页都成功抓取。
            </p>',
        'Seed.url' => '<p class="m hidden">爬虫入口。</p>',
        'CrawlFilter.0.url_filter' => "<p class='m hidden'><strong class='green'>列表页</strong>正则表达式模式</p>",
        'CrawlFilter.1.url_filter' => "<p class='m hidden'><strong class='green'>详细页</strong>正则表达式模式</p>",
        'CrawlFilter.text_filter' => "<p class='m hidden'><strong class='red'>详细页</strong>正则表达式模式</p>",
        'PageEntity.name' => '<p class="m hidden">详细页代表的实体名称，譬如"商品"、"手机"、"房产"等。
                <br />如果网页中包含关联实体，譬如"商品"详细页中也包含"店铺"和"评论"。可在创建后进入编辑页面进行详细配置。</p>'
    ];

    echo $this->Form->input('Seed.0.url', 
        array('label' => '入口链接', 'div' => 'input text medium', 'type' => 'text', 'after' => $m['Seed.url']));
    echo "<div class='seed-url-testing-message hidden'>链接可用性测试中，请稍候...</div>";
    // echo "<button>测试链接</button>";

    echo $this->Form->input('CrawlFilter.0.url_filter',
        array('label' => '列表页链接模式', 'div' => 'input text medium', 'type' => 'text', 'after' => $m['CrawlFilter.0.url_filter']));
    echo $this->Form->hidden('CrawlFilter.0.page_type', array('value' => 'INDEX'));

    echo $this->Form->input('CrawlFilter.1.url_filter',
        array('label' => '详细页链接模式', 'div' => 'input text medium', 'type' => 'text', 'after' => $m['CrawlFilter.1.url_filter']));
    echo $this->Form->hidden('CrawlFilter.1.page_type', array('value' => 'DETAIL'));

    echo $this->Form->input('PageEntity.0.name', array('label' => '实体名', 
    		'div' => 'input text required', 'after' => $m['PageEntity.name']));

    echo $this->Form->input('description', array('label' => '简单说明', 'rows' => '1'));
  ?>
  </fieldset>
<?php echo $this->Form->end(__('Submit', true)); ?>
</div>

<div class="actions">
  <h3><?php __('Actions'); ?></h3>
  <ul>
    <li><?php echo $this->Html->link(__('List Crawls', true), array('action' => 'index'));?></li>
    <li><?php echo $this->Html->link(__('Regex Tester', true), array('controller' => 'pages', 'action' => 'regexpal'), array('target' => '_blank')); ?></li>
  </ul>
</div>

<div class="intelligent-analysis form hidden">
  <div class='message hidden'></div>
  <?php echo $this->Form->create('Crawl', array('action' => '#')); ?>
  <fieldset>
     <legend>输入种子链接开始分析</legend>
    <div class="input text medium">
      <input name="data[Crawl][url]" id="CrawlUrl" type="text">
      <button type="button" class="analysis">开始分析</button>
      <p class="m hidden">输入种子链接</p>
    </div>
  </fieldset>
  <?php echo $this->Form->end(); ?>
</div>

<div class="test form hidden">
  <?php echo $this->Form->create('Crawl', array('action' => '#')); ?>
  <fieldset>
     <legend><?php __('测试正则表达式'); ?></legend>
     <div>Regex : <span class='regex'></span></div>
  <?php 
    echo $this->Form->input('test_urls', array('label' => '测试链接', 'type' => 'textarea', 'class' => 'test-urls', 'after' => '<p class="m hidden">每行一个待测链接</p>'));
    echo $this->Form->button('开始测试', array('type' => 'button', 'class' => 'start-test-regex'));
  ?>
  </fieldset>
  <?php echo $this->Form->end(); ?>
  <div class='test result'></div>
</div>
