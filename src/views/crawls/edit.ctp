<?php echo $this->element('crawls/subnav') ?>

<div class="crawls form">
<?php echo $this->Form->create('Crawl');?>
  <fieldset>
     <legend><?php __('Edit Crawl'); ?></legend>
  <?php 
  $m = [
      'name' => '<p class="m hidden">任务名称，默认自动生成</p>',
      'crawl_mode' => '<p class="m hidden">是否支持Ajax</p>',
      'rounds' => '<p class="m hidden">爬虫采用广度优先算法，即：<br />
              I : 爬种子链接，得到第一层网页集；<br />
             II : 抽取第一层网页集中的URL，作为第二层网页集合的种子，并开始爬第二层网页；<br />
            III : 反复重复I, II两个步骤N遍，或者再无新链接，结束抓取。
          </p>',
      'frequency' => '<p class="m hidden">抓取频率。单位：分钟</p>',
      'description' => '<p class="m hidden">对本次抓取任务的简单说明。</p>',
      'Seed.url' => '<p class="m hidden">爬虫入口。每行一个链接。</p>'
    ];

    echo $this->Form->input('id');
    echo $this->Form->input('name', array('label' => 'Crawl Name', 'after' => $m['name']));
    echo $this->Form->input('crawl_mode', array('label' => 'Ajax Support',
    		'options' => ['native' => 'Without Ajax Support', 'crowdsourcing' => 'With Ajax Support'],
        'after' => $m['crawl_mode']));
    echo $this->Form->input('rounds', array('label' => 'Crawl Round Limit', 'default' => 100, 'after' => $m['rounds']));
    echo $this->Form->input('frequency', array('label' => '抓取频率', 'default' => -1, 'after' => $m['frequency']));
    echo $this->Form->input('description', array('rows' => '1', 'after' => $m['description']));
  ?>
  </fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
  <h3><?php __('Actions'); ?></h3>
  <ul>
    <li><?php echo $this->Html->link(__('View Crawl Status', true), array('action' => 'status', $this->data['Crawl']['id'])); ?> </li>
    <li><?php echo $this->Html->link(__('New Wes', true), array('action' => 'addWes'), array('target' => '_blank')); ?> </li>
    <li><?php echo $this->Html->link(__('View Crawl', true), array('action' => 'view', $this->data['Crawl']['id'])); ?> </li>
  </ul>
</div>
