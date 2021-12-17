$(document).ready(function () {
    var idName = $("body").attr('id');
    var selector = '#' + idName + "-a";

    $(".menu-list a").removeClass("active");
    $(selector).addClass("active");

    $("#submit").click(function () {
        userNameLength = $("#usr").val().length;

        if (!userNameLength) {
            alert('用户名不能为空');
            return false;
        } else if (userNameLength > 10) {
            alert('用户名长度不能大于10个字')
            return false;
        }
    });
});