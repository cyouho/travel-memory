$(document).ready(function () {
    var idName = $("body").attr('id');
    var selector = '#' + idName + "-a";

    $(".menu-list a").removeClass("active");
    $(selector).addClass("active");
});