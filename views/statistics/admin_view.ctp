<div class="statistics view">
<h2><?php  __('Statistic');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statistic['Statistic']['id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Statistic', true), array('action' => 'edit', $statistic['Statistic']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Statistic', true), array('action' => 'delete', $statistic['Statistic']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $statistic['Statistic']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Statistics', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Statistic', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
