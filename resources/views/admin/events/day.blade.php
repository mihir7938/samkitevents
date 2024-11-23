@extends('layouts.admin-app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Route Name</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="card-title">Edit Record</h3>
        </div>
        <form method="POST" action="{{route('admin.events.day.update.save')}}" class="form" id="edit-day-form" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <input type="hidden" name="id" value="{{$day->id}}" />
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
                    <label>Event Name :</label> {{$day->event->name}}
                </div>
                <div class="form-group">
                    <label>Which Day :</label> {{$day->name}}
                </div>
                <div class="form-group">
                    <label for="route_name">Route Name*</label>
                    <input type="text" class="form-control" id="route_name" name="route_name" placeholder="Enter Route Name" value="{{$day->route_name}}">
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
        $('#edit-day-form').validate({
            rules:{
                route_name:{
                    required: true
                }
            },
            messages:{
                route_name:{
                    required: "Please enter route name."
                }
            }
        });
    });
</script>
@endsection