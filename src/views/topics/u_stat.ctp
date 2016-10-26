<?php echo $html->script("charts/echarts.common.min"); ?>

<style type="text/css">
    .charts {
        width: 1080px;
        text-align: center;
    }

    .charts .chart {
        width: 1080px;
        height: 400px;
    }
</style>

<nav class="two columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><a>日常监测</a></li>
        <?php foreach ($topics as $t) : ?>
            <li><?= $this->Html->link($t['Topic']['name'], ['action' => 'stat', $t['Topic']['id']]) ?></li>
        <?php endforeach ?>
        <li class="heading"><a>话题追踪</a></li>
        <li class="heading"><a>评论分析</a></li>
        <li class="heading"><a>风险人群</a></li>
        <li class="heading"><a>收藏夹</a></li>
    </ul>
</nav>

<?php
$topicId = $topic['Topic']['id'];
$statQuery = "last_crawl_time:[NOW/DAY-30DAYS TO NOW]";
?>

<script type="text/javascript">
    var topicId = <?=$topicId ?>;
    var statQuery = "<?=$statQuery ?>";
    var xdata = <?=json_encode($xdata) ?>;
    var ydata = <?=json_encode($ydata) ?>;
</script>

<div class="topics ten columns content">
    <div class="actions">
        <div class="head cl">
            <div class="columns"><h2><?php echo $topic['Topic']['name'] ?></h2></div>
            <div class="sub-nav two columns">
                <?= $this->Html->link("数据", ['action' => 'monitor', $topicId]) ?>
                <a style="background: darkblue; padding: 3px; color: white">统计</a>
                <?= $this->Html->link("报告", ['action' => 'report', $topicId]) ?>
            </div>
            <div class="column"></div>
        </div>
        <div class="filter datetime cl">
            <div class="columns">
                <span>时间：</span>
                <?= $this->Html->link("今天", ['action' => 'monitor', $topicId, symmetric_encode("last_crawl_time:[NOW/DAY TO NOW]")]) ?> |
                <?= $this->Html->link("昨天", ['action' => 'monitor', $topicId, symmetric_encode("last_crawl_time:[NOW-1DAY/DAY TO NOW/DAY]")]) ?> |
                <?= $this->Html->link("最近七天", ['action' => 'monitor', $topicId, symmetric_encode("last_crawl_time:[NOW/DAY-7DAY TO NOW]")]) ?>
                <input type="text" id="dateFrom" name="dateFrom" />
                <input type="text" id="dateTo" name="dateTo" />
            </div>
            <div class="one column"><button class="submit">确定</button></div>
            <div class="column"></div>
        </div>
        <hr />
        <div class="filter misc cl">
            <?php
            $alertLevelOptions = ['预警级别', '一级', '二级', '三级', '四级', '全部预警', '无预警'];
            $sentimentOptions = ['正负面', '全部', '正面', '负面', '中性'];
            $resourceCategoryOptions = ['资源类型', '全部', '资讯', '论坛', '贴吧', '博客', '微博', '微信'];
            $chartType = ['曝光量趋势', '资源类型统计', '资源类型分类统计', '正负面统计', '预警报告', '焦点聚类', '热点话题', '标签对比'];

            $alertLevelOptions = array_combine($alertLevelOptions, $alertLevelOptions);
            $sentimentOptions = array_combine($sentimentOptions, $sentimentOptions);
            $resourceCategoryOptions = array_combine($resourceCategoryOptions, $resourceCategoryOptions);
            $chartType = array_combine($chartType, $chartType);
            ?>
            <?php echo $this->Form->input('Filter.alertLevel', ['label' => '', 'div' => 'one column', 'options' => $alertLevelOptions]); ?>
            <?php echo $this->Form->input('Filter.sentiment', ['label' => '', 'div' => 'one column', 'options' => $sentimentOptions]); ?>
            <?php echo $this->Form->input('Filter.resource_category', ['label' => '', 'div' => 'one column', 'options' => $resourceCategoryOptions]); ?>
            <?php echo $this->Form->input('Filter.source_site', ['label' => '', 'value' => '来源', 'div' => 'one column']); ?>
            <?php echo $this->Form->input('Filter.author', ['label' => '', 'value' => '作者', 'div' => 'one column']); ?>
            <?php echo $this->Form->input('Filter.statType', ['label' => '', 'div' => 'columns select', 'options' => $chartType]); ?>
        </div>
    </div>

    <div class="message"></div>

    <div class="charts">
        <div id="chart-trends" class="chart"></div>
    </div>

    <br />
    <hr />
</div>
