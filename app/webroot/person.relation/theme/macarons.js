define(function() {

var theme = {
    // é»˜è®¤è‰²æ¿
    color: [
        '#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
        '#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
        '#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
        '#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
    ],

    // å›¾è¡¨æ ‡é¢˜
    title: {
        textStyle: {
            fontWeight: 'normal',
            color: '#008acd'          // ä¸»æ ‡é¢˜æ–‡å­—é¢œè‰²
        }
    },
    
    // å€¼åŸŸ
    dataRange: {
        itemWidth: 15,
        color: ['#5ab1ef','#e0ffff']
    },

    // å·¥å…·ç®±
    toolbox: {
        color : ['#1e90ff', '#1e90ff', '#1e90ff', '#1e90ff'],
        effectiveColor : '#ff4500'
    },

    // æç¤ºæ¡†
    tooltip: {
        backgroundColor: 'rgba(50,50,50,0.5)',     // æç¤ºèƒŒæ™¯é¢œè‰²ï¼Œé»˜è®¤ä¸ºé€æ˜Žåº¦ä¸º0.7çš„é»‘è‰²
        axisPointer : {            // åæ ‡è½´æŒ‡ç¤ºå™¨ï¼Œåæ ‡è½´è§¦å‘æœ‰æ•ˆ
            type : 'line',         // é»˜è®¤ä¸ºç›´çº¿ï¼Œå¯é€‰ä¸ºï¼š'line' | 'shadow'
            lineStyle : {          // ç›´çº¿æŒ‡ç¤ºå™¨æ ·å¼è®¾ç½®
                color: '#008acd'
            },
            crossStyle: {
                color: '#008acd'
            },
            shadowStyle : {                     // é˜´å½±æŒ‡ç¤ºå™¨æ ·å¼è®¾ç½®
                color: 'rgba(200,200,200,0.2)'
            }
        }
    },

    // åŒºåŸŸç¼©æ”¾æŽ§åˆ¶å™¨
    dataZoom: {
        dataBackgroundColor: '#efefff',            // æ•°æ®èƒŒæ™¯é¢œè‰²
        fillerColor: 'rgba(182,162,222,0.2)',   // å¡«å……é¢œè‰²
        handleColor: '#008acd'    // æ‰‹æŸ„é¢œè‰²
    },

    // ç½‘æ ¼
    grid: {
        borderColor: '#eee'
    },

    // ç±»ç›®è½´
    categoryAxis: {
        axisLine: {            // åæ ‡è½´çº¿
            lineStyle: {       // å±žæ€§lineStyleæŽ§åˆ¶çº¿æ¡æ ·å¼
                color: '#008acd'
            }
        },
        splitLine: {           // åˆ†éš”çº¿
            lineStyle: {       // å±žæ€§lineStyleï¼ˆè¯¦è§lineStyleï¼‰æŽ§åˆ¶çº¿æ¡æ ·å¼
                color: ['#eee']
            }
        }
    },

    // æ•°å€¼åž‹åæ ‡è½´é»˜è®¤å‚æ•°
    valueAxis: {
        axisLine: {            // åæ ‡è½´çº¿
            lineStyle: {       // å±žæ€§lineStyleæŽ§åˆ¶çº¿æ¡æ ·å¼
                color: '#008acd'
            }
        },
        splitArea : {
            show : true,
            areaStyle : {
                color: ['rgba(250,250,250,0.1)','rgba(200,200,200,0.1)']
            }
        },
        splitLine: {           // åˆ†éš”çº¿
            lineStyle: {       // å±žæ€§lineStyleï¼ˆè¯¦è§lineStyleï¼‰æŽ§åˆ¶çº¿æ¡æ ·å¼
                color: ['#eee']
            }
        }
    },

    polar : {
        axisLine: {            // åæ ‡è½´çº¿
            lineStyle: {       // å±žæ€§lineStyleæŽ§åˆ¶çº¿æ¡æ ·å¼
                color: '#ddd'
            }
        },
        splitArea : {
            show : true,
            areaStyle : {
                color: ['rgba(250,250,250,0.2)','rgba(200,200,200,0.2)']
            }
        },
        splitLine : {
            lineStyle : {
                color : '#ddd'
            }
        }
    },

    timeline : {
        lineStyle : {
            color : '#008acd'
        },
        controlStyle : {
            normal : { color : '#008acd'},
            emphasis : { color : '#008acd'}
        },
        symbol : 'emptyCircle',
        symbolSize : 3
    },

    // æŸ±å½¢å›¾é»˜è®¤å‚æ•°
    bar: {
        itemStyle: {
            normal: {
                barBorderRadius: 5
            },
            emphasis: {
                barBorderRadius: 5
            }
        }
    },

    // æŠ˜çº¿å›¾é»˜è®¤å‚æ•°
    line: {
        smooth : true,
        symbol: 'emptyCircle',  // æ‹ç‚¹å›¾å½¢ç±»åž‹
        symbolSize: 3           // æ‹ç‚¹å›¾å½¢å¤§å°
    },
    
    // Kçº¿å›¾é»˜è®¤å‚æ•°
    k: {
        itemStyle: {
            normal: {
                color: '#d87a80',       // é˜³çº¿å¡«å……é¢œè‰²
                color0: '#2ec7c9',      // é˜´çº¿å¡«å……é¢œè‰²
                lineStyle: {
                    color: '#d87a80',   // é˜³çº¿è¾¹æ¡†é¢œè‰²
                    color0: '#2ec7c9'   // é˜´çº¿è¾¹æ¡†é¢œè‰²
                }
            }
        }
    },
    
    // æ•£ç‚¹å›¾é»˜è®¤å‚æ•°
    scatter: {
        symbol: 'circle',    // å›¾å½¢ç±»åž‹
        symbolSize: 4        // å›¾å½¢å¤§å°ï¼ŒåŠå®½ï¼ˆåŠå¾„ï¼‰å‚æ•°ï¼Œå½“å›¾å½¢ä¸ºæ–¹å‘æˆ–è±å½¢åˆ™æ€»å®½åº¦ä¸ºsymbolSize * 2
    },

    // é›·è¾¾å›¾é»˜è®¤å‚æ•°
    radar : {
        symbol: 'emptyCircle',    // å›¾å½¢ç±»åž‹
        symbolSize:3
        //symbol: null,         // æ‹ç‚¹å›¾å½¢ç±»åž‹
        //symbolRotate : null,  // å›¾å½¢æ—‹è½¬æŽ§åˆ¶
    },

    map: {
        itemStyle: {
            normal: {
                areaStyle: {
                    color: '#ddd'
                },
                label: {
                    textStyle: {
                        color: '#d87a80'
                    }
                }
            },
            emphasis: {                 // ä¹Ÿæ˜¯é€‰ä¸­æ ·å¼
                areaStyle: {
                    color: '#fe994e'
                }
            }
        }
    },
    
    force : {
        itemStyle: {
            normal: {
                linkStyle : {
                    color : '#1e90ff'
                }
            }
        }
    },

    chord : {
        itemStyle : {
            normal : {
                borderWidth: 1,
                borderColor: 'rgba(128, 128, 128, 0.5)',
                chordStyle : {
                    lineStyle : {
                        color : 'rgba(128, 128, 128, 0.5)'
                    }
                }
            },
            emphasis : {
                borderWidth: 1,
                borderColor: 'rgba(128, 128, 128, 0.5)',
                chordStyle : {
                    lineStyle : {
                        color : 'rgba(128, 128, 128, 0.5)'
                    }
                }
            }
        }
    },

    gauge : {
        axisLine: {            // åæ ‡è½´çº¿
            lineStyle: {       // å±žæ€§lineStyleæŽ§åˆ¶çº¿æ¡æ ·å¼
                color: [[0.2, '#2ec7c9'],[0.8, '#5ab1ef'],[1, '#d87a80']], 
                width: 10
            }
        },
        axisTick: {            // åæ ‡è½´å°æ ‡è®°
            splitNumber: 10,   // æ¯ä»½splitç»†åˆ†å¤šå°‘æ®µ
            length :15,        // å±žæ€§lengthæŽ§åˆ¶çº¿é•¿
            lineStyle: {       // å±žæ€§lineStyleæŽ§åˆ¶çº¿æ¡æ ·å¼
                color: 'auto'
            }
        },
        splitLine: {           // åˆ†éš”çº¿
            length :22,         // å±žæ€§lengthæŽ§åˆ¶çº¿é•¿
            lineStyle: {       // å±žæ€§lineStyleï¼ˆè¯¦è§lineStyleï¼‰æŽ§åˆ¶çº¿æ¡æ ·å¼
                color: 'auto'
            }
        },
        pointer : {
            width : 5
        }
    },
    
    textStyle: {
        fontFamily: 'å¾®è½¯é›…é»‘, Arial, Verdana, sans-serif'
    }
};

    return theme;
});