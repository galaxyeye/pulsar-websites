<?php echo $this->element('jobs/subnav') ?>

<hr/>

<div class="horizon-nav2">
    <ul>
        <li><?= $this->Html->link(__('List Active Jobs', true), array('action' => 'activeJobs')); ?> </li>
        <li><?= $this->Html->link(__('List Active Jobs（Plain View）', true), array('action' => 'plainActiveJobs')); ?> </li>
    </ul>
</div>

<div class="horizon-nav2">
    <ul>
        <li><?php echo $this->Html->link(__('Nutch Admin', true), NUTCH_SERVER . '/admin', ['target' => '_blank']) ?></li>
        <li><?php echo $this->Html->link(__('Fetcher Server List', true), NUTCH_SERVER . '/service?type=FetcherServer', ['target' => '_blank']) ?></li>
    </ul>
</div>

<br/>

<div class="nutchJobs index">
    <h2><?php __('Nutch Jobs'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('crawl_id'); ?></th>
            <th><?php echo $this->Paginator->sort('round'); ?></th>
            <th><?php echo $this->Paginator->sort('crawlId'); ?></th>
            <th><?php echo $this->Paginator->sort('confId'); ?></th>
            <th><?php echo $this->Paginator->sort('batchId'); ?></th>
            <th><?php echo $this->Paginator->sort('jobId'); ?></th>
            <th><?php echo $this->Paginator->sort('type'); ?></th>
            <th><?php echo $this->Paginator->sort('state'); ?></th>
            <th><?php echo $this->Paginator->sort('fetched_pages'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th class="actions"><?php __('Actions'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($nutchJobs as $nutchJob):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>
            <tr<?php echo $class; ?>>
                <td><?= $nutchJob['NutchJob']['id']; ?>&nbsp;</td>
                <td><?= $this->Html->link($nutchJob['NutchJob']['crawl_id'],
                        ['controller' => 'crawls', 'action' => 'view', $nutchJob['NutchJob']['crawl_id']], ['target' => '_blank']); ?>
                <td><?= $nutchJob['NutchJob']['round']; ?>&nbsp;</td>
                <td><?= $nutchJob['NutchJob']['crawlId']; ?>&nbsp;</td>
                <td><?= $nutchJob['NutchJob']['confId']; ?>&nbsp;</td>
                <td><?= $nutchJob['NutchJob']['batchId']; ?>&nbsp;</td>
                <td><?= $nutchJob['NutchJob']['jobId']; ?>&nbsp;</td>
                <td><?= $nutchJob['NutchJob']['type']; ?>&nbsp;</td>
                <td><?= $nutchJob['NutchJob']['state']; ?>&nbsp;</td>
                <td><?= $nutchJob['NutchJob']['count']; ?>&nbsp;</td>
                <td><?= $nutchJob['NutchJob']['created']; ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View', true),
                        ['action' => 'view', $nutchJob['NutchJob']['id']], ['target' => 'layer']); ?>
                    <?php if(in_array($nutchJob['NutchJob']['state'], ["COMPLETED", "FAILED_COMPLETED"])) : ?>
                    <?php echo $this->Html->link(__('Resume', true), ['action' => 'resume', $nutchJob['Crawl']['id']]); ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
        ));
        ?>    </p>

    <div class="paging">
        <?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class' => 'disabled')); ?>
        | <?php echo $this->Paginator->numbers(); ?>
        |
        <?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
    </div>
</div>

<div class="actions">
    <ul>
        <li><?= $this->Html->link(__('List Nutch Jobs', true), array('action' => 'index')); ?> </li>
        <li><?= $this->Html->link(__('List Active Jobs', true), array('action' => 'activeJobs')); ?> </li>
        <li><?= $this->Html->link(__('List Active Jobs（Plain View）', true), array('action' => 'plainActiveJobs')); ?> </li>
    </ul>
</div>
