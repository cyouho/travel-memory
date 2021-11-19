//import * as echarts from 'echarts';
$(document).ready(function () {
    var chartDom = document.getElementById('main');
    var myChart = echarts.init(chartDom);
    var option;

    myChart.showLoading();
    $.get('/js/map/china.json', function (geoJson) {
        myChart.hideLoading();
        echarts.registerMap('china', geoJson);
        myChart.setOption(
            (option = {
                title: {
                    text: '国内旅行记录',
                    subtext: 'Data for travel',
                    sublink:
                        'http://zh.wikipedia.org/wiki/%E9%A6%99%E6%B8%AF%E8%A1%8C%E6%94%BF%E5%8D%80%E5%8A%83#cite_note-12'
                },
                tooltip: {
                    trigger: 'item',
                    formatter: '{b}<br/>{c} (次)'
                },
                toolbox: {
                    show: true,
                    orient: 'vertical',
                    left: 'right',
                    top: 'center',
                    feature: {
                        dataView: { readOnly: false },
                        restore: {},
                        saveAsImage: {}
                    }
                },
                visualMap: {
                    show: false,
                    min: 0,
                    max: 10,
                    text: ['High', 'Low'],
                    realtime: false,
                    calculable: true,
                    inRange: {
                        color: ['grey', 'yellow', 'orangered']
                    }
                },
                series: [
                    {
                        name: '全国旅行记录图',
                        type: 'map',
                        map: 'china',
                        layoutCenter: ['50%', '45%'],//距左百分比，距上百分比
                        layoutSize: "80%",//省份地图大小为600xp。
                        label: {
                            show: true
                        },
                        data: [
                            { "name": '广西壮族自治区', "value": 1000 },
                            { name: '西藏自治区', value: 0 },
                            { name: '云南省', value: 2 },
                            { name: '贵州省', value: 2 },
                            { name: '海南省', value: 3 },
                            { name: '黑龙江省', value: 0 },
                            { name: '四川省', value: 0 },
                            { name: '重庆市', value: 0 },
                            { name: '湖南省', value: 0 },
                            { name: '葵青', value: 21900.9 },
                            { name: '荃湾', value: 4918.26 },
                            { name: '屯门', value: 5881.84 },
                            { name: '元朗', value: 4178.01 },
                            { name: '北区', value: 2227.92 },
                            { name: '大埔', value: 2180.98 },
                            { name: '沙田', value: 9172.94 },
                            { name: '西贡', value: 3368 },
                            { name: '离岛', value: 806.98 }
                        ],
                        // 自定义名称映射
                        // nameMap: {
                        //     'Central and Western': '中西区',
                        //     Eastern: '东区',
                        //     Islands: '离岛',
                        //     'Kowloon City': '九龙城',
                        //     'Kwai Tsing': '葵青',
                        //     'Kwun Tong': '观塘',
                        //     North: '北区',
                        //     'Sai Kung': '西贡',
                        //     'Sha Tin': '沙田',
                        //     'Sham Shui Po': '深水埗',
                        //     Southern: '南区',
                        //     'Tai Po': '大埔',
                        //     'Tsuen Wan': '荃湾',
                        //     'Tuen Mun': '屯门',
                        //     'Wan Chai': '湾仔',
                        //     'Wong Tai Sin': '黄大仙',
                        //     'Yau Tsim Mong': '油尖旺',
                        //     'Yuen Long': '元朗'
                        // }
                    }
                ]
            })
        );
    });

    //鼠标移入地图不变黄色
    myChart.on("mouseover", function () {
        myChart.dispatchAction({
            type: "downplay"
        });
    });

    option && myChart.setOption(option);
    window.addEventListener("resize", function () {
        myChart.resize();
    });
});
