<div class="crawlFilters form">
<?php echo $this->Form->create('CrawlFilter');?>
	<fieldset>
 		<legend><?php __('Admin Add Crawl Filter'); ?></legend>
	<?php
		echo $this->Form->input('domain_patterns');
		echo $this->Form->input('url_pattern');
		echo $this->Form->input('text_patterns');
		echo $this->Form->input('crawl_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Crawl Filters', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
	</ul>
</div>