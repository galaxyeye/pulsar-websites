<div class="dashboards view">
<h2><?php  __('Dashboard');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $dashboard['Dashboard']['id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Dashboard', true), array('action' => 'edit', $dashboard['Dashboard']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Dashboard', true), array('action' => 'delete', $dashboard['Dashboard']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $dashboard['Dashboard']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Dashboards', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Dashboard', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
