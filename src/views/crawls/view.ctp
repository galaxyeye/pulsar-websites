<?php echo $this->element('crawls/subnav') ?>

<script type="text/javascript">
<!--
  var crawl = <?php echo json_encode($crawl) ?>;
//-->
</script>
<div class='message crawls-view-tip hidden'>
说明：
<br />I.   本页面提供基本爬虫控制，主要目标是采集、抽取和分析单个站点内的详细页，如电子商务、酒店、房产、旅游线路、票务等等
<br />II.  任务创建完毕后，可以通过编辑界面深度控制爬虫行为以满足其他需求
<br />III. 一个爬虫任务对应一个"弹性分布式网页集(RDW)"，基于Spark的"弹性分布式数据集(RDD)"，后续数据分析均以RDD为核心模型
</div>

<div class='view'>
  <h1>Crawl Controller</h1>
</div>
<div class="crawls view">
  <h2><span><?php  __('General Information');?></span></h2>
  <dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <span class='model-id'><?=$crawl['Crawl']['id']; ?></span>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['name']; ?>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Nutch Crawl Id'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['crawlId']; ?>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Config Id'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['configId']; ?>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Solr Collection'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['solrCollection']; ?>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Rounds'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['rounds']; ?>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Frequency'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['frequency']; ?>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Finished Rounds'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <span class='finished-rounds'><?=$crawl['Crawl']['finished_rounds']; ?></span>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Limit'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['limit']; ?>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Fetched Pages'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <span class='fetched-pages'><?=$crawl['Crawl']['fetched_pages']; ?></span>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Max Url Length'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['max_url_length']; ?>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('State'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['state']; ?>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['created']; ?>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['modified']; ?>
      &nbsp;
    </dd>
    <!-- 
    <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Finished'); ?></dt>
    <dd<?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['finished']; ?>
      &nbsp;
    </dd>
     -->
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?=$crawl['Crawl']['description']; ?>
      &nbsp;
    </dd>
  </dl>
</div>

<div class="actions">
  <br />
  <h3>Crawl Control</h3>
  <ul>
    <?php $state = $crawl['Crawl']['state'] ?>
    <?php if ($state == 'RUNNING') : ?>
    <li><?=$this->Html->link(__('Pause', true),
    		['action' => 'pause', $crawl['Crawl']['id']],
    		['title' => 'Pause the crawl, pause the running nutch job, so you can resume it later']
    		); ?></li>
    <li><?=$this->Html->link(__('Stop', true),
    		['action' => 'stop', $crawl['Crawl']['id']],
    		['title' => 'Stop the crawl, kill the running nutch job']
    		); ?></li>
    <?php elseif ($state == 'PAUSED') : ?>
    <li><?=$this->Html->link(__('Resume', true),
    		['action' => 'resume', $crawl['Crawl']['id']],
    		['title' => 'Resume the latest paused job if possible']
    		); ?></li>
    <?php endif; ?>

    <?php if ($state != 'CREATED') : ?>
    <li><?=$this->Html->link(__('Reset', true),
    		['action' => 'reset', $crawl['Crawl']['id']],
    		['title' => 'Reset the crawl to the initial status, so you can start it again']
    		); ?></li>
    <?php endif; ?>
  </ul>
  <hr />
  <h3>Tools</h3>
  <ul>
    <?php if (!empty($crawl['Crawl']['configId'])) : ?>
    <li><?=$this->Html->link(__('Nutch Configuration', true),
        array('controller' => 'nutch_jobs', 'action' => 'nutchConfig', $crawl['Crawl']['configId']),
        array('target' => '_blank')); ?></li>
    <?php endif; ?>
    <li><?=$this->Html->link(__('Nutch Parser Checker', true),
        ['controller' => 'nutch_jobs', 'action' => 'parseChecker', '?' => ['target' => $crawl['Seed'][0]['url'], 'crawl_id' => $crawl['Crawl']['id']]],
        ['target' => '_blank', 'title' => 'Check Nutch Parser using the seed']); ?></li>
    <li><?=$this->Html->link(__('Test Nutch Message', true), ['action' => 'testNutchMessage', $crawl['Crawl']['id']]); ?> </li>    
  </ul>
  <hr />
  <h3>Actions</h3>
  <ul>
    <li><?=$this->Html->link(__('List Fetched Pages', true),
        array('controller' => 'storage_web_pages', 'action' => 'indexByCrawl', $crawl['Crawl']['id']),
        array('target' => '_blank', 'title' => 'Fetched Pages Link Map')); ?></li>
    <li><?=$this->Html->link(__('Edit Crawl', true), ['action' => 'edit', $crawl['Crawl']['id']]); ?> </li>
    <li><?=$this->Html->link(__('New Wes', true), ['action' => 'addWes'], ['target' => '_blank']); ?> </li>
    <li><?=$this->Html->link(__('New Crawl', true), ['action' => 'add'], ['target' => '_blank']); ?> </li>
    <li><?php echo $this->Html->link(__('Solr UI', true),
                SOLR_URL_BASE . '/solr/' . $crawl['Crawl']['solrCollection'] . '/browse', ['target' => '_blank']) ?></li>
  </ul>
