<?php
$topicId = $topic['Topic']['id'];
$solrUrl = $header['request']['url'];

$alertLevelOptions = ['预警级别', '一级', '二级', '三级', '四级', '全部预警', '无预警'];
$sentimentOptions = ['正负面', '全部', '正面', '负面', '中性'];
$resourceCategoryOptions = ['资源类型', '全部', '资讯', '论坛', '贴吧', '博客', '微博', '微信'];

$alertLevelOptions = array_combine($alertLevelOptions, $alertLevelOptions);
$sentimentOptions = array_combine($sentimentOptions, $sentimentOptions);
$resourceCategoryOptions = array_combine($resourceCategoryOptions, $resourceCategoryOptions);
?>

<script type="text/javascript">
    var topicId = <?=$topicId ?>;
    var docCount = <?=count($docs) ?>;
    var queryAction = "monitor";
</script>

<nav class="two columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><a>日常监测</a></li>
        <li><?= $this->Html->link("所有主题", ['action' => 'monitor', 0]) ?></li>
        <?php foreach ($topics as $t) : ?>
            <li><?= $this->Html->link($t['Topic']['name'], ['action' => 'monitor', $t['Topic']['id']]) ?></li>
        <?php endforeach ?>
        <li class="heading"><a>话题追踪</a></li>
        <li class="heading"><a>评论分析</a></li>
        <li class="heading"><a>风险人群</a></li>
        <li class="heading"><a>收藏夹</a></li>
    </ul>
</nav>

