<div class="container-fluid">
    <div id="top">

    </div>
    <div id="add_record">
        <form>
            <div class="row">
                <div class="col">
                    <label for="sel1">省/直辖市/自治区:</label>
                    <select class="form-control" id="sel1">
                        <option value="-" selected>-</option>
                        @foreach ($province as $key => $value)
                        <option value="{{$key}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="sel2">市/州:</label>
                    <select class="form-control" id="sel2">
                        <option>-</option>
                    </select>
                </div>
                <div class="col">
                    <label for="sel3">区/县:</label>
                    <select class="form-control" id="sel3">
                        <option>-</option>
                    </select>
                </div>
                <div class="col">
                    <label for="sel3">选择时间:</label>
                    <div class="input-group date" id="datepicker">
                        <input type="text" class="form-control" onkeydown="return false">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                </div>
        </form>
    </div>
</div>