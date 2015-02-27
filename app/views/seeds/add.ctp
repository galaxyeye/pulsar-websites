<div class="seeds form auto-validate">
<?php echo $this->Form->create('Seed', array('type' => 'file'));?>
	<fieldset>
 		<legend><?php __('Add Seed'); ?>
 			<?php echo " For " ?>
 			<?php echo $this->Html->link($crawl['Crawl']['name'], 
 					array('controller' => 'crawls', 'action' => 'view', $crawl['Crawl']['id'])); ?>
 		</legend>
	<?php 
	  $m = array('url' => "<p class='m'>You can add multiple urls one time, one url per line.
		  <br />Urls must start with 'http'</p>");

		echo $this->Form->input('url', array('type' => 'textarea', 'after' => $m['url']));
		// echo "<div><span class='red larger'>OR</span> you can upload a file contains seed urls, one url per line, '#' to comment a line</div>";
		// echo $this->Form->input('seed_file', array('type' => 'file'));
		echo $this->Form->hidden('crawl_id', array('value' => $crawl['Crawl']['id']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('View Crawl', true), array('controller' => 'crawls', 'action' => 'view', $crawl['Crawl']['id'])); ?> </li>
	</ul>
</div>
