<!DOCTYPE html>
<html lang="en">
<head>
	<title>Teacher form</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">


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
	<link href="{{ asset('css/main.css') }}" rel='stylesheet' type='text/css' />
	<link href="{{ asset('css/util.css') }}" rel='stylesheet' type='text/css' />

	<link rel="stylesheet" type="text/css" href="{{ asset('css/input_style.css') }}" />
<!--===============================================================================================-->
	<!--<link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="../assets/css/input_style.css" />-->
</head>
<body>


	<div class="container-contact100">
		<div class="contact100-map"></div>

		<div class="wrap-contact100">
			<div class="contact100-form-title" style="background-image: url({{ asset('Photos/login/logo.jpg') }});">
			</div>

          	<div class="jumbotron">
			    <h1>Create a Toast</h1>      
			    <p>Bootstrap is the most popular HTML, CSS, and JS framework for developing responsive.</p>
			 </div>
     
			<form class="contact100-form validate-form">

				<div class="wrap-input100 validate-input">
					<span class="label-input100">Domain :</span>
					<select class="form-control" id="domain" name="domain">
					    <option>1</option>
					    <option>2</option>
					    <option>3</option>
					    <option>4</option>
					</select>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input">
					<span class="label-input100">Specialty :</span>
						<select class="form-control" id="specialty" name="specialty">
						    <option>1</option>
						    <option>2</option>
						    <option>3</option>
						    <option>4</option>
					    </select>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input100">Toast :</span>
					<textarea class="form-control" id="toast" name="toast" placeholder="Toast text..." rows="10"></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input100">Keywords :</span>
					<input type="text" class="form-control" id="keywords" name="keywords"/>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" id="send">
						<span>
							Apply
							<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

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

	<script  src="{{ asset('js/view.js') }}"></script>
	<script src="{{ asset('js/tokenizer/tokenizer.js') }}"></script>

	<script>
	  /*window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');*/
	</script>

	<script>
        $input = $('#keywords').tokenizer();
        $('#send').click(function () {
            var list = $input.tokenizer('get');

            //$('#my-input').val("ghteggreg");
            // $('#show').text(typeof 4);

            console.log(list);

        });

	</script>

</body>
</html>
