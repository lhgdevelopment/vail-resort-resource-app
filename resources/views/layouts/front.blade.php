<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{settings('site_name')}}</title>
	<link href="https://fonts.cdnfonts.com/css/touch" rel="stylesheet">
                
	<link rel="shortcut icon" href="{{asset('storage/' . settings('icon_white'))}}" type="image/x-icon">
	<link rel="stylesheet" href="{{asset('')}}front/css/all.min.css" />
	<link rel="stylesheet" href="{{asset('')}}front/css/fontawesome.min.css" />
	<link rel="stylesheet" href="{{asset('')}}front/css/bootstrap.min.css" />
	<link rel="stylesheet" href="{{asset('')}}front/css/animate.min.css" />
	<link rel="stylesheet" href="{{asset('')}}front/css/style.css" />
</head>
<body>
	<!--================ header section html code start here =================-->
	<header id="header" class="" >
		<nav class="navbar navbar-expand-sm ">
		  <div class="container-fluid">
		    <a class="navbar-brand m-auto" href="{{ url('/') }}"><img src="{{asset('storage/' . settings('logo_white'))}}" alt="logo"></a>
		  </div>
		</nav>
	


		@yield('content')



	<!--================ footer section html code start here =================-->
	<footer id="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="f_logo animated animate-slide-left">
						<img src="{{asset('storage/' . settings('logo_white'))}}" alt="logo">
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="f_list">
						<ul>
							<li>
								<a href="{{route('lto.list')}}" class="text-white text-center bold animated animate-slide-right">LTO Lists</a>
							</li>
						</ul>
					</div>
					<div class="f_bottom">
						<p class="animated animate-slide-right">Copyright © 2024. All Rights Reserved.</p>
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