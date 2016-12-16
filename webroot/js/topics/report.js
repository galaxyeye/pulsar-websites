// 基于准备好的dom，初始化echarts实例
var chartTrends = echarts.init(document.getElementById('chart-trends'));

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

// 使用刚指定的配置项和数据显示图表。
chartTrends.setOption(optionTrends);
