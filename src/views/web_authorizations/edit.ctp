<div class="webAuthorizations form">
<?php echo $this->Form->create('WebAuthorization');?>
	<fieldset>
 		<legend><?php __('Edit Web Authorization'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('login_url');
		echo $this->Form->input('account');
		echo $this->Form->input('password_text');
		echo $this->Form->input('account_css_selector');
		echo $this->Form->input('password_css_selector');
		echo $this->Form->input('crawl_id');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('WebAuthorization.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('WebAuthorization.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Web Authorizations', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Crawls', true), array('controller' => 'crawls', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Crawl', true), array('controller' => 'crawls', 'action' => 'add')); ?> </li>
	</ul>
</div>