<div class="topics ten columns content">
    <div class="actions">
        <div class="head cl">
            <div class="columns"><h2><?php echo $topic['Topic']['name'] ?></h2></div>
            <div class="sub-nav two columns">
                <a class="selected">数据</a>
                <?= $this->Html->link("统计", ['action' => 'stat', $topicId]) ?>
                <?= $this->Html->link("报告", ['action' => 'report', $topicId]) ?>
            </div>
            <div class="column"></div>
        </div>
        <div class="filter datetime cl">
            <div class="columns">
                <span>时间：</span>
                <a class="date today" data-start-date="NOW/DAY" data-end-date="NOW">今天</a>
                <a class="date yesterday" data-start-date="NOW/DAY-1DAY" data-end-date="NOW/DAY">昨天</a>
                <a class="date last-7-days" data-start-date="NOW/DAY-7DAY" data-end-date="NOW">最近七天</a>
                <a class="date last-30-days selected" data-start-date="NOW/DAY-30DAY" data-end-date="NOW">最近30天</a>
                <input type="text" id="dateFrom" name="dateFrom" />
                <input type="text" id="dateTo" name="dateTo" />
            </div>
            <div class="one column"><button class="submit">确定</button></div>
            <div class="columns"></div>
        </div>
        <div class="filter misc cl">
            <?php echo $this->Form->input('Filter.alertLevel', ['label' => '', 'div' => 'one column', 'options' => $alertLevelOptions]); ?>
            <?php echo $this->Form->input('Filter.sentiment', ['label' => '', 'div' => 'one column', 'options' => $sentimentOptions]); ?>
            <?php echo $this->Form->input('Filter.resource_category', ['label' => '', 'div' => 'one column', 'options' => $resourceCategoryOptions]); ?>
            <?php echo $this->Form->input('Filter.source_site', ['label' => '', 'value' => '来源', 'div' => 'one column']); ?>
            <?php echo $this->Form->input('Filter.author', ['label' => '', 'value' => '作者', 'div' => 'one column']); ?>
            <div class="columns"></div>
        </div>
    </div>
    <div class="doc-list-actions cl">
        <div class="eight columns">
            <a class="button markRead">标已读</a>
            <a class="button download">下载</a>
            <a class="button keep">收藏</a>
            <a class="button cancelKeep">取消收藏</a>
            <a class="button sendEmail">邮件</a>
            <a class="button deleteRecord">删除</a>
        </div>
        <div class="show-mode two columns">
            <a class="show-list">列表</a> | <a class="show-abstract">摘要</a>
        </div>
    </div>

    <div class="doc-list">
        <div id="reloadableArea">
            <div class="debug message solr-query"><?php echo(urldecode($solrUrl)) ?></div>

            <div class="paginator">
                <p>
                    <?php
                    echo $this->Paginator->counter(['format' => '当前第%page%页，共计%pages%页， 显示 %current% 条数据， 共计%count%条数据']);
                    ?>
                </p>
            </div>

            <table cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th>
                        <?php echo $this->Form->input('doc.selectAll', ['class' => 'select select_all', 'label' => '', 'div' => '', 'type' => 'checkbox']); ?>
                    </th>
                    <th>预警</th>
                    <th>正负</th>
                    <th style="width:30em;">标题</th>
                    <th class="hidden">内容</th>
                    <th>发布时间</th>
                    <th>采集时间</th>
                    <th>来源</th>
                    <th>作者</th>
                    <th>相似数据</th>
                    <th>点击转发</th>
                    <th>评论</th>
                    <th class="actions">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 0;
                foreach ($docs as $doc):
                    ++$i;
                    ?>
                    <?php if ($doc['provider'] === 'warpspeed') : ?>
                    <tr>
                        <td class="w_1em">
                            <?php echo $this->Form->input('doc.select'.$i, ['class' => 'select select_'.$i, 'label' => '', 'div' => '', 'type' => 'checkbox']); ?>
                            <span class="hidden data" data-solr-id="<?=$doc['solr_id'] ?>"></span>
                        </td>
                        <td class="w_1em"><?= $doc['alert'] ?></td>
                        <td class="w_1em"><?= $doc['sentiment'] ?></td>
                        <td class="article-title w_30em">
                            <?= $this->Html->link($doc['title'],
                                ['action' => 'quickView', $topicId, symmetric_encode($doc['id'])],
                                ['escape' => false, 'target' => '_blank'])
                            ?>
                        </td>
                        <td class="abstract hidden w_60em"><?=$doc['abstract'] ?></td>
                        <td><?= $doc['publish_time_str'] ?></td>
                        <td><?= date_format($doc['last_crawl_time'], "Y-m-d H:i:s") ?></td>
                        <td><?= $doc['site_name'] ?></td>
                        <td><?= $doc['author'] ?></td>
                        <td><?= $doc['similar_data'] ?></td>
                        <td class="w_1em"><?= $doc['click_forward'] ?></td>
                        <td class="w_1em"><?= $doc['comment_count'] ?></td>
                        <td class="actions">
                            <ul class="ui-widget ui-helper-clearfix">
                                <li class="ui-state-default ui-corner-all">
                                    <a class="keep ui-icon ui-icon ui-icon-flag" title="传播路径" target="_blank"
                                       href="<?=Router::url(['action' => 'transmissionPath', $topicId, symmetric_encode($doc['id'])]) ?>">&nbsp;</a>
                                </li>
                                <li class="ui-state-default ui-corner-all">
                                    <a class="keep ui-icon ui-icon ui-icon-extlink" title="转载态势" target="_blank"
                                       href="<?=Router::url(['action' => 'forwardChart', $topicId, symmetric_encode($doc['id'])]) ?>">&nbsp;</a>
                                </li>
                                <li class="ui-state-default ui-corner-all"><a class="keep ui-icon ui-icon-heart" title="收藏">&nbsp;</a></li>
                                <li class="ui-state-default ui-corner-all"><a class="delete ui-icon ui-icon-closethick" title="删除">&nbsp;</a></li>
                            </ul>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>

            <div class="paginator">
                <p>
                    <?php
                    echo $this->Paginator->counter(['format' => '当前第%page%页，共计%pages%页， 显示 %current% 条数据， 共计%count%条数据']);
                    ?>
                </p>

                <div class="paging">
                    <?php echo $this->Paginator->prev('<< ' . "上一页", [], null, array('class'=>'disabled'));?>
                    | 	<?php echo $this->Paginator->numbers();?>
                    |
                    <?php echo $this->Paginator->next("下一页" . ' >>', [], null, array('class' => 'disabled'));?>
                </div>
            </div>
        </div>
    </div>

    <br />
    <hr />

    <h3>以下内容来自百度</h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th>标题</th>
            <th>内容</th>
            <th class="actions">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($docs as $doc): ?>
            <?php if ($doc['provider'] === 'baidu') : ?>
            <tr>
                <td><?= $doc['title'] ?></td>
                <td><?= $doc['shortContent'] ?></td>
                <td class="actions">
                    <?= $this->Html->link("快照", ['action' => 'quickView', $topicId, symmetric_encode($doc['url'])]) ?>
                </td>
            </tr>
            <?php endif ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
