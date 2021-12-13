<option value="30days" id="30days">近30天</option>
<option value="3months" id="3months">近3个月</option>
@foreach ($date as $date)
<option value="{{ $date->year_date }}" id="{{ $date->year_date }}">{{ $date->year_date }}年</option>
@endforeach