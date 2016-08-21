<?php $debug = false; ?>

<?php echo $this->element('search_syntax_help') ?>

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
    <?php $i = 0; ?>
    <?php foreach ($providers as $provider) : ?>
	<h2>数据引擎 － <?=$provider ?></h2>

    <?php if ($provider == 'warpspeed') : ?>
    <div>
    	<p>
    	<?php
    	echo $this->Paginator->counter(array(
    	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    	));
    	?>	</p>
    
    	<div class="paging">
    		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
    	 | 	<?php echo $this->Paginator->numbers();?>
     |
    		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    	</div>
    </div>
    <?php endif; ?>
    
    <br />
    
    <?php foreach ($docs as $doc): ?>
    <?php if ($doc['provider'] == $provider) : ?>
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
    <?php endif; ?>
    <?php endforeach; ?>
    <br />
    <br />
    <?php endforeach; ?>
</div>
