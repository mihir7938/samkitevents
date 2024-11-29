<label for="day_name">Day (Route Name)*</label>
<select class="form-control" id="day_name" name="day_name">
    <option value="">Select Day</option>
    @foreach($days as $day)
        <option value="{{$day->id}}">{{ $day->name }} - {{ $day->route_name }}</option>
    @endforeach
</select>