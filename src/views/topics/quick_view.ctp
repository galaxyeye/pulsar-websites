<div class="eight columns">
	<h2>详细信息</h2>
	<div class="topics view cl">
		<div class="four columns">
			<dl><?php $i = 0; $class = ' class="altrow"';?>
				<dt<?php if ($i % 2 == 0) echo $class;?>>主题类别：</dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?= $topic['Topic']['category']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>>主题名称：</dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?= $topic['Topic']['name']; ?>
					&nbsp;
				</dd>

				<dt<?php if ($i % 2 == 0) echo $class;?>>作者：</dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?=$doc['author'] ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>>采集网站：</dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?=$doc['site_name'] ?>
					&nbsp;
				</dd>
			</dl>
		</div>
		<div class="eight columns">
			<dl><?php $i = 0; $class = ' class="altrow"';?>
				<dt<?php if ($i % 2 == 0) echo $class;?>>原始网站：</dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?=$doc['source_site'] ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>>采集时间：</dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?=date_format($doc['last_crawl_time'], "Y-m-d H:i:s") ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>>发布时间：</dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?=date_format($doc['publish_time'], "Y-m-d H:i:s"); ?>
					<span class="debug field"><?=$doc['publish_time_str'] ?></span>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>>原文链接：</dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<a href="<?=$doc['original_url'] ?>" target="_blank"><?=$doc['original_url'] ?></a>
					&nbsp;
				</dd>
			</dl>
		</div>
	</div>
	<br />
	<div class="debug message solr-query"><?php echo $solrUrl ?></div>
	<br />
	<div class="article">
		<h2><?=$doc['title'] ?></h2>
		<hr />
		<div class="content">
			<?=$doc['html_content'] ?>
		</div>
	</div>
</div>

<div class="four columns">
	<h3>相关推荐</h3>
	<div>建设中...</div>
</div>
