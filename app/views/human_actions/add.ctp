<div class="humanActions form auto-validate">
<?php echo $this->Form->create('HumanAction');?>
	<fieldset>
 		<legend>
 			<?php __('Add Crawl Filter'); ?>
 			<?php echo " For " ?>
 			<?php echo $this->Html->link($crawl['Crawl']['name'],
 					array('controller' => 'crawls', 'action' => 'view', $crawl['Crawl']['id'])); ?>
 		</legend>
	<?php 
		global $jsEvents;

		$orders = array_combine(range(1, 10), range(1, 10));

		$m = array(
				'order' => "<p class='m'>Event tragger order in the event chain, calculated by default</p>",
				'css_path' => "<p class='m'>Specify the element to tragger the event</p>",
				'action' => "<p class='m'>Event tragger order</p>",
				'keyCode' => "<p class='m'>Specify only for keyboard events</p>"
		);

	  echo $this->Form->input('order', array('options' => $orders, 'value' => $maxOrder, 'after' => $m['order']));
		echo $this->Form->input('css_path', array('after' => $m['css_path']));
		echo $this->Form->input('action', array('options' => array_combine($jsEvents, $jsEvents), 'default' => 'click', 'after' => $m['action']));
		echo $this->Form->input('keyCode', array('maxLength' => 1, 'after' => $m['keyCode']));
		// echo $this->Form->input('script');
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
