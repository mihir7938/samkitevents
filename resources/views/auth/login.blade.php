@extends('layouts.app')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Login</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
        	<div class="row">
          		<div class="col-md-12">
          			<form id="form-login" name="loginform" class="form-login w-50 mx-auto" action="{{route('authenticate')}}" method="POST">
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
								<h3 class="card-title">Login Form</h3>
						  	</div>
			                <div class="card-body">
					  			<div class="form-group">
			                    	<label for="email">Email address</label>
			                    	<input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" maxlength="155">
			                  	</div>
							  	<div class="form-group">
									<label for="password">Password</label>
									<input type="password" id="password" name="password" class="form-control" placeholder="Enter password" maxlength="16" />
							  	</div>
					  			<div class="form-check">
					  				<input class="form-check-input me-2" type="checkbox" value="" id="rememberme"name="rememberme" />
					  				<label class="form-check-label" for="rememberme">
										Remember me
					  				</label>
								</div>
			                </div>
			                <div class="card-footer">
			                    <button type="submit" class="btn btn-primary" id="btnsubmit" name="btnsubmit">Submit</button>
			                    <input type="button" value="Cancel" id="reset" name="reset" class="btn btn-default float-right">
			                </div>
			            </div>
			        </form>
		        </div>
		    </div>
        </div>
    </div>
@endsection
@section('footer')
	<script src="{{asset('admin/js/validation-additional.js')}}"></script>
	<script>
		(function() {
			$('#form-login').validate({
				rules: {
					email: {
						required: true,
						alphanumeric: true,
						maxlength: 155,
					},
					password: {
						required: true,
						minlength:8,
						maxlength: 16,
					},
				},
				messages:{
				 	email:{
				 		required: "Please enter your email.",
				 		email: "Please provide a valid email."
				 	},
				 	password:{
				 		required: "Plese enter your password.",
				 	}
				},
				submitHandler: function (form) {
					form.submit();
				},
			});
		})();
	</script>
@endsection