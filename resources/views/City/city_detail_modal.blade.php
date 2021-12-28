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


                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>旅行目的地</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="travel-dest-text">-</td>
                        </tr>
                    </tbody>
                </table><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>日期</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="travel-date-text">-</td>
                        </tr>
                    </tbody>
                </table><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>景点名</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="travel-spot-text">-</td>
                        </tr>
                    </tbody>
                </table><br>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>备注</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td id="travel-remark-text">-</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- 模态框底部 -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            </div>

        </div>
    </div>
</div>