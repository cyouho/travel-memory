$(document).ready(function () {
    var userId = $("#navbardroplogin").attr("user-id");
    var token = $('meta[name="csrf-token"]').attr('content');

    $("#province_detail").load('/getChinaProvinceDetailAjax', { 'user_id': userId, '_token': token });
    $("#province_detail").change(function () {

    });
});