@extends('layouts.admin-app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Import Yatriks</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="card-title">Import Records</h3>
        </div>
        <form method="POST" action="{{route('admin.yatriks.import.save')}}" class="form" id="import-yatriks-form" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
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
                <div class="form-group">
                    <label for="event_name">Event Name*</label>
                    <select class="form-control" id="event_name" name="event_name">
                        <option value="">Select Event</option>
                        @foreach($events as $event)
                            <option value="{{$event->id}}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="file">Select File* (allowed only xls,xlsx,csv files)</label>
                    <div class="input-group csv_div">
                        <div class="custom-file">             
                            <input type="file" class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>              
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
@section('footer')
<script type="text/javascript">
    $(document).ready(function(){
        $('#import-yatriks-form').validate({
            rules:{
                event_name:{
                    required: true
                },
                file: {
                    required: true,
                    extension: "csv|xls|xlsx",
                    maxsize: 2000000,
                }
            },
            messages:{
                event_name:{
                    required: "Please select event name."
                },
                file: {
                    required: "Please select file.",
                    extension: "Please select valid file.",
                    maxsize: "File size must be less than 2MB."
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "file" ) {
                    $(".csv_div").after(error);
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                $('.loader').show();
                form.submit();
            }
        });
    });
</script>
@endsection