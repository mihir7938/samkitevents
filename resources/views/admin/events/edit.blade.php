@extends('layouts.admin-app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Event</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="card-title">Edit Record</h3>
        </div>
        <form method="POST" action="{{route('admin.events.update.save')}}" class="form" id="edit-event-form" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <input type="hidden" name="id" value="{{$event->id}}" />
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
                    <label for="name">Name*</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{$event->name}}">
                </div>
                {{--<div class="form-group">
                    <label for="start_date">Start Date*</label>
                    <input type="text" id="start_date" name="start_date" class="form-control" placeholder="Start Date" value="{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y')}}">
                </div>
                <div class="form-group">
                    <label for="name">End Date*</label>
                    <input type="text" id="end_date" name="end_date" class="form-control" placeholder="End Date" value="{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y')}}">
                </div>--}}
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
        $('#edit-event-form').validate({
            rules:{
                name:{
                    required: true
                },
                /*start_date:{
                    required: true
                },
                end_date:{
                    required: true
                }*/
            },
            messages:{
                name:{
                    required: "Please enter name."
                },
                /*start_date:{
                    required: "Please select start date."
                },
                end_date:{
                    required: "Please select end date."
                }*/
            }
        });
    });
</script>
@endsection