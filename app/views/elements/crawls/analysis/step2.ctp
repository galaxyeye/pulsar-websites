<!---------------------------------------------------------->
<!-- 第二步：链接模式选择 -->
<!---------------------------------------------------------->
<div class="crawls analysis step-2 add-wes form auto-validate">
  <?php echo $this->Form->create('Crawl', array('action' => 'addWes')); ?>
  <fieldset>
  <?php 

  $m = [
      'CrawlFilter.0.url_filter' => "<p class='m hidden'><strong class='green'>列表页</strong>正则表达式模式</p>",
       'CrawlFilter.1.url_filter' => "<p class='m hidden'><strong class='green'>详细页</strong>正则表达式模式</p>",
       'CrawlFilter.text_filter' => "<p class='m hidden'><strong class='red'>详细页</strong>正则表达式模式</p>",
    ];

    $tld = get_tld($seed);
    $nameBase = substr($tld, 0, strpos($tld, "."));
    $entityName = "$nameBase-".date('Ymd-His');
    $entityName = preg_replace("/\s+/", "-", $entityName);

    $defaultIndexRegex = '^'.$seed."(.*)$";

    $inputOptions = ['label' => '种子链接', 'value' => $seed, 'div' => 'input text long required', 
        'type' => 'text', 'disabled' => 'disabled'];
    echo $this->Form->input('Dummy.url', $inputOptions);

    echo $this->Form->hidden('Seed.0.url', ['value' => $seed]);

    $inputOptions = ['label' => '列表页链接模式', 'value' => $defaultIndexRegex, 'div' => 'input text long', 
        'type' => 'text', 'after' => $m['CrawlFilter.0.url_filter']];
    echo $this->Form->input('CrawlFilter.0.url_filter', $inputOptions);
    echo $this->Form->hidden('CrawlFilter.0.page_type', array('value' => 'INDEX'));

    $inputOptions = ['label' => '详细页链接模式', 'div' => 'input text long', 'type' => 'text',
        'after' => $m['CrawlFilter.1.url_filter']];
    echo $this->Form->input('CrawlFilter.1.url_filter', $inputOptions);
    echo $this->Form->hidden('CrawlFilter.1.page_type', array('value' => 'DETAIL'));

    echo $this->Form->hidden('PageEntity.0.name', array('value' => $entityName));

    echo $this->Form->hidden('Ui.analysis', array('value' => 'analysis'));
  ?>
  </fieldset>
  <?php echo $this->Form->end(__('Submit', true)); ?>
</div>

<div class='crawls view analysis result'>
  <?php foreach ($outlinks as $count => $groups) : ?>
  <div class='regex group links'>
    <h2><?php echo $groups['regex'] ?></h2>
    <button type="button" class="choose index">选为列表页链接模式</button>
    <button type="button" class="choose detail">选为详细页链接模式</button>
    <ol class='decimal'>
      <?php 
        $i = 0;
        foreach ($groups['urls'] as $outlink) : 
      ?>
      <li><?php echo $outlink ?></li>
      <?php 
        if ($i++ > 20) {
          echo "<li>And more ...</li>";
          break;
        }

        endforeach; 
      ?>
    </ol>
  </div>
  <hr />
  <br />
  <?php endforeach; ?>
</div>
