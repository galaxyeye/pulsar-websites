<script type="text/x-jsrender" id="jobInfoTemplate">
	<h4>任务配置</h4>
	<dl>
		{{props}}
		<dt>{{>key}}</dt>
		<dd>
			{{>prop}}			&nbsp;
		</dd>
		{{/props}}
	</dl>
	<hr/>

	<h4>任务参数</h4>
	<dl>
		{{props args}}
		<dt>{{>key}}</dt>
		<dd>
			{{>prop}}			&nbsp;
		</dd>
		{{/props}}
	</dl>
	<hr/>

	<h4>任务结果</h4>
	<dl>
		{{props result}}
		<dt>{{>key}}</dt>
		<dd>
			{{>prop}}			&nbsp;
		</dd>
		{{/props}}

	</dl>
</script>

<div class='message crawls-view-tip hidden'>
说明：
<br />I.   本页面提供基本爬虫控制，主要目标是采集、抽取和分析单个站点内的详细页，如电子商务、酒店、房产、旅游线路、票务等等
<br />II.  任务创建完毕后，可以通过编辑界面深度控制爬虫行为以满足其他需求
<br />III. 一个爬虫任务对应一个"弹性分布式网页集(RDW)"，基于Spark的"弹性分布式数据集(RDD)"，后续数据分析均以RDD为核心模型
</div>

<div class='view'>
	<h1>弹性分布式网页集概要</h1>
</div>
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
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Rounds'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['rounds']; ?>
			&nbsp;
		</dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Finished Rounds'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['finished_rounds']; ?>
			&nbsp;
		</dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['created']; ?>
			&nbsp;
		</dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['modified']; ?>
			&nbsp;
		</dd>
		<!-- 
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Finished'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['finished']; ?>
			&nbsp;
		</dd>
		 -->
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $crawl['Crawl']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('View Crawl Status', true), array('action' => 'status', $crawl['Crawl']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Edit Crawl', true), array('action' => 'edit', $crawl['Crawl']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Reset Crawl Jobs (For Test Mode Only)', true), array('action' => 'resetCrawl', $crawl['Crawl']['id']), array('target' => '_blank')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('action' => 'add'), array('target' => '_blank')); ?> </li>
	</ul>
</div>

<div class="crawls view">
	<h3><?php  __('爬虫服务器最后消息');?></h3>

	<div id="jobInfo"></div>
