<!DOCTYPE html>
<html lang="en">
<head>
	<title>Samkit Events | Log In</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{asset('css/login.css')}}">
	<link rel="stylesheet" href="{{asset('css/core.min.css')}}">
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />
</head>
<body>
	<div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">		
		<div class="text-white mb-3 mb-md-0 header">
			Samkit Events
		</div>		
  	</div>
  	<section class="vh-100">
	  	<div class="container-fluid h-custom">
			<div class="row d-flex justify-content-center align-items-center h-100">
		  		<div class="col-md-9 col-lg-6 col-xl-5">
					<h1>SAMKIT EVENTS</h1>
		  		</div>
		  		<div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">       			  
					<form id="form-login" name="loginform" class="form-login" action="{{route('authenticate')}}" method="POST">	  
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
			  			<div class="form-outline mb-4">
							<label class="form-label" for="email">Email</label>
							<input type="text" id="email" name="email" class="form-control form-control-lg" value="{{old('email')}}" maxlength="155" />
			  			</div>
					  	<div class="form-outline mb-3">
							<label class="form-label" for="password">Password</label>
							<input type="password" id="password" name="password" class="form-control form-control-lg" maxlength="16" />
					  	</div>
			  			<div class="d-flex justify-content-between align-items-center">
							<div class="form-check mb-0">
				  				<input class="form-check-input me-2" type="checkbox" value="" id="rememberme"name="rememberme" />
				  				<label class="form-check-label" for="form2Example3">
									Remember me
				  				</label>
							</div>
							<!--<a href="{{route('forget_password')}}" class="text-body">Forgot password?</a>-->
			  			</div>
			  			<div class="text-center text-lg-start mt-4 pt-2">
							<input class="btn btn-primary btn-lg" type="submit" id="btnsubmit" name="btnsubmit" value="Login" style="padding-left: 2.5rem; padding-right: 2.5rem;"/>
							<input type="submit" value="Cancel" id="reset" name="reset" class="btn btn-primary btn-lg">
			  			</div>
					</form>
		  		</div>
			</div>
	  	</div>
	  	<div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary footer">
			<div class="text-white mb-3 mb-md-0">
		  		Copyright © <?php echo date("Y"); ?> Strong Services. All Rights Reserved - <a href="http://www.strongservices.in/terms-conditions/">Terms & Conditions</a> - <a href="http://www.strongservices.in/key-features/">Key Features</a>
			</div>
			<div>
		  		<a href="#" class="text-white me-4">
					<i class="icon fa fa-facebook"></i>
		  		</a>
		  		<a href="#" class="text-white me-4">
					<i class="icon fa fa-twitter"></i>
		  		</a>
		  		<a href="#" class="text-white me-4">
					<i class="icon fa fa-google"></i>
		  		</a>
			</div>
	  	</div>
	</section>
	<script src="{{asset('js/jquery.min.js')}}"></script>
	<script src="{{asset('js/jquery-migrate-3.0.1.min.js')}}"></script>
	<script src="{{asset('js/popper.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/additional-methods.min.js"></script>
	<script src="{{asset('js/validation-additional.js')}}"></script>
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
</body>
</html>