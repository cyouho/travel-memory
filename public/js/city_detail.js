$(document).ready(function () {
    var userId = $("#navbardroplogin").attr("user-id");
    var province = $("#province_gone").attr("province-name");
    var token = $('meta[name="csrf-token"]').attr('content');
    var page = 1;

    $("#sel3").load('/getTravelDateDetailForRegionAjax', { 'user_id': userId, 'province': province, '_token': token });

    var date = $("#sel3 option:selected").val();

    $("#region_detail").on("click", ".list", function () {
        page = $(this).text();
        $("li").removeClass("active");
        $(this).addClass("active");
        $("#region_detail").load('/getChinaProvinceDetailForRegionAjax', {
            'user_id': userId, 'province': province, 'date': date, 'page': parseInt(page), '_token': token
        });
    })

    $("#region_detail").on("click", ".previous", function () {
        page = $(".active").text();
        if (page > 1) {
            $("#region_detail").load('/getChinaProvinceDetailForRegionAjax', {
                'user_id': userId, 'province': province, 'date': date, 'page': parseInt(page) - 1, '_token': token
            });
        }
    })

    $("#region_detail").on("click", ".next", function () {
        maxPage = $(".list").length;
        page = $(".active").text();
        if (parseInt(page) < maxPage) {
            $("#region_detail").load('/getChinaProvinceDetailForRegionAjax', {
                'user_id': userId, 'province': province, 'date': date, 'page': parseInt(page) + 1, '_token': token
            });
        }
    })

    $("#region_detail").load('/getChinaProvinceDetailForRegionAjax', {
        'user_id': userId, 'province': province, 'date': date, 'page': parseInt(page), '_token': token
    });

    $("#sel3").change(function () {
        date = $(this).val();
        selector = "#" + date;
        $("#sel3 option").removeAttr("selected");
        $(selector).attr("selected", true);
        page = 1;
        $("#region_detail").load('/getChinaProvinceDetailForRegionAjax', {
            'user_id': userId, 'province': province, 'date': date, 'page': parseInt(page), '_token': token
        });
    });

    // 显示详细记录
    $("#region_detail").on("click", ".show-detail", function () {
        recordId = $(this).attr("id");
        region = $("#" + recordId + "-region").text();
        regionDate = $("#" + recordId + "-date").text();
        regionEndDate = $("#" + recordId + "-end-date").text();

        $.ajax({
            url: "/travelDetailModalAjax",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "userId": userId,
                "recordId": recordId,
            },
            success: function (data) {
                $("#travel-dest-text").text(region);
                $("#travel-date-text").text(regionDate + " ~ " + regionEndDate);
                $("#travel-spot-text").text("-");
                $("#travel-spot-text").text(data['spot_name']);
                $("#travel-remark-text").text("-");
                $("#travel-remark-text").text(data['remark']);
            }
        })
    });

    /* -----------------------------------修改详细------------------------------------------ */

    // 修改详细 modal 的开始旅行日期 datepicker
    $("#date-start-amend-input").datepicker({
        language: "zh-CN",
        autoclose: true,
        clearBtn: true,
        todayBtn: "linked",
        todayHighlight: true,
    });

    // 修改详细 modal 的结束旅行日期 datepicker
    $("#date-end-amend-input").datepicker({
        language: "zh-CN",
        autoclose: true,
        clearBtn: true,
        todayBtn: "linked",
        todayHighlight: true,
    });

    // 修改详细旅行记录
    $("#region_detail").on("click", ".amend-detail", function () {
        recordId = $(this).attr("record-id");
        $("#amend-submit").attr("amend-record-id", recordId);
        region = $("#" + recordId + "-region").text();
        regionDate = $("#" + recordId + "-date").text();
        regionDateEnd = $("#" + recordId + "-end-date").text();
        $("#travel-dest-amend-text").text(region);
        $("#travel-date-start-text").text(regionDate);
        $("#travel-date-end-text").text(regionDateEnd);
        $("#date-start-amend-input").val('');
        $("#date-end-amend-input").val('');
        $("#end-date-alert").text('');
        $("#start-date-alert").text('');
        $.ajax({
            url: "/travelDetailModalAjax",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "userId": userId,
                "recordId": recordId,
            },
            success: function (data) {
                $("#travel-spot-amend-text").text(data['spot_name']);
                $("#travel-remark-amend-text").text(data['remark']);
            }
        })
    });

    $("#date-end-amend-input").change(function () {
        travelDateStart = $("#date-start-amend-input").val();
        travelDateEnd = $("#date-end-amend-input").val();
        startDate = $("#travel-date-start-text").text();
        endDate = $("#travel-date-end-text").text();
        start = new Date(travelDateStart.replace("-", "/").replace("-", "/"));
        end = new Date(travelDateEnd.replace("-", "/").replace("-", "/"));
        s_start = new Date(startDate.replace("-", "/").replace("-", "/"));
        e_end = new Date(endDate.replace("-", "/").replace("-", "/"));

        if (start > end) {
            $("#start-date-alert").text('');
            $("#end-date-alert").text(' 结束日期不能早于开始日期');
            $("#amend-submit").attr("disabled", "disabled");
        } else if (end < s_start) {
            if (start <= end) {
                $("#start-date-alert").text('');
                $("#end-date-alert").text('');
            } else {
                $("#end-date-alert").text(' 结束日期不早于修改前开始日期');
                $("#amend-submit").attr("disabled", "disabled");
            }
        } else if (start > s_start) {
            if (start <= end) {
                $("#end-date-alert").text('');
                $("#start-date-alert").text('');
                $("#amend-submit").removeAttr("disabled");
            } else {
                $("#end-date-alert").text('');
                $("#start-date-alert").text(' 开始日期早于修改前结束日期，如不修改结束日期将自动设置结束日期为至今');
            }
        } else {
            $("#start-date-alert").text('');
            $("#end-date-alert").text('');
            $("#amend-submit").removeAttr("disabled");
        }
    });

    $("#date-start-amend-input").change(function () {
        travelDateStart = $("#date-start-amend-input").val();
        travelDateEnd = $("#date-end-amend-input").val();
        startDate = $("#travel-date-start-text").text();
        endDate = $("#travel-date-end-text").text();
        start = new Date(travelDateStart.replace("-", "/").replace("-", "/"));
        end = new Date(travelDateEnd.replace("-", "/").replace("-", "/"));
        s_start = new Date(startDate.replace("-", "/").replace("-", "/"));
        e_end = new Date(endDate.replace("-", "/").replace("-", "/"));

        if (start > end) {
            $("#end-date-alert").text('');
            $("#start-date-alert").text(' 开始日期不能晚于结束日期');
            $("#amend-submit").attr("disabled", "disabled");
        } else if (start > e_end) {
            if (start < end) {
                $("#end-date-alert").text('');
                $("#start-date-alert").text('');
                $("#amend-submit").removeAttr("disabled");
            } else {
                $("#start-date-alert").text(' 开始日期早于修改前结束日期，如不修改结束日期将自动设置结束日期为至今');
            }
        } else if (end < s_start) {
            if (start > end) {
                $("#end-date-alert").text('');
                $("#start-date-alert").text('');
                $("#start-date-alert").text(' 结束日期早于修改前开始日期');
                $("#amend-submit").attr("disabled", "disabled");
            } else if (start <= end) {
                $("#end-date-alert").text('');
                $("#start-date-alert").text('');
                $("#amend-submit").removeAttr("disabled");
            } else {
                $("#end-date-alert").text('');
                $("#start-date-alert").text('');
                $("#start-date-alert").text(' 结束日期早于修改前开始日期');
                $("#amend-submit").attr("disabled", "disabled");
            }
        } else {
            $("#end-date-alert").text('');
            $("#start-date-alert").text('');
            $("#amend-submit").removeAttr("disabled");
        }
    });

    $("#amend-submit").click(function () {
        beforeStart = $("#travel-date-start-text").text();
        beforeEnd = $("#travel-date-end-text").text();
        amendStart = $("#date-start-amend-input").val();
        amendEnd = $("#date-end-amend-input").val();
        amendRecordId = $("#amend-submit").attr("amend-record-id");

        $.ajax({
            url: "/amendTravelDetailAjax",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "userId": userId,
                "amendRecordId": amendRecordId,
                "beforeStart": beforeStart,
                "beforeEnd": beforeEnd,
                "amendStart": amendStart,
                "amendEnd": amendEnd,
            },
            success: function (data) {
                if (data) {
                    window.location.reload();
                }
            }
        });
    });
});