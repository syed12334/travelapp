@if(count($city) >0) 
    <option value="">Select city</option>
    @foreach ($city as $s => $val)
        <option value="{{ $val->id }}">{{ $val->city_name }}</option>
    @endforeach
@endif