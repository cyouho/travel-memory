$(document).ready(function () {
    var userId = $("#navbardroplogin").attr("user-id");

    showHowManyProvinceGoneAjax(userId);

    function showHowManyProvinceGoneAjax(userId) {
        $.ajax({
            url: "/showHowManyProvinceGoneAjax",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "userId": userId,
            },
            success: function (data) {
                $("#province_gone").text("已到过: " + data['gone'] + " 个，未到过: " + data['go'] + " 个");
            }
        });
    }
});