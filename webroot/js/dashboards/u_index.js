// 基于准备好的dom，初始化echarts实例
var chartTrends = echarts.init(document.getElementById('chart-trends'));
var chartAlert = echarts.init(document.getElementById('chart-alert'));
var chartMediaTopN = echarts.init(document.getElementById('chart-media-top-n'));
var chartMediaDistribution = echarts.init(document.getElementById('chart-media-distribution'));
var chartTopicsStatistics = echarts.init(document.getElementById('chart-topics-statistics'));

var optionTrends = {
    title: {
        text: '舆情态势'
    },
    tooltip: {
        trigger: 'axis'
    },
    toolbox: {
        show: true,
        feature: {
            magicType: {show: true, type: ['stack', 'tiled']},
            saveAsImage: {show: true}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: [ '00', '01', '02', '03', '04', '05', '06', '07', '08', '09',
                '10', '11', '12', '13', '14', '15', '16', '17', '18', '19',
                '20', '21', '22']
    },
    yAxis: {
        type: 'value'
    },
    series: [{
        name: '统计',
        type: 'line',
        smooth: true,
        data: [ '92', '98', '83', '89', '94', '100', '150', '179', '160', '150',
            '120', '100', '120', '150', '168', '149', '120', '100', '98', '83',
            '69', '79', '58']
    }]
};

var optionAlert = {
    title: {
        text: '预警',
        subtext: '舆情预警'
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        data: ['按时间', '按等级']
    },
    toolbox: {
        show: true,
        feature: {
            magicType: {show: true, type: ['stack', 'tiled']},
            saveAsImage: {show: true}
        }
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: ['周一', '周二', '周三', '周四', '周五', '周六', '周日']
    },
    yAxis: {
        type: 'value'
    },
    series: [{
        name: '成交',
        type: 'line',
        smooth: true,
        data: [10, 12, 21, 54, 260, 830, 710]
    },
        {
            name: '预购',
            type: 'line',
            smooth: true,
            data: [30, 182, 434, 791, 390, 30, 10]
        },
        {
            name: '意向',
            type: 'line',
            smooth: true,
            data: [1320, 1132, 601, 234, 120, 90, 20]
        }]
};

var optionMediaTopN = {
    title: {
        text: 'TOP5媒体'
    },
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'shadow'
        }
    },
    legend: {
        data: ['正面', '中性', '负面']
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    xAxis: {
        type: 'value',
        boundaryGap: [0, 0.01]
    },
    yAxis: {
        type: 'category',
        data: ['新浪微博', '腾讯微信', '新浪博客', '微头条', '百度贴吧']
    },
    series: [
        {
            type: 'bar',
            data: [20, 115, 180, 134, 90]
        }
    ]
};

var optionMediaDistribution = {
    title: {
        text: '资源类型分布'
    },

    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },

    visualMap: {
        show: false,
        min: 80,
        max: 600,
        inRange: {
            colorLightness: [0, 1]
        }
    },
    series: [{
        name: '新浪微博',
        type:'pie',
        radius : '55%',
        center: ['50%', '50%'],
        data:[
            {value:335, name:'微博'},
            {value:310, name:'博客'},
            {value:274, name:'资讯'},
            {value:235, name:'论坛'},
            {value:400, name:'贴吧'}
        ].sort(function (a, b) { return a.value - b.value})
        }
    ]
};

var optionTopicsStatistics = {
    title: {
        text: '标签统计'
    },
    color: ['#3398DB'],
    tooltip : {
        trigger: 'axis',
        axisPointer : {            // 坐标轴指示器，坐标轴触发有效
            type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
        }
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    xAxis : [
        {
            type : 'category',
            data : ['领导动向', '突发事件', '侨情', '负面报道', '山西省突发事件', '天涯论坛突发事件', '国务院领导动向'],
            axisTick: {
            }
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'直接访问',
            type:'bar',
            barWidth: '60%',
            data:[10, 52, 200, 334, 390, 330, 220]
        }
    ]
};

// 使用刚指定的配置项和数据显示图表。
chartTrends.setOption(optionTrends);
chartAlert.setOption(optionAlert);
chartMediaTopN.setOption(optionMediaTopN);
chartMediaDistribution.setOption(optionMediaDistribution);
chartTopicsStatistics.setOption(optionTopicsStatistics);
