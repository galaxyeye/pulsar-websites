<style>
<!--
.pageInfo { width:40%; }
-->
</style>

<div class="crawls view">
  <h2><span><?php  __('爬虫配置');?></span></h2>
  <dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <span class='model-id'><?php echo $crawl['Crawl']['id']; ?></span>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $crawl['Crawl']['name']; ?>
      &nbsp;
    </dd>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Config Id'); ?></dt>
    <dd <?php if ($i++ % 2 == 0) echo $class;?>>
      <?php echo $crawl['Crawl']['configId']; ?>
      &nbsp;
    </dd>
  </dl>
</div>

<!-- **************************************************************
  Begin Crawl Filter
 **************************************************************-->
<div class="related crawl-filter">
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
      <th><?php __('Page Type'); ?></th>
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
    <tr <?php echo $class;?>>
      <td class='model-id'><?php echo $crawlFilter['id'];?></td>
      <td><pre><?php echo $crawlFilter['page_type'];?></pre></td>
      <td><pre><?php echo $crawlFilter['url_filter'];?></pre></td>
      <td><pre><?php echo $crawlFilter['text_filter'];?></pre></td>
      <td><pre><?php echo $crawlFilter['block_filter'];?></pre></td>
      <td class="actions">
        <?php echo $this->Html->link(__('View', true), array('controller' => 'crawl_filters', 'action' => 'view', $crawlFilter ['id'])); ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>
</div>
<!-- **************************************************************
  End Crawl Filter
 **************************************************************-->

<hr />

<div class="webPages index">
	<h2>
    <span><?php __('Web Page Link Map');?></span>
    <p class="m hidden">TODO：链接地图可视化</p>
	</h2>
	<?php 
	$i = 0;
	foreach ($webPages as $webPage) : 
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th></th>
			<th>Base Url</th>
			<th>Outlinks</th>
	</tr>
	<tr<?php echo $class;?>>
		<td><?php echo $i ?></td>
		<td class='pageInfo'>
		  <div><?=$this->Html->link($webPage['baseUrl'],
					['action' => 'view', symmetric_encode($webPage['baseUrl']), 'crawl_id' => $crawl['Crawl']['id']],
		  		['target' => '_blank']); ?>&nbsp;</div>
		  <div><?= !empty($webPage['title']) ? $webPage['title'] : "" ?>&nbsp;</div>
		</td>

		<td class='outlinks'>
				<?php 
				foreach ($webPage['outlinks'] as $link => $anchor) {
					if (empty($anchor)) $anchor = $link;

					echo "<div>";
				  echo $this->Html->link($link, 
							['action' => 'view', symmetric_encode($link), 'crawl_id' => $crawl['Crawl']['id']],
							['title' => $anchor, 'target' => '_blank']);
				  echo "</div>";
        }
        ?>
		</td>
	</tr>
	</table>
	<?php endforeach; ?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Search Web', true), array('action' => 'search')); ?></li>
	</ul>
</div>
