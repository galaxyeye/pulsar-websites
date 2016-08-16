<?php $this->layout = 'slim'; ?>

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
    
    .match { border : 1px solid green; }
</style>

<form method="get" action="q">
    <div class="search cl">
        <div class="input z">
        	<input type="text" name="w" value="<?=$w?>">
        	<input type="hidden" name="fmt" value="html">
        </div>
        <div class="submit z"><input value="搜索" type="submit"></div>
    </div>
</form>

<div class="docs index">
    <table cellpadding="0" cellspacing="0">
        <?php $i = 0;
        foreach ($docs as $doc): ?>
            <div class="doc<?=$doc['match'] ? " match" : "" ?>" >
                <dl><?php $i = 0;
                    $class = ' class="altrow"' ?>
                    <dt<?php if ($i % 2 == 0) echo $class ?>>Url</dt>
                    <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                        <?php echo $this->Html->link($doc['url'], $doc['url'], ['target' => '_blank']) ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0) echo $class ?>>Domain</dt>
                    <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                        <?php echo $doc['domain']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0) echo $class ?>>Title</dt>
                    <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                        <?php echo $doc['title']; ?>
                        &nbsp;
                    </dd>
                    <dt<?php if ($i % 2 == 0) echo $class ?>>Content</dt>
                    <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                        <?php echo $doc['shortContent']; ?>
                        &nbsp;
                    </dd>
                </dl>
            </div>
            <hr/>
        <?php endforeach; ?>
    </table>
</div>
