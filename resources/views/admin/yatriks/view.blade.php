@extends('layouts.admin-app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View Yatrik</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="card-title">View Record</h3>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4"><strong><label>Member ID</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->member_id}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Event Name</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->event->name}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Yatrik ID</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->custom_yatrik_id}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Name</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->name}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Gender</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->gender}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Age</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->age}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Aadhar Number</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->aadhar_number}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Address</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->address}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>City</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->city}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>State</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->state}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Country</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->country}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Religious Method</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->religious_method}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Father/Husband Name</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->father_husband_name}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Reference</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->reference}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Mobile Number</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->mobile_number}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Emergency Number</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->emergency_number}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Email</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->email}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Any Illness?</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->illness}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>99 Yatra on Shatrunjay Tirth?</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{($yatrik->_99_yatra == "1") ? 'Yes' : 'No' }}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>12 Gaon Chari Palit Sangh Yatra?</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{($yatrik->_12_gaon_chari_palit_sangh_yatra == "1") ? 'Yes' : 'No' }}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>What penance are you currently pursuing?</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span>{{$yatrik->present_penance}}</div>
                </div>
                <div class="row">
                    <div class="col-md-4"><strong><label>Profile Photo</label></strong></div>
                    <div class="col-md-8"><span class="mr-2">:</span><img src="{{asset('assets/'.$yatrik->profile_photo)}}" width="100px" /></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
@endsection