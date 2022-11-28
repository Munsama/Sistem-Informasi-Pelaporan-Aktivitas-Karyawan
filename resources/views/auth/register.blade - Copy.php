<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('assets/login/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/login/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{asset('assets/login/images/bg-cg.jpg')}}');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
					<span class="login100-form-logo">
						<img src="{{asset('assets/login/images/cg.png')}}" class="img-fluid" class="img-thumbnail" class="rounded" width="300px">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Register
					</span>
					
                    @csrf
					<div class="wrap-input100 validate-input" data-validate = "Enter Name">
						<input id="name" type="text" placeholder="Enter Name" class="input100 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>						
							@error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						<span class="focus-input100" data-placeholder="&#xf207;"></span>						
					</div>
					
					<div class="wrap-input100 validate-input" data-validate = "Enter NIK">
						<input id="NIK" type="text" placeholder="Enter NIK" class="input100 @error('NIK') is-invalid @enderror" name="NIK" value="{{ old('NIK') }}" required autocomplete="NIK" autofocus>						
							@error('NIK')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						<span class="focus-input100" data-placeholder="&#xf206;"></span>						
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter Password">
						<input id="password" type="password" placeholder="Enter Password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
							@error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>
					
					<div class="wrap-input100 validate-input" data-validate="Confirm Password">
						<input id="password-confirm" type="password" placeholder="Confirm Password" class="input100" name="password_confirmation" required autocomplete="new-password">
						<span class="focus-input100" data-placeholder="&#xf190;"></span>
					</div>

					<!-- <div class="wrap-input100 validate-input" data-validate = "Enter Position">
                    <input id="position" type="text" placeholder="Enter Position" class="input100 @error('position') is-invalid @enderror" name="position" value="{{ old('position') }}" required autocomplete="position" autofocus>
							@error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						<span class="focus-input100" data-placeholder="&#xf209;"></span>						
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter Department">
                    <input id="department" type="text" placeholder="Enter Department" class="input100 @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}" required autocomplete="department" autofocus>
							@error('department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						<span class="focus-input100" data-placeholder="&#xf209;"></span>						
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Enter Leader">
                    <input id="leader" type="text" placeholder="Enter Leader" class="input100 @error('leader') is-invalid @enderror" name="leader" value="{{ old('leader') }}" required autocomplete="leader" autofocus>
							@error('leader')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						<span class="focus-input100" data-placeholder="&#xf209;"></span>						
					</div>  -->

					<div class="wrap-input100 validate-input" data-validate = "Enter Role">
                    <input readonly id="role" type="text" placeholder="Enter Role" class="input100 " name="role" value="Admin" required autocomplete="role" autofocus>
							
						<span class="focus-input100" data-placeholder="&#xf209;"></span>						
					</div>


					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Register
						</button>
					</div>

					<div class="text-center p-t-90">
					
						<a class="txt1" href="{{ route('login') }}">
							Login
						</a>
                        
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{asset('assets/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/login/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/login/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('assets/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/login/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/login/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('assets/login/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/login/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('assets/login/js/main.js')}}"></script>

</body>
</html>