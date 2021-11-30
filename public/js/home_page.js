$(document).ready(function () {
    $(".menu-list a").click(function () {
        $(".menu-list a").removeClass("active");
        $(this).addClass("active");
        a = $(this).attr("id");
        console.log(a);
    });
});