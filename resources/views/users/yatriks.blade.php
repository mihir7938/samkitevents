@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Yatriks</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form id="fetch-yatrik-form" name="fetch-yatrik-form" class="fetch-yatrik-form" method="POST">
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
                                <h3 class="card-title">Event</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="event_name">Event Name*</label>
                                    <select class="form-control" id="event_name" name="event_name">
                                        <option value="">Select Event</option>
                                        @foreach($events as $event)
                                            <option value="{{$event->id}}">{{ $event->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="day_results">
                                    @include('users.fetch-days', ['days' => $days])
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="btnsubmit" name="btnsubmit">Submit</button>
                            </div>
                        </div>
                    </form>
                    <div id="yatrik_results">
                        @include('users.fetch-yatriks', ['yatra' => $yatra])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
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
    (function() {
        $('#fetch-yatrik-form').validate({
            rules: {
                event_name: {
                    required: true,
                },
                day_name: {
                    required: true,
                },
            },
            messages:{
                event_name:{
                    required: "Please select event name."
                },
                day_name:{
                    required: "Plese select day.",
                }
            },
            submitHandler: function (form) {
                $('.loader').show();
                $.ajax({
                    url: "{{ route('users.yatriks.fetch') }}",
                    method: "POST",
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                      'event_id' : $("#event_name").val(),
                      'day_id' : $("#day_name").val(),
                    },
                    success: function (data) {
                        $('.loader').hide();
                        $("#yatrik_results").html('');
                        $("#yatrik_results").show();
                        $('#yatrik_results').append(data);
                        $('#fetch_yatrik_data').DataTable({
                            "buttons": ["csv", "excel"],
                            "pageLength": 100,
                            "scrollY": 400,
                            "destroy": true, 
                            "paging": true,
                            "lengthChange": false,
                            "ordering": true,
                            "info": true,
                            "autoWidth": false,
                            "responsive": true,
                        }).buttons().container().appendTo('#fetch_yatrik_data_wrapper .col-md-6:eq(0)');
                    },
                });
            },
        });
    })();
</script>
@endsection