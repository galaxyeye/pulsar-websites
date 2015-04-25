<!---------------------------------------------------------->
<!-- 第四步：制定挖掘规则 -->
<!---------------------------------------------------------->
<div class="crawls analysis step-4 view">
	<h2>
		<span><?php  __('爬虫任务概要');?></span>
	</h2>
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
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Rounds'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
        <?php echo $crawl['Crawl']['rounds']; ?>
        &nbsp;
      </dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Finished Rounds'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<span class='finishedRounds'><?php echo $crawl['Crawl']['finished_rounds']; ?></span>
			&nbsp;
		</dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Limit'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['limit']; ?>&nbsp;
		</dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Fetched Count'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<span class='fetched count'>0</span> &nbsp;
		</dd>
	</dl>
</div>

<div class="crawls view">
	<h3><?php  __('爬虫服务器消息');?></h3>

	<div><pre id="jobInfo"></pre></div>
</div>

<?php 
if (!empty($crawl['PageEntity'][0] )) :
	$pageEntity = $crawl['PageEntity'][0];
  $regex = $pageEntity['url_filter'];
	$pageEntityFieldCount = count($pageEntity['PageEntityField'] );
	?>
<div class="pageEntities view">
	<h2><?php  __('Page Entity');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
    <dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<span class='model-id'><?php echo $pageEntity['id']; ?></span> &nbsp;
		</dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
        <?php echo $pageEntity['name']; ?>
        &nbsp;
      </dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Url Filter'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<pre><?php echo $pageEntity['url_filter']; ?></pre>
			<span class='regex hidden'><?php echo urlencode($pageEntity['url_filter']); ?></span>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related pageEntityFields">
	<h3><?php __('Page Entity Fields'); ?></h3>
    <?php if (!empty($pageEntity['PageEntityField'])): ?>
    <table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php __('Name'); ?></th>
			<th><?php __('Css Path'); ?></th>
			<th class="actions"><?php __('Actions');?></th>
		</tr>
    <?php 
		$i = 0;
		foreach ( $pageEntity ['PageEntityField'] as $pageEntityField ) :
			$class = null;
			if ($i ++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			?>
      <tr <?=$class;?>>
			<td><?=$pageEntityField['name'];?></td>
			<td><?=$pageEntityField['css_path'];?></td>
			<td class="actions">
          <?=$this->Html->link ( __ ( 'View', true ), [ 'controller' => 'page_entity_fields','action' => 'view',$pageEntityField ['id'] ], [ 'target' => 'layer' ] );?>
        </td>
		</tr>
    <?php endforeach; ?>
    </table>
  <?php endif; ?>

  <div id='confirmExtraction' class='pageEntities view'>

		<div class='message larger'>
			<ol>
				<li>网络爬虫正在工作中，已完成<span class='finishedRounds red larger'>0</span>轮抓取，
					本轮已抓取
					<span class='fetched index count red larger'>0</span>张详索引网页，
				  <span class='fetched detail count red larger'>0</span>张详细页网页
				</li>
				<li>获取<span class='red larger'>2</span>张详细页网页后，可以制定挖掘规则并启动挖掘引擎</li>
				<li>基于几个简单规则，系统可以精确挖掘所需数据</li>
				<li>或者获取到<span class='red larger'>20</span>张详细页网页后，可以尝试自动挖掘算法，自动挖掘算法在不断完善中</li>
			</ol>
		</div>
		<div class='actions'>
			<ul>
				<li><button class="create-rule">制定简单挖掘规则</button></li>
				<li><button class="start-ruled-extract">启动基于规则的挖掘引擎</button></li>
				<li><button class="start-auto-extract">启动自动挖掘引擎</button></li>
			</ul>
		</div>

	</div>

  <?php endif; ?>

