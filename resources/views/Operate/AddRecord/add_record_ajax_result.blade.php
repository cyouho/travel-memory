@if (is_array($city))
@foreach ($city as $key => $value)
<option value="{{$key}}">{{$key}}</option>
@endforeach
@else
<option value="-">-</option>
@endif