</div>

<?php if ($crawl['Crawl']['state'] == 'CREATED') : ?>
<div class="crawls form">
<?=$this->Form->create('Crawl', array('action' => 'startCrawl'));?>
  <fieldset>
  <?=$this->Form->input('id', array('value' => $crawl['Crawl']['id'])); ?>
  <?=$this->Form->end(__('Start Crawl', true));?>
  </fieldset>
</div>
<?php endif; ?>

<div class="nutch server view">
  <h3><?php  __('Nutch Server Message');?></h3>

  <div>
    <pre id="jobInfo"></pre>
  </div>
</div>

<!-- **************************************************************
  Begin Nutch Jobs
 **************************************************************-->
<div class="related nutchJobs">
  <h3>
    <span><?php __('Nutch Jobs');?></span>
    <p class="m hidden">相关Nutch爬虫任务</p>
  </h3>
  <?php if (!empty($crawl['NutchJob'])): ?>
  <table cellpadding="0" cellspacing="0">
    <tr>
      <th><?php __('Id'); ?></th>
      <th><?php __('Round'); ?></th>
      <th><?php __('JobId');?></th>
      <th><?php __('Type');?></th>
      <th><?php __('ConfId');?></th>
      <th><?php __('Count');?></th>
      <th><?php __('State');?></th>
      <th class="actions"><?php __('Actions');?></th>
    </tr>
  <?php 
    $i = 0;
    foreach ($crawl['NutchJob'] as $nutchJob) : 
      $class = null;
      if ($i ++ % 2 == 0) {
        $class = ' class="altrow"';
      }
      ?>
    <tr <?=$class;?>>
      <td class='model-id'><?=$nutchJob['id'];?></td>
      <td><?=$nutchJob['round']; ?>&nbsp;</td>
      <td><?=$nutchJob['jobId']; ?>&nbsp;</td>
      <td><?=$nutchJob['type']; ?>&nbsp;</td>
      <td><?=$nutchJob['confId']; ?>&nbsp;</td>
      <td><?=$nutchJob['count']; ?>&nbsp;</td>
      <td><?=$nutchJob['state']; ?>&nbsp;</td>
      <td class="actions">
        <?php 
          echo $this->Html->link (__('View', true), ['controller' => 'nutch_jobs','action' => 'view', $nutchJob['id']],
              ['target' => 'layer']); ?>
		<?php echo $this->Html->link(__('Resume', true), ['controller' => 'nutch_jobs', 'action' => 'resume', $crawl['Crawl']['id']]); ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>

  <div class="actions">
    <ul>
      <li><?=$this->Html->link(__('List Nutch Jobs', true),
          ['controller' => 'nutch_jobs', 'action' => 'index', 'crawl_id' => $crawl['Crawl']['id']],
          ['target' => '_blank']); ?> </li>
  </div>
</div>
<!-- **************************************************************
  End Nutch Jobs
 **************************************************************-->

<!-- **************************************************************
  Begin Seeds
 **************************************************************-->
