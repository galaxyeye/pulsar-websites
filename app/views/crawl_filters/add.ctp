<div class="crawlFilters form auto-validate movable">
<?php echo $this->Form->create('CrawlFilter'); ?>
	<fieldset>
 		<legend>
 			<?php __('Add Crawl Filter'); ?>
 			<?php echo " For " ?>
 			<?php echo $this->Html->link($crawl['Crawl']['name'],
 					array('controller' => 'crawls', 'action' => 'view', $crawl['Crawl']['id'])); ?>
 		</legend>
	<?php 
	  $filterMode = array('BASIC', 'ADVANCED');
	  $filterMode = array_combine($filterMode, $filterMode);
	  $pageTypes = array('NONE', 'INDEX', 'DETAIL');
	  $pageTypes = array_combine($pageTypes, $pageTypes);

	  $m = [
	  		'filter_mode' => "<p class='m hidden'>简单模式简化您的工作。</p>",
	  		'page_type' => "<p class='m hidden'>该过滤器定义的页面类型，目前定义了两个特殊类型：索引页和详细页。
	  				<br />系统将可能对特殊类型的页面做特殊处理。
	  			</p>",
	  		'url_filter' => "<p class='m hidden'>由多行正则表达式来表达的目标url模式，每行一个正则表达式。
	  				<br />正则表达式前可以有前缀'+'或者'-'，前缀'+'可以省略。
	  				<br />前缀'+'表示符合该模式的链接<strong class='green'>需要</strong>被抓取。
	  				<br />前缀'-'表示符合该模式的链接<strong class='red'>不能</strong>被抓取。
	  			</p>",
				'text_filter' => "<p class='m hidden'>由一个json对象定义的页面文本过滤器，请直接修改模板。留空表示不过滤。
	  			  <br />仅页面文本满足该对象指定的四个条件时，该页面内的链接才会被加入到下一轮抓取列表。
	  		  </p>",
				'parse_block_filter' => "<p class='m hidden'>由一个json对象定义的页面区域过滤器，请直接修改模板。留空表示不过滤。
	  				<br />仅allow指定的区域内的链接将会被加入到下一轮抓取列表，
	  			  <br />而disallow指定的区域则不会被加入到下一轮抓取列表。
	  		  </p>",

				'TextFilter.containsAll' => "<p class='m hidden'>如果页面包含所有关键词，则页面成为下一轮种子页。</p>",
	  		'TextFilter.containsAny' => "<p class='m hidden'>如果页面包含任一关键词，则页面成为下一轮种子页。</p>",
	  		'TextFilter.notContainsAll' => "<p class='m hidden'>如果页面包含所有关键词，则页面被抛弃。</p>",
	  		'TextFilter.notContainsAny' => "<p class='m hidden'>如果页面包含任一关键词，则页面被抛弃。</p>",

				'ParseBlockFilter.allow' => "<p class='m hidden'>由一个json数组定义的页面区域过滤器，如：[\"#content\"]。留空表示不过滤。
	  				<br />这些css path指定的区域内的链接将<strong class='green'>需要</strong>被加入到下一轮抓取列表。
	  		  </p>",
				'ParseBlockFilter.disallow' => "<p class='m hidden'>由一个json对象定义的页面区域过滤器，如：[\"#content\"]。留空表示不过滤。
	  				<br />这些css path指定的区域内的链接<strong class='red'>不能</strong>被加入到下一轮抓取列表。
	  		  </p>"
	  ];

	  echo $this->Form->input('filter_mode', array('options' => $filterMode, 'div' => 'input select required',
	  		'value' => 'ADVANCED', 'after' => $m['filter_mode']));
	  echo $this->Form->input('page_type', array('options' => $pageTypes, 'default' => 'NONE', 'after' => $m['page_type']));
		echo $this->Form->hidden('crawl_id', array('value' => $crawl['Crawl']['id']));
	?>
	<div class='filter-mode basic'>
	  <?php 
	  	echo $this->Form->input('url_filter', array('after' => $m['url_filter']));
		?>
	</div>

	<fieldset class='filter-mode basic'>
		<legend>TextFilter</legend>
	  <?php 
		  echo $this->Form->input('TextFilter.containsAll', array('after' => $m['TextFilter.containsAll']));
		  echo $this->Form->input('TextFilter.containsAny', array('after' => $m['TextFilter.containsAny']));
		  echo $this->Form->input('TextFilter.notContainsAll', array('after' => $m['TextFilter.notContainsAll']));
		  echo $this->Form->input('TextFilter.notContainsAny', array('after' => $m['TextFilter.notContainsAny']));
		?>
	</fieldset>

	<fieldset class='filter-mode basic'>
		<legend>ParseBlockFilter</legend>
		<?php 
		  echo $this->Form->input('ParseBlockFilter.allow', array('value' => '[":root"]', 'after' => $m['ParseBlockFilter.allow']));
		  echo $this->Form->input('ParseBlockFilter.disallow', array('value' => '["#copyright"]', 'after' => $m['ParseBlockFilter.disallow']));
		?>
	</fieldset>

	<div class='filter-mode advanced hidden'>
  <?php 
	  global $urlFilterTemplate, $textFilterTemplate, $parseBlockTemplate;
  	echo $this->Form->input('url_filter', array('after' => $m['url_filter'], 'value' => $urlFilterTemplate));
		echo $this->Form->input('text_filter', array('after' => $m['text_filter'], 'value' => $textFilterTemplate));
		echo $this->Form->input('parse_block_filter', array('after' => $m['parse_block_filter'], 'value' => $parseBlockTemplate));
	?>
	</div>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('View Crawl', true), array('controller' => 'crawls', 'action' => 'view', $crawl['Crawl']['id'])); ?> </li>
	</ul>
</div>

<script type="text/javascript">
if (typeof $ != "undefined") {
	$('#CrawlFilterFilterMode').on('change', function() {
	  $('.filter-mode').hide();
	  if (this.value == 'BASIC') {
	    $('.filter-mode.basic').show();
	  }
	  else {
	    $('.filter-mode.advanced').show();
	  }
	});
}
</script>
