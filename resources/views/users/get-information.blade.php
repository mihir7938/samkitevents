<div class="row">
    <div class="col-md-2"><strong><label>Name</label></strong></div>
    <div class="col-md-10"><span class="mr-2">:</span>{{$member->name}}</div>
</div>
@if($member->aadhar_number)
    <div class="row">
        <div class="col-md-2"><strong><label>Aadhar Number</label></strong></div>
        <div class="col-md-10"><span class="mr-2">:</span>{{$member->aadhar_number}}</div>
    </div>
@endif
@if($member->address && $member->city)
    <div class="row">
        <div class="col-md-2"><strong><label>Address</label></strong></div>
        <div class="col-md-10"><span class="mr-2">:</span>{{$member->address}}, {{$member->city}}</div>
    </div>
@endif
<div class="row">
    <div class="col-md-2"><strong><label>Mobile Number</label></strong></div>
    <div class="col-md-10"><span class="mr-2">:</span>{{$member->mobile_number}}</div>
</div>
@if($member->profile_photo)
    <div class="row">
        <div class="col-md-2"><strong><label>Profile Photo</label></strong></div>
        <div class="col-md-10"><span class="mr-2">:</span><img src="{{asset('assets/'.$member->profile_photo)}}" width="100px" /></div>
    </div>
@endif