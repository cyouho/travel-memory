$(document).ready(function () {
    var token = $('meta[name="csrf-token"]').attr('content');
    var date = '';

    $(".input-daterange input").each(function () {
        $(this).datepicker({
            language: "zh-CN",
            autoclose: true,
            clearBtn: true,
            todayBtn: "linked",
            todayHighlight: true,
        });
    });

    $("#sel1").change(function () {
        //$("#sel3").empty().html("<option>-</option>");
        province = $("#sel1").val();
        $("#sel2").load("/firstChinaProvinceCityRegionMapDataAjax", { 'province': province, '_token': token });
        $("#sel3").load("/secondChinaProvinceCityRegionMapDataAjax", { 'province': province, 'city': 'first', '_token': token });
    });

    $("#sel2").change(function () {
        province = $("#sel1").val();
        city = $("#sel2").val();
        $("#sel3").load("/secondChinaProvinceCityRegionMapDataAjax", { 'province': province, 'city': city, '_token': token });
    });

    $("#record-submit").click(function () {
        province = $("#sel1").val();
        travelDateStart = $("#date-start-input").val();
        travelDateEnd = $("#date-end-input").val();
        start = new Date(travelDateStart.replace("-", "/").replace("-", "/"));
        end = new Date(travelDateEnd.replace("-", "/").replace("-", "/"));
        userId = $("#user-id").val();
        if (province == '-') {
            alert('请选择 省/直辖市/自治区');
            return false;
        } else if (travelDateStart == '') {
            alert('请选择出游时间');
            return false;
        } else if (start > end) {
            alert('开始日期不能大于结束日期，请检查');
            return false;
        } else if (userId == '') {
            return false;
        }
    });

    $("#remarkCount").text("还可以输入" + (140 - $("#remark").val().length) + "个字");
    $("#remark").keyup(function () {
        if ($("#remark").val().length > 140) {
            $("#remark").val($("#remark").val().substring(0, 140));
        }
        $("#remarkCount").text("还可以输入" + (140 - $("#remark").val().length) + "个字");
    });

    $("#destCount").text("还可以输入" + (30 - $("#dest").val().length) + "个字");
    $("#dest").keyup(function () {
        if ($("#dest").val().length > 30) {
            $("#dest").val($("#dest").val().substring(0, 30));
        }
        $("#destCount").text("还可以输入" + (30 - $("#dest").val().length) + "个字");
    });

});