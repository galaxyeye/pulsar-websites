<div class="crawlFilters form auto-validate movable">
<?php echo $this->Form->create('CrawlFilter');?>
	<fieldset>
 		<legend>
	 		<?php __('Edit Crawl Filter'); ?>
 			<?php echo " For " ?>
 			<?php echo $this->Html->link($this->data['Crawl']['name'],
 					array('controller' => 'crawls', 'action' => 'view', $this->data['Crawl']['id'])); ?>
 		</legend>
	<?php 
	  $filterMode = array('BASIC', 'ADVANCED');
	  $filterMode = array_combine($filterMode, $filterMode);

	  $m = [
	  		'filter_mode' => "<p class='m'>过滤器模式：基本模式和高级模式。</p>",
	  		'url_filter' => "<p class='m hidden'>由多行正则表达式来表达的目标url模式，每行一个正则表达式。
	  				<br />正则表达式前可以有前缀'+'或者'-'，前缀'+'可以省略。
	  				<br />前缀'+'表示符合该模式的链接<strong class='red'>需要</strong>被抓取。
	  				<br />前缀'-'表示符合该模式的链接<strong class='red'>不能</strong>被抓取。
	  			</p>",
				'text_filter' => "<p class='m hidden'>由一个json对象定义的页面文本过滤器，请直接修改模板。
	  				<br />留空表示不过滤。
	  			  <br />爬虫在解析页面时，仅页面文本满足该对象指定的四个条件时，该页面内的链接才会被加入到下一轮抓取列表。
	  		  </p>",
				'parse_block_filter' => "<p class='m hidden'>由一个json对象定义的页面区域过滤器，请直接修改模板。
	  				<br />留空表示不过滤。
	  				<br />爬虫在解析页面时，仅allow指定的区域内的链接将会被加入到下一轮抓取列表，
	  			  <br />而disallow指定的区域则不会被加入到下一轮抓取列表。
	  		  </p>"
	  ];

	  echo $this->Form->input('url_filter', array('after' => $m['url_filter']));
	  echo $this->Form->input('text_filter', array('after' => $m['text_filter']));
	  echo $this->Form->input('parse_block_filter', array('after' => $m['parse_block_filter']));
	  echo $this->Form->hidden('crawl_id', array('value' => $this->data['Crawl']['id']));
  ?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('View Crawl', true), array('controller' => 'crawls', 'action' => 'view', $this->data['Crawl']['id'])); ?> </li>
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
