<?php $debug = false; ?>

<div class="monitorTasks view">
    <h2><?php __('Monitor Task'); ?></h2>
    <dl><?php $i = 0;
        $class = ' class="altrow"'; ?>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __('Id'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $monitorTask['MonitorTask']['id']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __('Name'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $monitorTask['MonitorTask']['name']; ?>
            &nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class; ?>><?php __('Expression'); ?></dt>
        <dd<?php if ($i++ % 2 == 0) echo $class; ?>>
            <?php echo $monitorTask['MonitorTask']['expression']; ?>
            &nbsp;
        </dd>
    </dl>
</div>

<br/>

<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Edit Monitor Task', true), array('action' => 'edit', $monitorTask['MonitorTask']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('Delete Monitor Task', true), array('action' => 'delete', $monitorTask['MonitorTask']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $monitorTask['MonitorTask']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Monitor Tasks', true), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Monitor Task', true), array('action' => 'add')); ?> </li>
    </ul>
</div>

<br/>

<div class="docs index">
    <table cellpadding="0" cellspacing="0">
        <?php $i = 0;
        foreach ($docs as $doc): ?>
            <div class="doc">
                <dl><?php $i = 0;
                    $class = ' class="altrow"' ?>
                    <dt<?php if ($i % 2 == 0) echo $class ?>>标题</dt>
                    <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                        <?php echo $doc['title']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0) echo $class ?>>内容</dt>
                    <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                        <?php echo $doc['shortContent']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0) echo $class ?>>来源</dt>
                    <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                        <?php echo $doc['provider']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0) echo $class ?>>链接</dt>
                    <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                        <?php echo $this->Html->link($doc['url'], $doc['url'], ['target' => '_blank']) ?>
                        &nbsp;
                    </dd>
                    <?php if ($debug) : ?>
                        <dt<?php if ($i % 2 == 0) echo $class ?>>调试信息</dt>
                        <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                            <pre><?php // echo json_encode($doc, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) ?></pre>
                            &nbsp;
                        </dd>
                    <?php endif; ?>
                </dl>
            </div>
            <hr/>
        <?php endforeach; ?>
    </table>
</div>
