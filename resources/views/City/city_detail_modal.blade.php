<!-- 模态框 -->
<div class="modal fade" id="myModal">
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
                    <div id="travel-dest-text"></div>
                </div>
                <div class="dropdown-divider"></div>
                <div id="travel-date">
                    <h5 id="travel-date-title">旅行日期:</h5>
                    <div id="travel-date-text"></div>
                </div>
                <div class="dropdown-divider"></div>
                <div id="travel-sopt">
                    <h5 id="travel-spot-title">景点名:</h5>
                    <div id="travel-spot-text">-</div>
                </div>
                <div class="dropdown-divider"></div>
                <div id="travel-remark">
                    <h5 id="travel-remark-title">备注:</h5>
                    <div id="travel-remark-text">-</div>
                </div>
            </div>

            <!-- 模态框底部 -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            </div>

        </div>
    </div>
</div>