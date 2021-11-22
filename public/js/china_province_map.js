//import * as echarts from 'echarts';
$(document).ready(function () {
    var chartDom = document.getElementById('china_province');
    var myChart = echarts.init(chartDom);
    var option;
    var province = $("#province_gone").text();

    $.ajax({
        url: "/chinaProvinceMapDataAjax",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "province": province,
        },
        success: function (data) {
            console.log(data);
            myChart.showLoading();
            $.get('/js/map/' + province + '.json', function (geoJson) {
                myChart.hideLoading();
                echarts.registerMap(province, geoJson);
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
                                name: province + '旅行记录图',
                                type: 'map',
                                map: province,
                                layoutCenter: ['50%', '52%'],//距左百分比，距上百分比
                                layoutSize: '100%',//省份地图大小为600xp。
                                label: {
                                    show: true
                                },
                                itemStyle: {
                                    normal: {
                                        borderWidth: 1,
                                        borderColor: '#fff',
                                    },
                                    emphasis: {
                                        borderWidth: 2,
                                        borderColor: 'rgba(255, 0, 0)',
                                        areaColor: 'none',
                                        opacity: 1,
                                    },
                                },
                                selectedMode: false,
                                data: data,
                            }
                        ]
                    })
                );
            });
            myChart.on('click', function (param) {
                //这个params可以获取你要的图中的当前点击的项的参数
                console.log(param['data']['name']);
            });

            option && myChart.setOption(option);
            window.addEventListener("resize", function () {
                myChart.resize();
            });
        },
    });
});
