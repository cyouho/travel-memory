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
            <td>{{ $travelDetail->city }}</td>
            <td>{{ $travelDetail->travel_date }}</td>
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