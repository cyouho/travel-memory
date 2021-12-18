$(document).ready(function () {
    var idName = $("body").attr('id');
    var selector = '#' + idName + "-a";

    $(".menu-list a").removeClass("active");
    $(selector).addClass("active");

    $("#name_submit").click(function () {
        userNameLength = $("#usr").val().length;

        if (!userNameLength) {
            alert('用户名不能为空');
            return false;
        } else if (userNameLength > 10) {
            alert('用户名长度不能大于10个字')
            return false;
        }
    });

    $("#password_submit").click(function () {
        userOldPWDLength = $("#usr_old_pwd").val().length;
        userNewPWDLength = $("#usr_new_pwd").val().length;

        if (!userOldPWDLength) {
            alert('旧密码不能为空');
            return false;
        } else if (!userNewPWDLength) {
            alert('新密码不能为空');
            return false;
        }
    });
});