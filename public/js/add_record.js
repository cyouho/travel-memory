$(document).ready(function () {
    var token = $('meta[name="csrf-token"]').attr('content');
    var date = '';

    $("#datepicker").datepicker({
        language: "zh-CN",
        autoclose: true,
        clearBtn: true,
        todayBtn: "linked",
        todayHighlight: true,
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
        travelDate = $("#date-input").val();
        userId = $("#user-id").val();
        if (province == '-') {
            alert('请选择 省/直辖市/自治区');
            return false;
        } else if (travelDate == '') {
            alert('请选择出游时间');
            return false;
        } else if (userId == '') {
            return false;
        }
    });



});