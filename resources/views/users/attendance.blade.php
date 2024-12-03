@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Attendance</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form id="fetch-yatrik-form" name="fetch-yatrik-form" class="fetch-yatrik-form" action="{{route('users.attendance.update')}}" method="POST">
                        @csrf
                        @include('shared.alert')
                        @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Scan QR Code</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="event_name">Event Name*</label>
                                    <select class="form-control" id="event_name" name="event_name">
                                        <option value="">Select Event</option>
                                        @foreach($events as $event)
                                            <option value="{{$event->id}}" @if(array_key_exists('event_id', $event_data) && $event_data['event_id'] == $event->id) selected @endif>{{ $event->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if(array_key_exists('day_id', $event_data))
                                    <div class="form-group" id="day_results" style="display: block;">
                                        <label for="day_name">Day (Route Name)*</label>
                                        <select class="form-control" id="day_name" name="day_name">
                                            <option value="">Select Day</option>
                                            @foreach($days as $day)
                                                <option value="{{$day->id}}" @if(array_key_exists('day_id', $event_data) && $event_data['day_id'] == $day->id) selected @endif>{{ $day->name }} - {{ $day->route_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                    <div class="form-group" id="day_results">
                                        @include('users.fetch-days', ['days' => $days])
                                    </div>
                                @endif
                                <div id="qr_code" style="@if(array_key_exists('event_id', $event_data) && array_key_exists('day_id', $event_data)) display: block; @endif">
                                    <video id="preview" class="w-50"></video>
                                    <div id="qr_code_form">
                                        @include('users.qr-code')
                                    </div>
                                </div>
                                <div id="member_details">
                                    @if($member)
                                        @include('users.get-information', ['member' => $member])
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer hidden">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
    Instascan.Camera.getCameras().then(function(cameras)
    {
        if(cameras.length > 0)
        {
            scanner.start(cameras[0]);
        }
        else
        {
            alert('No cameras found');
        }
    }).catch(function(e){ 
        console.error(e);
    });
    scanner.addListener('scan',function(c) { 
        document.getElementById('text').value= c;
    });
</script>
<script type="text/javascript">
    $(document).on('change', '#event_name', function(){
        $('.loader').show();
        $.ajax({
            url: "{{ route('users.days.fetch') }}",
            method: "POST",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              'event_id' : $("#event_name").val(),
            },
            success: function (data) {
              $('.loader').hide();
              $("#day_results").html('');
              $("#day_results").show();
              $('#day_results').append(data);
            },
        });
    });
    $(document).on('change', '#day_name', function(){
        $('.loader').show();
        $.ajax({
            url: "{{ route('users.qrcode') }}",
            method: "POST",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
              $('.loader').hide();
              $("#qr_code").show();
              $("#qr_code_form").html('');
              $('#qr_code_form').append(data);
            },
        });
    });
    $(document).on('click', '#information', function(){
        if($("#member_id").val() == ''){
            $("#member_id-error").html("Please enter member id.");
            $("#member_id-error").show();
            return false;
        }
        $('.loader').show();
        $.ajax({
            url: "{{ route('users.get.information') }}",
            method: "POST",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              'member_id' : $("#member_id").val(),
            },
            success: function (data) {
                $('.loader').hide();
                if(data.status == false) {
                    $("#member_id-error").html("Member id not found.");
                    $("#member_id-error").show();
                } else {
                    $("#member_id-error").hide();
                    $("#member_details").html('');
                    $("#member_details").show();
                    $('#member_details').append(data);
                    $(".card-footer").show();
                }
            },
        });
    });  
    (function() {
        $('#fetch-yatrik-form').validate({
            rules: {
                event_name: {
                    required: true,
                },
                day_name: {
                    required: true,
                },
                member_id: {
                    required: true,
                }
            },
            messages:{
                event_name:{
                    required: "Please select event name."
                },
                day_name:{
                    required: "Plese select day.",
                },
                member_id: {
                    required: "Please enter member id.",
                }
            }
        });
    })();
</script>
@endsection