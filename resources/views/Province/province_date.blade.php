<option value="30days" selected>近30天</option>
<option value="3months">近3个月</option>
@foreach ($date as $date)
<option value="{{ $date->year_date }}">{{ $date->year_date }}年</option>
@endforeach