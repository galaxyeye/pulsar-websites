<?php
    $this->layout = 'slim';
?>

<style>
    .docs dl {
        width: 90%
    }

    .search {
        position: relative;
    }

    .search div.input {
        margin: 0;
    }

    .search div.submit {
        clear: none;
    }

    .search div.input.radio {
        text-align: left;
    }

    .search div.input.radio input {
        margin: 0;
        padding: 0;
    }

    .search div.input input[type=text] {
        height: 40px;
        line-height: 40px;
    }

    div.tip {
        line-height: 30px;
        margin-left: 14px;
    }

    .docs textarea {
        width: 80em;
    }
</style>

<?php 
    $solrCollections = ['novel_native_0808' => '小说（beta）', 'information_native_0724' => '媒体（beta）'];
    $debugQuerySwithes = ['off' => '不启用调试', 'on' => '启用调试'];
?>

<form method="get" action="/q">
    <div class="search clearfix">
    	<div class="text input four columns">
    		<input type="text" name="w" value="<?=$w?>">
	    	<input type="hidden" name="fmt" value="html">
    	</div>
        <div class="one columns input submit">
        	<input value="搜索" type="submit">
        </div>
    	<?= $this->Form->input('sc', ['name' => 'sc', 'options' => $solrCollections,
    	        'default' => $sc, 'type' => 'radio', 'div' => 'two columns input radio']) ?>
    	<?= $this->Form->input('debugQuery', ['name' => 'debugQuery', 'options' => $debugQuerySwithes,
    	        'default' => $debugQuery, 'type' => 'radio', 'div' => 'two columns input radio']) ?>
        <div class="one columns input submit">&nbsp;</div>
    </div>
    <div class='tip small'>提示：关键词加引号强制完全匹配。如：输入<em>"李鸿章"</em>（带引号）<em>李鸿章</em>（不带引号）匹配结果更好。</div>
</form>

<?php if ($debugQuery == 'on') : ?>
<div class='message'>
	<?php 
	   $url = $header['request']['url'];
	   $url = str_replace("http://master:", "http://qiwur.com:", $url);
	?>
	<span>调试信息</span>
	<a href="<?= $url ?>" target="_blank"><?= $url ?></a>
</div>
<?php endif; ?>

<div class="docs index">
    <?php $i = 0; ?>

    <div>
    	<p>
    	<?php 
    	// $this->Paginator->options(['url' => array_merge($this->passedArgs, ["?" => "w=$w"])]);
    	// $this->Paginator->options(['url' => array_merge($this->passedArgs, ["?" => "w=$w"])]);

    	echo $this->Paginator->counter([
    	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    	]);
    	?>	</p>

    	<div class="paging">
    		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
    	 | 	<?php echo $this->Paginator->numbers();?>
     |
    		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
    	</div>
    </div>

    <br />

    <?php foreach ($docs as $doc): ?>
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
            <dt<?php if ($i % 2 == 0) echo $class ?>>链接</dt>
            <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                <?php echo $this->Html->link($doc['url'], $doc['url'], ['target' => '_blank']) ?>
                &nbsp;
            </dd>
            <?php if ($debugQuery == 'on') : ?>
                <dt<?php if ($i % 2 == 0) echo $class ?>>调试信息</dt>
                <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                    <textarea rows="20"><?= json_encode($doc, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) ?></textarea>
                    &nbsp;
                </dd>
            <?php endif; ?>
        </dl>
    </div>
    <?php endforeach; ?>
</div>
