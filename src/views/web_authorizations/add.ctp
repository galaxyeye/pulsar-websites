<div class="webAuthorizations form">
<?php echo $this->Form->create('WebAuthorization');?>
	<fieldset>
 		<legend>
 			<?php __('Add Web Authorization'); ?>
 			<?php echo " For " ?>
 			<?php echo $this->Html->link($crawl['Crawl']['name'], 
 					array('controller' => 'crawls', 'action' => 'view', $crawl['Crawl']['id'])); ?>
 		</legend>
	<?php 
		echo $this->Form->input('login_url');
		echo $this->Form->input('account_css_selector');
		echo $this->Form->input('account');
		echo $this->Form->input('password_css_selector');
		echo $this->Form->input('password_text');
		echo $this->Form->hidden('crawl_id', array('value' => $crawl['Crawl']['id']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
	</ul>
</div>
