<div class="monitorTasks form">
    <?php echo $this->Form->create('MonitorTask'); ?>
    <fieldset>
        <legend><?php __('Add Monitor Task'); ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('expression');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>

<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('List Monitor Tasks', true), array('action' => 'index')); ?></li>
    </ul>
</div>
