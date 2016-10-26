// 基于准备好的dom，初始化echarts实例
var chartTrends = echarts.init(document.getElementById('chart-trends'));

var xAxisData = [ '00', '01', '02', '03', '04', '05', '06', '07', '08', '09',
    '10', '11', '12', '13', '14', '15', '16', '17', '18', '19',
    '20', '21', '22'];

var yAxisData = [ '92', '98', '83', '89', '94', '100', '150', '179', '160', '150',
    '120', '100', '120', '150', '168', '149', '120', '100', '98', '83',
    '69', '79', '58'];

if (xdata) {
    xAxisData = xdata;
}

if (ydata) {
    yAxisData = ydata;
}

var statTrends = {
    title: {
        text: '曝光量趋势'
    },
    tooltip: {
        trigger: 'axis'
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: xdata
    },
    yAxis: {
        type: 'value',
        splitArea : {show : true}
    },
    series: [{
        name: '统计',
        type: 'line',
        smooth: true,
        data: ydata,
        itemStyle: {
            normal: {
                label: {
                    show: true
                }
            }
        } // itemStyle
    }]
};

var statAlert = {
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

var statMediaDistribution = {
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

var statTrendsGroupByMedia = {
    title: {
        text: '资源类型分类统计'
    },
    tooltip: {
        trigger: 'axis'
    },
    xAxis: {
        type: 'category',
        boundaryGap: false,
        data: xdata
    },
    yAxis: {
        type: 'value',
        splitArea : {show : true}
    },
    series: [{
        name: '统计',
        type: 'line',
        smooth: true,
        data: ydata,
        itemStyle: {
            normal: {
                label: {
                    show: true
                }
            }
        } // itemStyle
    }]
};

var statSentiment = {
    title: {
        text: '正负面统计'
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

var statHotWords = {
    title: {
        text: '正负面统计'
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

var statHotEvents = {
    title: {
        text: '正负面统计'
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

var statTagComparation = {
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

$(document).ready(function () {
    // 使用刚指定的配置项和数据显示图表
    chartTrends.setOption(statTrends);

    var chartOption = statTrends;
    $("#FilterStatType").change(function () {
        // $(".message").text(this.value);
        var urlAction = "statTrends";

        if (this.value == "曝光量趋势") {
            chartOption = statTrends;
            urlAction = "statTrends";
        }
        else if (this.value == "资源类型统计") {
            chartOption = statMediaDistribution;
            urlAction = "statMediaDistribution";
        }
        else if (this.value == "资源类型分类统计") {
            chartOption = statTrendsGroupByMedia;
            urlAction = "statTrendsGroupByMedia";
        }
        else if (this.value == "正负面统计") {
            chartOption = statSentiment;
            urlAction = "statSentiment";
        }
        else if (this.value == "预警报告") {
            chartOption = statAlert;
            urlAction = "statAlert";
        }
        else if (this.value == "焦点聚类") {
            chartOption = statHotWords;
            urlAction = "statHotWords";
        }
        else if (this.value == "热点话题") {
            chartOption = statHotEvents;
            urlAction = "statHotEvents";
        }
        else if (this.value == "标签对比") {
            chartOption = statTagComparation;
            urlAction = "statTagComparation";
        }

        var url = "/u/topics/" + urlAction + "/" + topicId + "/json";
        var solrParamQ = "";
        if (statQuery != undefined) {
            solrParamQ = statQuery;
        }

        var message = url + "<br />";
        message += solrParamQ + "<br />";

        $.get(url, {solrParamQ : solrParamQ, format : "json"}, function (result) {
            message += result + "<br />";
            $('.message').html(message);
        });

        chartTrends.setOption(chartOption);
    });
});
