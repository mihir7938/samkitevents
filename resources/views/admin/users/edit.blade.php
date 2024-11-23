@extends('layouts.admin-app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="card-title">Edit Record</h3>
        </div>
        <form method="POST" action="{{route('admin.users.update.save')}}" class="form" id="edit-users-form" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}" />
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
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="phone">Mobile Number*</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Mobile Number" value="{{$user->phone}}">
                </div>
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="active">Active</label>
                    <div class="group">
                        <input type="radio" id="yes" name="active" value="1" @if($user->status == 1) checked @endif>
                        <label for="yes">Yes</label>
                        <span class="mx-2"></span>
                        <input type="radio" id="no" name="active" value="0" @if($user->status == 0) checked @endif>
                        <label for="no">No</label>
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
        $('#edit-users-form').validate({
            rules:{
                name:{
                    required: true
                },
                phone: {
                    required: true,
                    digits: true,
                    minlength: 10
                },
                email: {
                    required: true,
                    alphanumeric: true
                }
            },
            messages:{
                name:{
                    required: "Please enter name."
                },
                phone:{
                    required: "Plese enter mobile number.",
                },
                email:{
                    required: "Please enter email.",
                    email: "Please provide a valid email."
                }
            }
        });
    });
</script>
@endsection