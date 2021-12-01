$(document).ready(function () {
    var token = $('meta[name="csrf-token"]').attr('content');
    $("#home-contents").load("/homeContentsAjax", { 'pageName': 'profile', '_token': token });

    $(".menu-list a").click(function () {
        $(".menu-list a").removeClass("active");
        $(this).addClass("active");
        pageName = $(this).attr("id");
        $("#home-contents").load("/homeContentsAjax", { 'pageName': pageName, '_token': token });
    });
});