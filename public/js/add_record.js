$(document).ready(function () {
    $.ajax({
        url: "/firstChinaProvinceCityRegionMapDataAjax",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            "province": provinceName,
            "userId": userId,
        },
        success: function (data) {

        }
    });
});