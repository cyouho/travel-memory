<!-- 模态框 -->
<div class="modal fade" id="myModalAmend">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- 模态框头部 -->
            <div class="modal-header">
                <h4 class="modal-title" id="dest-title">{{ $province['province_name'] }}</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- 模态框主体 -->
            <div class="modal-body">
                <div id="travel-dest">
                    <h5 id="travel-dest-title">区/县:</h5>
                    <div id="travel-dest-amend-text"></div>
                </div>
                <div class="dropdown-divider"></div>
                <div id="travel-date">
                    <h5 id="travel-date-title">旅行日期:</h5>
                    <div class="form-inline">
                        <div class="amend-date-p text-center">开始日期:</div>
                        <div id="travel-date-start-text" class="amend-date-text word text-center"></div>
                        <div class="amend-date-icon text-center">-></div>
                        <input type="text" class="form-control" id="date-start-amend-input" name="travelDateEnd" placeholder="旅行开始日期" onkeydown="return false">
                    </div><br>
                    <div class="form-inline">
                        <div class="amend-date-p text-center">结束日期:</div>
                        <div id="travel-date-end-text" class="amend-date-text word text-center"></div>
                        <div class="amend-date-icon text-center">-></div>
                        <input type="text" class="form-control" id="date-end-amend-input" name="travelDateEnd" placeholder="旅行结束日期" onkeydown="return false">
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div id="travel-sopt">
                    <h5 id="travel-spot-title">景点名:</h5>
                    <div id="travel-spot-amend-text">-</div>
                </div>
                <div class="dropdown-divider"></div>
                <div id="travel-remark">
                    <h5 id="travel-remark-title">备注:</h5>
                    <div id="travel-remark-amend-text">-</div>
                </div>
            </div>

            <!-- 模态框底部 -->
            <div class="modal-footer">
                <button type="button" id="amend-submit" class="btn btn-primary">修改</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            </div>

        </div>
    </div>
</div>