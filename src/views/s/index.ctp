<?php
    $debug = false;
    $this->layout = 'slim';
?>

<style>
    .docs dl {
        width: 90%
    }

    .search div.input {
        width: 600px;
        text-align: right;
        margin: 0;
    }

    .search div.input input[type=text] {
        height: 40px;
        line-height: 40px;
    }

    .search div.submit {
        width: 100px;
        margin: 0;
    }
</style>

<form method="get" action="s">
    <div class="search cl">
        <div class="input z">
        	<input type="text" name="w" value="<?=$w?>">
        	<input type="hidden" name="fmt" value="html">
        </div>
        <div class="submit z"><input value="搜索" type="submit"></div>
    </div>
</form>

<div class="docs index">
    <?php $i = 0; ?>
    <?php foreach ($providers as $provider) : ?>
	<h2>数据引擎 － <?=$provider ?></h2>

    <?php if ($provider == 'warpspeed') : ?>
    <div>
    	<p>
    	<?php
    	$this->Paginator->options(array('url' => ["?" => "w=$w"]));

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
