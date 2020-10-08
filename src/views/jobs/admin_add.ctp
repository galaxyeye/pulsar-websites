<div class="jobs form">
    <?php echo $this->Form->create('Job'); ?>
    <fieldset>
        <legend><?php __('Admin Add Job'); ?></legend>
        <?php
        echo $this->Form->input('category');
        echo $this->Form->input('categoryDisplay');
        echo $this->Form->input('title');
        echo $this->Form->input('location');
        echo $this->Form->input('salary');
        echo $this->Form->input('order');
        echo $this->Form->input('duty');
        echo $this->Form->input('condition');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit', true)); ?>
</div>
<div class="actions">
    <h3><?php __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Jobs', true), array('action' => 'index')); ?></li>
    </ul>
</div>