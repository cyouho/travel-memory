$(document).ready(function () {
    var userId = $("#navbardroplogin").attr("user-id");
    var chartDom = document.getElementById('main');
    var myChart = echarts.init(chartDom);
    var option;
    $.ajax({
        url: "/getCalendarDataAjax",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "userId": userId,
        },
        success: function (data) {
            option = {
                title: {
                    top: 30,
                    left: 'center',
                    text: '2021 年旅行记录'
                },
                tooltip: {
                    show: true,
                    trigger: 'item',
                    formatter: '{b}<br/>{c} (次)',
                },
                visualMap: {
                    min: 0,
                    max: 100,
                    type: 'piecewise',
                    orient: 'horizontal',
                    left: 'center',
                    top: 65
                },
                calendar: {
                    top: 120,
                    left: 30,
                    right: 30,
                    cellSize: ['auto', 13],
                    range: '2021',
                    itemStyle: {
                        borderWidth: 0.5
                    },
                    yearLabel: { show: false }
                },
                series: {
                    type: 'heatmap',
                    coordinateSystem: 'calendar',
                    data: data,
                }
            };

            option && myChart.setOption(option);
        }
    });
});