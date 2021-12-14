<div class="row">
    <div class="col">
        <div id="china_province">

        </div>
    </div>
    <div class="col">
        <div id="top"></div>
        <label for="sel3">选择记录日期:</label>
        <select class="form-control select-width" id="sel3" name="region">
            <option value="30days" id="30days" selected>近30天</option>
            <option value="3months" id="3months">近3个月</option>
        </select>
        <div class="province_detail_gap"></div>
        <div><h3 id="province_title" class="text-center province_title">{{ $province['province_name'] }}</h3></div><br>
        <div id="province_detail" class="province_detail">

        </div>
    </div>
</div>