<div class="related seeds">
  <h3>
    <span><?php __('Seeds');?></span>
    <p class="m hidden">抓取任务从种子网页开始</p>
  </h3>
  <?php if (!empty($crawl['Seed'])): ?>
  <table cellpadding="0" cellspacing="0">
    <tr>
      <th><?php __('Id'); ?></th>
      <th><?php __('Url'); ?></th>
      <th class="actions"><?php __('Actions');?></th>
    </tr>
  <?php 
    $i = 0;
    foreach ( $crawl['Seed'] as $seed ) :
      $class = null;
      if ($i ++ % 2 == 0) {
        $class = ' class="altrow"';
      }
      ?>
    <tr <?=$class;?>>
      <td class='model-id'><?=$seed['id'];?></td>
      <td><pre><?=$seed['url'];?></pre></td>
      <td class="actions">
        <?php 
          echo $this->Html->link (__('Delete', true), array(
              'controller' => 'seeds',
              'action' => 'delete',
              $seed ['id'] 
          ), null, sprintf (__('Are you sure you want to delete # %s?', true), $seed ['id']));
//       ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>

  <div class="actions">
    <ul>
      <li><?=$this->Html->link(__('New Seed', true),
          array('controller' => 'seeds', 'action' => 'add', 'crawl_id' => $crawl['Crawl']['id'])); ?> </li>
      <li><?=$this->Html->link(__('List Seeds for This Crawl', true),
          array('controller' => 'seeds', 'action' => 'index', 'crawl_id' => $crawl['Crawl']['id']), 
      		array('target' => '_blank')); ?> </li>
    </ul>
  </div>
</div>
<!-- **************************************************************
  End Seeds
 **************************************************************-->

<!-- **************************************************************
  Begin Crawl Filter
 **************************************************************-->
<div class="related crawlFilter index">
  <h3>
    <span><?php __('Crawl Filters');?></span>
    <p class="m hidden">抓取过滤器定义哪些网页需要被抓取。多个Url Filter按逻辑或计算结果。
        <br />单个Crawl Filter定义为：
        <br />链接模式满足Url Filter，且文本内容满足Text Filter的网页中，
        网页转换为文档对象模型DOM后，Parse Block Filter规定的区域内的链接需要被抓取
    </p>
  </h3>
  <?php if (!empty($crawl['CrawlFilter'])):?>
  <table cellpadding="0" cellspacing="0">
    <tr>
      <th><?php __('Id'); ?></th>
      <th><?php __('Url Filter'); ?></th>
      <th><?php __('Text Filter'); ?></th>
      <th><?php __('Parse Block Filter'); ?></th>
      <th class="actions"><?php __('Actions');?></th>
    </tr>
  <?php 
    $i = 0;
    foreach ( $crawl ['CrawlFilter'] as $crawlFilter ) :
      $class = null;
      if ($i ++ % 2 == 0) {
        $class = ' class="altrow"';
      }
      ?>
    <tr <?=$class;?>>
      <td class='model-id'><?=$crawlFilter['id'];?></td>
      <td><pre><?=$crawlFilter['url_filter'];?></pre></td>
      <td><pre><?=$crawlFilter['text_filter'];?></pre></td>
      <td><pre><?=$crawlFilter['block_filter'];?></pre></td>
      <td class="actions">
        <?=$this->Html->link(__('View', true), 
            ['controller' => 'crawl_filters', 'action' => 'view', $crawlFilter ['id']],
            ['target' => 'layer']);
        ?>
        <?=$this->Html->link(__('Edit', true), 
            ['controller' => 'crawl_filters', 'action' => 'edit', $crawlFilter ['id']]); 
        ?>
        <?php 
        echo $this->Html->link (__('Delete', true), array (
            'controller' => 'crawl_filters',
            'action' => 'delete',
            $crawlFilter ['id']
        ), null, sprintf (__('Are you sure you want to delete # %s?', true), $crawlFilter ['id']));
      ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>

  <div class="actions">
    <ul>
      <li>
        <?php 
          echo $this->Html->link (__('New Crawl Filter', true), array (
              'controller' => 'crawl_filters',
              'action' => 'add',
              'crawl_id' => $crawl['Crawl']['id']), array('target' => '_blank'));
        ?>
      </li>
    </ul>
  </div>
</div>
<!-- **************************************************************
  End Crawl Filter
 **************************************************************-->

<!-- **************************************************************
  Begin Web Authorization
 **************************************************************-->
