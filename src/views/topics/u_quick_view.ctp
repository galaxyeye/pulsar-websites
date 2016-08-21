<div class="topics view">
<h2><?php  __('Topic');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<a href="<?=$url ?>" target="_blank"><?=$url ?></a>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?= $topic['Topic']['category']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?= $topic['Topic']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Expression'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<pre><?= $topic['Topic']['expression']; ?></pre>
			&nbsp;
		</dd>
	</dl>
</div>

<div>
	<?=$quickView ?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Topic', true), array('action' => 'edit', $topic['Topic']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Topic', true), array('action' => 'delete', $topic['Topic']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $topic['Topic']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Topics', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Topic', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
