<div class="container-fluid">
    <div id="top">

    </div>
    <div id="add_record">
        <form action="/addNewRecord" method="POST">
            @csrf
            <input type="text" name="userId" id="user-id" style="display:none" value="{{isset($data['userId']) ? $data['userId'] : ''}}">
            <div class="row">
                <div class="col">
                    <label for="sel1">省/直辖市/自治区:</label>
                    <select class="form-control" id="sel1" name="province">
                        <option value="-" selected>-</option>
                        @foreach ($province as $key => $value)
                        <option value="{{$key}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="sel2">市/州:</label>
                    <select class="form-control" id="sel2" name="city">
                        <option>-</option>
                    </select>
                </div>
                <div class="col">
                    <label for="sel3">区/县:</label>
                    <select class="form-control" id="sel3" name="region">
                        <option>-</option>
                    </select>
                </div>
                <div class="col">
                    <label for="sel3">选择时间:</label>
                    <div class="input-group date" id="datepicker">
                        <input type="text" class="form-control" id="date-input" name="travelDate" onkeydown="return false">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <label for="sel1">景点名:</label>
                    <input class="form-control" id="dest" name="travel_dest" placeholder="请输入景点名称">
                    <a id="destCount" style="color:#9B9B9B;text-decoration: none;font-size:12px;">还可以输入30个字</a>
                </div>
                <div class="col">
                    <label for="sel1">备注:</label>
                    <input class="form-control" id="remark" name="remark" placeholder="备注/简介">
                    <a id="remarkCount" style="color:#9B9B9B;text-decoration: none;font-size:12px;">还可以输入12个字</a>
                </div>
            </div><br>
            <div class="border-top"></div><br>
            <div class="row">
                <button type="submit" class="btn btn-primary m-auto" id="record-submit">提交</button>
            </div>
        </form>
    </div>
</div>