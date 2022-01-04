<option value="one_year" id="one_year">近1年</option>
@foreach ($yearData as $value)
<option value="{{ $value->year_date }}" id="{{ $value->year_date }}">{{ $value->year_date }}</option>
@endforeach