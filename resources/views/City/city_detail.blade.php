<table class="table table-hover">
    <thead>
        <tr>
            <th>区/县</th>
            <th>日期</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detail['travel_detail'] as $travelDetail)
        <tr class="detail_tr">
            <td id="{{ $travelDetail->record_id }}-region">{{ $travelDetail->region }}</td>
            <td id="{{ $travelDetail->record_id }}-date">{{ $travelDetail->travel_date }} ~ {{ $travelDetail->travel_date_end != '-' ? $travelDetail->travel_date_end : '至今' }}</td>
            <td><button type="button" class="btn btn-primary btn-sm show-detail" id="{{ $travelDetail->record_id }}" data-toggle="modal" data-target="#myModal">显示详细</button>
                <button type="button" class="btn btn-warning btn-sm amend-detail" id="{{ $travelDetail->record_id }}-amend" data-toggle="modal" data-target="#myModalAmend">修改</button>
                <button type="button" class="btn btn-danger btn-sm delete-detail" id="{{ $travelDetail->record_id }}-delete" data-toggle="modal" data-target="#myModal">删除</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<ul class="pagination justify-content-center">
    <li class="page-item previous"><a class="page-link" href="#">&laquo;</a></li>
    @for ($i = 1; $i <= $detail['paginate']['total_page']; $i++) @if ($i==$detail['paginate']['now_page']) <li class="page-item list active" id="{{ $i }}"><a class="page-link" href="#">{{ $i }}</a></li>
        @else
        <li class="page-item list" id="{{ $i }}"><a class="page-link" href="#">{{ $i }}</a></li>
        @endif
        @endfor
        <li class="page-item next"><a class="page-link" href="#">&raquo;</a></li>
</ul>