<div class="related webAuthorizations index">
  <h3>
    <span><?php __('Web Authorizations');?></span>
    <p class="m hidden">如果需要抓取登录后的网页，需要提供用户名和密码。多个用户名将随机选择使用</p>
  </h3>
  <?php if (!empty($crawl['WebAuthorization'])):?>
  <table cellpadding="0" cellspacing="0">
    <tr>
      <th><?php __('Id'); ?></th>
      <th><?php __('Login Url'); ?></th>
      <th><?php __('AccountCssSelector'); ?></th>
      <th><?php __('Account'); ?></th>
      <th><?php __('PasswordText'); ?></th>
      <th><?php __('PasswordCssSelector'); ?></th>
      <th class="actions"><?php __('Actions');?></th>
    </tr>
  <?php 
    $i = 0;
    foreach ( $crawl ['WebAuthorization'] as $webAuthorization ) :
      $class = null;
      if ($i ++ % 2 == 0) {
        $class = ' class="altrow"';
      }
      ?>
    <tr <?=$class;?>>
      <td class='model-id'><?=$webAuthorization['id']; ?>&nbsp;</td>
      <td><?=$webAuthorization['login_url']; ?>&nbsp;</td>
      <td><?=$webAuthorization['account_css_selector']; ?>&nbsp;</td>
      <td><?=$webAuthorization['account']; ?>&nbsp;</td>
      <td><?=$webAuthorization['password_css_selector']; ?>&nbsp;</td>
      <td><?=$webAuthorization['password_text']; ?>&nbsp;</td>
      <td class="actions">
        <?=$this->Html->link(__('View', true), 
            ['controller' => 'web_authorizations', 'action' => 'view', $webAuthorization ['id']],
            ['target' => 'layer']);
        ?>
        <?php 
          echo $this->Html->link (__('Delete', true), array (
              'controller' => 'web_authorizations',
              'action' => 'delete',
              $webAuthorization ['id'] 
          ), null, sprintf (__('Are you sure you want to delete # %s?', true), $webAuthorization ['id']));
        ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>

  <div class="actions">
    <ul>
      <li><?php 
        echo $this->Html->link (__('New Web Authorization', true), array (
            'controller' => 'web_authorizations',
            'action' => 'add',
            'crawl_id' => $crawl['Crawl']['id']
        ), array('class' => 'add-web-authorization'));
      ?> </li>
    </ul>
  </div>
</div>
<!-- **************************************************************
  End Web Authorization
 **************************************************************-->

<!-- **************************************************************
  Begin Human Action
 **************************************************************-->
<div class="related humanActions index">
  <h3>
    <span><?php __('Human Actions');?></span>
    <p class="m hidden">浏览器打开网页后的行为。模拟真人操作，譬如滚轮滚动、鼠标点击、鼠标移动等行为</p>
  </h3>
  <?php if (!empty($crawl['HumanAction'])):?>
  <table cellpadding="0" cellspacing="0">
    <tr>
      <th><?php __('Id'); ?></th>
      <th><?php __('执行顺序'); ?></th>
      <th><?php __('执行对象路径'); ?></th>
      <th><?php __('动作'); ?></th>
      <th class="actions"><?php __('Actions');?></th>
    </tr>
  <?php 
    $i = 0;
    foreach ($crawl['HumanAction'] as $humanAction) : 
      $class = null;
      if ($i ++ % 2 == 0) {
        $class = ' class="altrow"';
      }
      ?>
    <tr <?=$class;?>>
      <td class='model-id'><?=$humanAction['id'];?></td>
      <td><?=$humanAction['order'];?></td>
      <td><?=$humanAction['css_path'];?></td>
      <td><?=$humanAction['action'];?></td>
      <td class="actions">
        <?=$this->Html->link(__('View', true), 
            ['controller' => 'human_actions', 'action' => 'view', $humanAction ['id']],
            ['target' => 'layer']);
        ?>
        <?php 
        echo $this->Html->link (__('Delete', true), array (
            'controller' => 'human_actions',
            'action' => 'delete',
            $humanAction ['id']
        ), null, sprintf (__('Are you sure you want to delete # %s?', true), $humanAction['id']));
      ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>

  <div class="actions">
    <ul>
      <li>
        <?php 
          echo $this->Html->link (__('New Human Action', true), array (
              'controller' => 'human_actions',
              'action' => 'add',
              'crawl_id' => $crawl['Crawl']['id']
          ));
        ?>
      </li>
    </ul>
  </div>