</div>

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
		foreach ( $crawl ['Seed'] as $seed ) :
			$class = null;
			if ($i ++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			?>
		<tr <?php echo $class;?>>
			<td class='model-id'><?php echo $seed['id'];?></td>
			<td><?php echo $seed['url'];?></td>
			<td class="actions">
				<?php 
					echo $this->Html->link (__('Delete', true), array (
							'controller' => 'seeds',
							'action' => 'delete',
							$seed ['id'] 
					), null, sprintf (__('Are you sure you want to delete # %s?', true), $seed ['id']));
// 			?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Seed', true),
					array('controller' => 'seeds', 'action' => 'add', 'crawl_id' => $crawl['Crawl']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('List Seeds For This Crawl', true),
					array('controller' => 'seeds', 'action' => 'index', 'crawl_id' => $crawl['Crawl']['id']), array('target' => '_blank')); ?> </li>
		</ul>
	</div>
</div>

<!-- 
<div id="seed-url-dialog-form" title="Create new seed url">
	<p class="validateTips"><?php __("All form fields are required.") ?></p>
	<form>
		<fieldset>
			<label for="seedUrl">Seed Url</label>
			<input name="data[Seed][url]" maxlength="1024" type="text" id="seedUrl" class="text ui-widget-content ui-corner-all" />
			<input name="data[Seed][crawl_id]" value="<?php echo $crawl['Crawl']['id']?>" type="hidden" id="crawlId" />
			<input type="submit" tabindex="-1" style="position: absolute; top: -1000px" />
		</fieldset>
	</form>
</div>
 -->
 
<!-- **************************************************************
	Begin Crawl Filter
 **************************************************************-->
<div class="related crawl-filter">
	<h3>
		<span><?php __('Crawl Filters');?></span>
		<p class="m hidden">抓取过滤器定义哪些网页需要抓取。多个Url Filter按逻辑或计算结果。
    		<br />单个Crawl Filter定义为：
    		<br />链接符合XXX(Url Filter)，且文本内容符合YYY(Text Filter)的网页中，
    		网页转换为文档对象模型DOM后，ZZZ(Parse Block Filter)规定的区域内的链接需要/不需要被抓取
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
		<tr <?php echo $class;?>>
			<td class='model-id'><?php echo $crawlFilter['id'];?></td>
			<td><pre><?php echo $crawlFilter['url_filter'];?></pre></td>
			<td><pre><?php echo $crawlFilter['text_filter'];?></pre></td>
			<td><pre><?php echo $crawlFilter['parse_block_filter'];?></pre></td>
			<td class="actions">
			  <?php echo $this->Html->link(__('View', true), array('controller' => 'crawl_filters', 'action' => 'view', $crawlFilter ['id'])); ?>
			  <?php echo $this->Html->link(__('Edit', true), array('controller' => 'crawl_filters', 'action' => 'edit', $crawlFilter ['id'])); ?>
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
<div class="related web-authorization">
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
		<tr <?php echo $class;?>>
			<td class='model-id'><?php echo $webAuthorization['id']; ?>&nbsp;</td>
			<td><?php echo $webAuthorization['login_url']; ?>&nbsp;</td>
			<td><?php echo $webAuthorization['account_css_selector']; ?>&nbsp;</td>
			<td><?php echo $webAuthorization['account']; ?>&nbsp;</td>
			<td><?php echo $webAuthorization['password_css_selector']; ?>&nbsp;</td>
			<td><?php echo $webAuthorization['password_text']; ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'web_authorizations', 'action' => 'view', $webAuthorization['id'])); ?>
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
<div class="related human-action">
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
		foreach ( $crawl['HumanAction'] as $humanAction) : 
			$class = null;
			if ($i ++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			?>
		<tr <?php echo $class;?>>
			<td class='model-id'><?php echo $humanAction['id'];?></td>
			<td><?php echo $humanAction['order'];?></td>
			<td><?php echo $humanAction['css_path'];?></td>
			<td><?php echo $humanAction['action'];?></td>
			<td class="actions">
			  <?php echo $this->Html->link(__('View', true), array('controller' => 'human_actions', 'action' => 'view', $humanAction['id'])); ?>
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
	Begin Page Entity
 **************************************************************-->
<?php 
	if (!empty($crawl['Extraction']['PageEntity'])) : 
		$pageEntity = $crawl['Extraction']['PageEntity'][0];
?>
<div class="related pageEntity view">
	<h3>
		<span><?php __('网页主实体');?></span>
		<p class="m hidden">定义网页主实体。如果要定义网页的关联实体，点击View Extraction。本体系统上线后将允许从本体系统中选择实体</p>
	</h3>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<span class='page-entity-id'><?php echo $pageEntity['id']; ?></span>
			&nbsp;
		</dd>
		<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd <?php if ($i++ % 2 == 0) echo $class;?>>
			<span class='model-id'><?php echo $pageEntity['name']; ?></span>
			&nbsp;
		</dd>
  </dl>
</div>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('View Extraction', true), 
				array('controller' => 'extractions', 'action' => 'view', $pageEntity['extraction_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('View Page Entity', true), 
				array('controller' => 'page_entities', 'action' => 'view', $pageEntity['id'])); ?> </li>
	</ul>
</div>

<div class="related page-entity-field">
	<h3>
		<span><?php __('网页主实体字段');?></span>
		<p class="m hidden">定义网页主实体字段的抽取规则。可以抓取一批网页后定义，系统将在网页集上执行机器学习，并给出建议的抽取规则</p>
	</h3>
	<?php if (!empty($pageEntity['PageEntityField'])):?>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php __('Id'); ?></th>
			<th><?php __('字段名'); ?></th>
			<th><?php __('Css Path'); ?></th>
			<th><?php __('抽取器'); ?></th>
			<th><?php __('文本抽取表达式'); ?></th>
			<th><?php __('文本验证表达式'); ?></th>
			<th><?php __('SQL数据类型'); ?></th>
			<th class="actions"><?php __('Actions');?></th>
		</tr>
	<?php 
		$i = 0;
		foreach ( $pageEntity['PageEntityField'] as $pageEntityField) :
			$class = null;
			if ($i ++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			?>
		<tr <?php echo $class;?>>
			<td class='model-id'><?php echo $pageEntityField['id'];?></td>
			<td><?php echo $pageEntityField['name'];?></td>
			<td><?php echo $pageEntityField['css_path'];?></td>
			<td><?php echo $pageEntityField['extractor_class'];?></td>
			<td><?php echo $pageEntityField['text_extract_regex'];?></td>
			<td><?php echo $pageEntityField['text_validate_regex'];?></td>
			<td><?php echo $pageEntityField['sql_data_type'];?></td>
			<td class="actions">
				<?php 
					echo $this->Html->link (__('View', true), array(
							'controller' => 'page_entity_fields',
							'action' => 'view',
							$pageEntityField['id']
					));
				?>
				<?php 
					echo $this->Html->link (__('Edit', true), array(
							'controller' => 'page_entity_fields',
							'action' => 'edit',
							$pageEntityField['id'],
							'crawl_id' => $crawl['Crawl']['id']
					));
				?>
				<?php 
					echo $this->Html->link(__('Delete', true), array(
							'controller' => 'page_entity_fields',
							'action' => 'delete',
							$pageEntityField['id']
					), null, sprintf (__('Are you sure you want to delete # %s?', true), $pageEntityField['id']));
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
					echo $this->Html->link (__('New Page Entity Field', true), array(
							'controller' => 'page_entity_fields',
							'action' => 'add',
							'page_entity_id' => $pageEntity['id'],
							'crawl_id' => $crawl['Crawl']['id']
					));
				?>
			</li>
		</ul>
	</div>
</div>
<?php endif; ?>
<!-- **************************************************************
	End Page Entity
 **************************************************************-->

<?php if ($crawl['Crawl']['job_type'] == 'NONE') : ?>
<div class="crawls form">
<?php echo $this->Form->create('Crawl', array('action' => 'startCrawl'));?>
	<fieldset>
		<legend><?php __('Start This Crawl'); ?></legend>
	<?php echo $this->Form->input('id', array('value' => $crawl['Crawl']['id'])); ?>
	<?php echo $this->Form->end(__('Start Crawl', true));?>
	</fieldset>
</div>
<?php endif; ?>
