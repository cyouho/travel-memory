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
});