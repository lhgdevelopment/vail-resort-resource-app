<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ settings('site_name', 'VAIL RESORTS') }} | Home page</title>
	<link rel="shortcut icon" href="{{asset('')}}front/images/VR_FandB_icon_blk.png" type="image/x-icon">
	<link rel="stylesheet" href="{{asset('')}}front/css/all.min.css" />
	<link rel="stylesheet" href="{{asset('')}}front/css/fontawesome.min.css" />
	<link rel="stylesheet" href="{{asset('')}}front/css/bootstrap.min.css" />
	<link rel="stylesheet" href="{{asset('')}}front/css/animate.min.css" />
	<link rel="stylesheet" href="{{asset('')}}front/css/style.css" />
</head>
<body>
	<!--================ header section html code start here =================-->
	<header id="header" class="" >
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		  <div class="container-fluid">
		    <a class="navbar-brand m-auto" href="{{url('/')}}"><img src="{{ asset('storage/' . settings('logo_black')) }}" alt="logo"></a>
		  </div>
		</nav>


        @yield('content')



	<!--================ footer section html code start here =================-->
	<footer id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="f_logo">
						<img src="{{ asset('storage/' . settings('logo_white')) }}" alt="logo">
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="f_bottom">
						<p>Copyright © 2024. All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--================ footer section html code end here =================-->


	<script src="{{asset('')}}front/js/bootstrap.bundle.min.js"></script>
  	<script src="{{asset('')}}front/js/main.js"></script>
</body>
</html>