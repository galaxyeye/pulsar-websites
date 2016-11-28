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
    $solrCollections = ['ec_0901' => '电商（beta）'];
    $formats = ['html' => 'html格式', 'json' => 'json格式', 'php' => 'php格式'];
    $debugQuerySwitches = ['off' => '不启用调试', 'on' => '启用调试'];
?>

<form method="get" action="/ec">
    <div class="search cl">
        <div class="text input six columns"></div>
        <?= $this->Form->input('sc', ['name' => 'sc', 'options' => $solrCollections,
    	        'default' => $sc, 'type' => 'radio', 'div' => 'two columns input radio']) ?>
        <?= $this->Form->input('fmt', ['name' => 'fmt', 'options' => $formats,
            'default' => 'html', 'type' => 'radio', 'div' => 'two columns input radio']) ?>
    	<?= $this->Form->input('debugQuery', ['name' => 'debugQuery', 'options' => $debugQuerySwitches,
    	        'default' => $debugQuery, 'type' => 'radio', 'div' => 'two columns input radio']) ?>
    </div>
    <div class="filter cl">
        <div class="one column">时间</div>
        <div class="two columns"><input type="text" id="startTime" name="startTime" /></div>
        <div class="two columns"><input type="text" id="endTime" name="endTime" /></div>
        <div class="column"></div>
    </div>

    <div class="filter cl">
        <div class="one column">价格</div>
        <div class="two columns"><input type="text" name="startPrice" value="0" /></div>
        <div class="two columns"><input type="text" name="endPrice" /></div>
        <div class="column"></div>
    </div>

    <div class="input submit">
        <input value="搜索" type="submit" />
    </div>
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

<div id="reloadableArea" class="docs index">
    <?php $i = 0; ?>

    <div>
    	<p>
    	<?php 
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
    <?php
        $defaults = [
            'title' => [],
            'price' => '',
            'cat' => '',
            'promotion' => [],
            'features' => [],
            'url' => ''
        ];
        $comment = array_merge($defaults, $doc);
    ?>
    <div class="doc product">
        <h2><?=$doc['title'][0]; ?></h2>
        <dl><?php $i = 0;
            $class = ' class="altrow"' ?>
            <dt<?php if ($i % 2 == 0) echo $class ?>>价格</dt>
            <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                ￥<?=$doc['price']; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class ?>>类别</dt>
            <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                <?=$doc['cat'][0]; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class ?>>促销信息</dt>
            <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                <?=$doc['promotion'][0]; ?>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class ?>>商品属性</dt>
            <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                <div><?=$doc['features'][0]; ?></div>
                &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0) echo $class ?>>链接</dt>
            <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                <?=$this->Html->link($doc['url'], $doc['url'], ['target' => '_blank']) ?>
                &nbsp;
            </dd>
            <?php if ($debugQuery == 'on') : ?>
                <dt<?php if ($i % 2 == 0) echo $class ?>>调试信息</dt>
                <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                    <textarea rows="20"><?= json_encode($doc, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) ?></textarea>
                    &nbsp;
                </dd>
            <?php endif; ?>
            <dt<?php if ($i % 2 == 0) echo $class ?>>时间</dt>
            <dd<?php if ($i++ % 2 == 0) echo $class ?>>
                <?php
                $lastModifiedTime = new \DateTime($doc['last_modified'], new \DateTimeZone('UTC'));
                $lastModifiedTime->setTimezone(new \DateTimeZone(CURRENT_TIME_ZONE));
                $lastModifiedTime = date_format($lastModifiedTime, 'Y-m-d H:i:s');
                ?>
                <div><?=$lastModifiedTime; ?></div>
                &nbsp;
            </dd>
        </dl>

        <?php
        $comments = $doc['comments'];
        $j = 0;
        ?>
        <div class="productComments index">
            <h3>用户评论</h3>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th>编号</th>
                    <th>产品规格</th>
                    <th>评论内容</th>
                    <th>用户名</th>
                    <th>用户级别</th>
                    <th>用户区域</th>
                    <th>评论时间</th>
                    <th>客户端</th>
                </tr>
                <?php
                $i = 0;
                foreach ($comments as $comment):
                    $defaults = [
                        'comment_product_type' => '',
                        'comment_comment' => '',
                        'comment_user_name' => '',
                        'comment_user_level' => '',
                        'comment_user_district' => '',
                        'comment_user_device' => ''
                    ];
                    $comment = array_merge($defaults, $comment);
                    $class = null;
                    if ($i++ % 2 == 0) {
                        $class = ' class="altrow"';
                    }
                    ?>
                    <tr<?php echo $class;?>>
                        <td><?=++$j ?>&nbsp;</td>
                        <td><?=$comment['comment_product_type'] ?>&nbsp;</td>
                        <td><?=$comment['comment_comment'] ?>&nbsp;</td>
                        <td><?=$comment['comment_user_name'] ?>&nbsp;</td>
                        <td><?=$comment['comment_user_level'] ?>&nbsp;</td>
                        <td><?=$comment['comment_user_district'] ?>&nbsp;</td>
                        <td><?=$comment['comment_time_s'] ?>&nbsp;</td>
                        <td><?=$comment['comment_user_device'] ?>&nbsp;</td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <br />
    <br />
    <hr />
    <?php endforeach; ?>
</div>
