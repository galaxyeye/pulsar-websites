<?php $allStatus = ['CREATED' => '新创建', 'RUNNING' => '运行中', 'PAUSED' => '已暂停', 'STOPPED' => '已停止']; ?>

<div class="topics form">
    <?php echo $this->Form->create('Topic'); ?>
    <fieldset>
        <legend><?php __('Edit Topic'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('category');
        echo $this->Form->input('name');
        echo $this->Form->input('expression', ['rows' => 20]);
        echo $this->Form->input('status', ['options' => $allStatus]);
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>

<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('View Topic', true), array('action' => 'view', $this->Form->value('Topic.id'))); ?> </li>
        <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Topic.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Topic.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Topics', true), array('action' => 'index')); ?></li>
    </ul>
</div>
