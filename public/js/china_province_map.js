//import * as echarts from 'echarts';
$(document).ready(function () {
    var chartDom = document.getElementById('china_province');
    var myChart = echarts.init(chartDom);
    var option;
    var provinceAdcode = $("#province_gone").attr("province-adcode");
    var provinceName = $("#province_gone").attr("province-name");
    var userId = $("#navbardroplogin").attr("user-id");

    $.ajax({
        url: "/chinaProvinceMapDataAjax",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "province": provinceName,
            "userId": userId,
        },
        success: function (data) {
            console.log(data);
            myChart.showLoading();
            $.get('/js/map/province/' + provinceAdcode + '.json', function (geoJson) {
                myChart.hideLoading();
                echarts.registerMap(provinceName, geoJson);
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
                                name: provinceName + '旅行记录图',
                                type: 'map',
                                map: provinceName,
                                layoutCenter: ['50%', '50%'],//距左百分比，距上百分比
                                layoutSize: '80%',//省份地图大小为600xp。
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
                window.open("/province/" + provinceName + "/city/" + param['data']['name']);
            });

            option && myChart.setOption(option);
            window.addEventListener("resize", function () {
                myChart.resize();
            });
        },
    });
});