</div>
<!-- **************************************************************
  End Human Action
 **************************************************************-->

<!-- **************************************************************
  Begin Stop Urls
 **************************************************************-->
<div class="related stopUrls index">
  <h3>
    <span><?php __('Stop Urls');?></span>
    <p class="m hidden">停止链接会在某个访问点被中止访问。</p>
  </h3>
  <?php if (!empty($crawl['StopUrl'])):?>
  <table cellpadding="0" cellspacing="0">
  <tr>
      <th>Id</th>
      <th>Url</th>
      <th>Forbidden Point</th>
      <th class="actions"><?php __('Actions');?></th>
  </tr>
  <?php 
  $i = 0;
  foreach ($crawl['StopUrl'] as $stopUrl):
    $class = null;
    if ($i++ % 2 == 0) {
      $class = ' class="altrow"';
    }
  ?>
  <tr<?=$class;?>>
    <td><?=$stopUrl['StopUrl']['id']; ?>&nbsp;</td>
    <td><?=$stopUrl['StopUrl']['url']; ?>&nbsp;</td>
    <td><?=$stopUrl['StopUrl']['forbidden_point']; ?>&nbsp;</td>
    <td class="actions">
      <?=$this->Html->link(__('View', true),
          ['controller' => 'stop_urls', 'action' => 'view', $stopUrl['id']],
          ['target' => 'layer']);
      ?>
      <?=$this->Html->link(__('Edit', true), ['controller' => 'stop_urls', 'action' => 'edit', $stopUrl['StopUrl']['id']]); ?>
      <?=$this->Html->link(__('Delete', true), array('controller' => 'stop_urls', 'action' => 'delete', $stopUrl['StopUrl']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $stopUrl['StopUrl']['id'])); ?>
    </td>
  </tr>
<?php endforeach; ?>
  </table>
<?php endif; ?>

  <div class="actions">
    <ul>
      <li>
        <?php 
          echo $this->Html->link (__('New Stop Url', true), array (
              'controller' => 'stop_urls',
              'action' => 'add',
              'crawl_id' => $crawl['Crawl']['id']
          ));
        ?>
      </li>
    </ul>
  </div>

</div>
<!-- **************************************************************
  End Stop Urls
 **************************************************************-->

<!-- **************************************************************
  Begin Page Entities
 **************************************************************-->
 <div class="related pageEntities index">
  <h3><?php __('Page Entities');?></h3>
  <?php if (!empty($crawl['PageEntity'])):?>
  <table cellpadding="0" cellspacing="0">
  <tr>
      <th>Id</th>
      <th>Name</th>
      <th class="actions"><?php __('Actions');?></th>
  </tr>
  <?php 
  $i = 0;
  foreach ($crawl['PageEntity'] as $pageEntity):
    $class = null;
    if ($i++ % 2 == 0) {
      $class = ' class="altrow"';
    }
  ?>
  <tr<?=$class;?>>
    <td><?=$pageEntity['id']; ?>&nbsp;</td>
    <td><?=$pageEntity['name']; ?>&nbsp;</td>
    <td class="actions">
      <?=$this->Html->link(__('View', true),
          ['controller' => 'page_entities', 'action' => 'view', $pageEntity['id']],
          ['target' => 'layer']);
      ?>
      <?=$this->Html->link(__('Edit', true), array('controller' => 'page_entities', 'action' => 'edit', $pageEntity['id'])); ?>
      <?=$this->Html->link(__('Delete', true), array('controller' => 'page_entities', 'action' => 'delete', $pageEntity['id']),
            null, sprintf(__('Are you sure you want to delete # %s?', true), $pageEntity['id'])); ?>
    </td>
  </tr>
<?php endforeach; ?>
  </table>
<?php endif; ?>

  <div class="actions">
    <ul>
      <li>
        <?php 
          echo $this->Html->link (__('New Page Entity', true), array (
              'controller' => 'page_entities',
              'action' => 'add',
              'crawl_id' => $crawl['Crawl']['id']
          ));
        ?>
      </li>
    </ul>
  </div>
</div>
<!-- **************************************************************
  End Page Entities
 **************************************************************-->
