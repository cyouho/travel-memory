<table class="table table-hover">
    <thead>
        <tr>
            <th>市/州</th>
            <th>日期</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detail['travel_detail'] as $travelDetail)
        <tr>
            <td><a href="/province/{{ $detail['province_name'] }}/city/{{ $travelDetail->city }}" target="_blank">{{ $travelDetail->city }}</a></td>
            <td>{{ $travelDetail->travel_date }} ~ {{ $travelDetail->travel_date_end != '-' ? $travelDetail->travel_date_end : '至今' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<ul class="pagination justify-content-center">
    @if ($detail['paginate']['total_page'] > 0)
    <li class="page-item previous"><a class="page-link" href="#">&laquo;</a></li>
    @for ($i = 1; $i <= $detail['paginate']['total_page']; $i++) @if ($i==$detail['paginate']['now_page']) <li class="page-item list active" id="{{ $i }}"><a class="page-link" href="#">{{ $i }}</a></li>
        @else
        <li class="page-item list" id="{{ $i }}"><a class="page-link" href="#">{{ $i }}</a></li>
        @endif
        @endfor
        <li class="page-item next"><a class="page-link" href="#">&raquo;</a></li>
        @endif
</ul>