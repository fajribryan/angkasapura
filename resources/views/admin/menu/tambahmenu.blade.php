<!DOCTYPE html>
<html lang="en">
<head>
	<title>Tambah Menu</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="{{ asset ('/images/icons/favicon.ico') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset ('/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/fonts/iconic/css/material-design-iconic-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/vendor/animate/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/vendor/css-hamburgers/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/vendor/select2/select2.min.css') }}">	
	<link rel="stylesheet" type="text/css" href="{{ asset ('/vendor/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('/css/main.css') }}">
	<style>
    .text-danger {
        font-size: 12px; /* Ubah ukuran font sesuai kebutuhan */
        color: red;
        margin-top: 5px; /* Tambahkan margin atas sesuai kebutuhan */
    }
</style>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{ url('/storemenu') }}" method="POST" enctype="multipart/form-data">
					@csrf
					<span class="login100-form-title p-b-26">
						Tambah Menu
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="nama" value="{{ old('nama') }}">
						<span class="focus-input100" data-placeholder="Nama"></span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="detailmenu" value="{{ old('detailmenu') }}">
						<span class="focus-input100" data-placeholder="Detail Menu"></span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="hargamenu" value="{{ old('hargamenu') }}">
						<span class="focus-input100" data-placeholder="Harga Menu"></span>
					</div>
                    <div class="wrap-input100 validate-input">
                        <label class="input100" for="inputGroupFile01">Upload</label>
                        <input type="file" class="input100" id="fotomenu" name="fotomenu">
                    </div>
                    
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Tambah
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="{{ asset ('/js/main.js') }}"></script>

</body>
</html>