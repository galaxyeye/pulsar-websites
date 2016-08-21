<?php echo $html->script("charts/echarts.common.min"); ?>

<style type="text/css">
    .container { text-align: center;}

    .charts {
        width: 1080px;
        margin: auto;
    }

    .charts .medium-6 .chart {
        width: 500px;
        height: 300px;
    }

    .charts .medium-4 .chart {
        width: 330px;
        height: 300px;
    }

</style>

<div class="charts">
    <div class="row">
        <div class="medium-6 columns">
            <div id="chart-trends" class="chart"></div>
        </div>
        <div class="medium-6 columns">
            <div id="chart-alert" class="chart"></div>
        </div>
    </div>

    <div class="row">
        <div class="medium-4 columns">
            <div id="chart-media-top-n" class="chart"></div>
        </div>
        <div class="medium-4 columns">
            <div id="chart-media-distribution" class="chart"></div>
        </div>
        <div class="medium-4 columns">
            <div id="chart-topics-statistics" class="chart"></div>
        </div>
    </div>
</div>
