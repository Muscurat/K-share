<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V15</title>
	<meta charset="UTF-8">
	

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel='stylesheet' type='text/css' />
	<!--===============================================================================================-->
	<link href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel='stylesheet' type='text/css' />
	<!--===============================================================================================-->
	<link href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}" rel='stylesheet' type='text/css' />
	<!--===============================================================================================-->
	<link href="{{ asset('vendor/animate/animate.css') }}" rel='stylesheet' type='text/css' />
	<!--===============================================================================================-->
	<link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel='stylesheet' type='text/css' />
	<!--===============================================================================================-->
	<link href="{{ asset('vendor/animsition/css/animsition.min.css') }}" rel='stylesheet' type='text/css' />
	<!--===============================================================================================-->
	<link href="{{ asset('vendor/select2/select2.min.css') }}" rel='stylesheet' type='text/css' />
	<!--===============================================================================================-->
	<link href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}" rel='stylesheet' type='text/css' />
	<!--===============================================================================================-->
	<link href="{{ asset('css/m.css') }}" rel='stylesheet' type='text/css' />
	<link href="{{ asset('css/u.css') }}" rel='stylesheet' type='text/css' />

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url({{ asset('Photos/login/logo.jpg') }});">
					<span class="login100-form-title-1">
						Sign In
					</span>
				</div>

				<form class="login100-form validate-form" 
				      action="http://192.168.43.169:8000/api/login/teacher" method="POST" >
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="userName" id="userName" 
						       placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" id="password"
						       placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="remember" name="remember" 
							type="checkbox">
							<label class="label-checkbox100" for="remember">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" id="login" name="login">
							Login
						</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>


	<!--===============================================================================================-->
	<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"> </script>
	<!--===============================================================================================-->
	<script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"> </script>
	<!--===============================================================================================-->
	<script src="{{ asset('vendor/bootstrap/js/popper.js') }}"> </script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"> </script>
	<!--===============================================================================================-->
	<script src="{{ asset('vendor/select2/select2.min.js') }}"> </script>
	<!--===============================================================================================-->
	<script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"> </script>
	<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"> </script>
	<!--===============================================================================================-->
	<script src="{{ asset('vendor/countdowntime/countdowntime.js') }}"> </script>

	<script src="{{ asset('js/main.js') }}"> </script>

    <script>

      

    </script>

</body>
</html>