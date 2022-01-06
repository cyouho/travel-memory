$(document).ready(function () {
    var userId = $("#navbardroplogin").attr("user-id");
    var currentDate = moment().format('YYYY-MM-DD');
    var lastYearDate = moment().subtract(1, 'year').format('YYYY-MM-DD');
    var chartDom = document.getElementById('main');
    var myChart = echarts.init(chartDom);
    var option;
    var token = $('meta[name="csrf-token"]').attr('content');
    var date = 'one_year';

    getCalendarData(date);

    $("#detail-years").change(function () {
        date = $(this).val();
        selector = "#" + date;
        $("#detail-years option").removeAttr("selected");
        $(selector).attr("selected", true);
        getCalendarData(date);
    });

    $("#detail-years").load("/getAllTravelYearAjax", { 'userId': userId, '_token': token });


    function getCalendarData() {
        $.ajax({
            url: "/getCalendarDataAjax",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "userId": userId,
                "date": date,
            },
            success: function (data) {
                option = {
                    title: {
                        top: 30,
                        left: 'center',
                        text: data['title'] + '年旅行天数'
                    },
                    tooltip: {
                        show: true,
                        trigger: 'item',
                        formatter: '{c} (次)',
                    },
                    visualMap: {
                        min: 0,
                        max: 50,
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
                        range: data['time_range'],
                        itemStyle: {
                            borderWidth: 0.5
                        },
                        yearLabel: { show: false }
                    },
                    series: {
                        type: 'heatmap',
                        coordinateSystem: 'calendar',
                        data: data['date'],
                    }
                };

                option && myChart.setOption(option);
            }
        });
    }
});