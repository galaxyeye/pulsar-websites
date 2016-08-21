<?php echo $this->element('search_syntax_help') ?>

<div class="monitorTasks form">
    <?php echo $this->Form->create('MonitorTask'); ?>
    <fieldset>
        <legend><?php __('Edit Monitor Task'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('name');
        echo $this->Form->input('expression');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>

<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('MonitorTask.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('MonitorTask.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Monitor Tasks', true), array('action' => 'index')); ?></li>
    </ul>
</div>