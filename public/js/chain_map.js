//import * as echarts from 'echarts';
$(document).ready(function () {
    var chartDom = document.getElementById('china');
    var myChart = echarts.init(chartDom);
    var option;

    $.ajax({
        url: "/chinaMapDataAjax",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "userId": 0,
        },
        success: function (data) {
            console.log(data);
            myChart.showLoading();
            $.get('/js/map/china.json', function (geoJson) {
                myChart.hideLoading();
                echarts.registerMap('china', geoJson);
                myChart.setOption(
                    (option = {
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
                                layoutCenter: ['50%', '52%'],//距左百分比，距上百分比
                                layoutSize: '100%',//省份地图大小为600xp。
                                label: {
                                    show: true
                                },
                                data: data,

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
        },
    });
});
