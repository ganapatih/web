<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ganapatih</title>
	@section('head')
	<link rel="stylesheet" href="{{ asset('css/foundation.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700' rel='stylesheet' type='text/css'>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<link rel="shortcut icon" href="/favicon.png">
	<!--- kalo disini diload, map nya muncul-->
	<link rel="stylesheet" href="{{ asset('css/map.css') }}">
	@show
</head>
<body>
	<div id="header">
		<div class="row">
			<div class="small-12 medium-8 columns">
				<a href="{{ route('home') }}" id="logo"><img src="{{ asset('img/logo.png') }}" alt="Ganapatih"></a>
				<div class="divider"></div>
				<!--<ul>
					<li>
						<a href="#">About Us</a>
					</li>
					<li>
						<a href="#">Documentation</a>
					</li>
					<li>
						<a href="#">Contributor</a>
					</li>
				</ul>-->
			</div>
			<div class="small-12 medium-4 columns">
				<div class="text-right">
				
					@if(isset($is_login) && true == $is_login)
						<a href="{{ route('dashboard') }}">dashboard</a> |
						<a href="{{ route('logout.get') }}">logout</a>
					@else
						<a href="#" data-reveal-id="login" data-reveal>login</a> |
						<a href="#" data-reveal-id="register" data-reveal>register</a>
					@endif
															
				</div>
			</div>
		</div>
	</div>
	@yield('content')
	<div id="footer" class="row text-center">
		<p>GANAPATIH &copy; 2014 | PHP Indonesia</p>
	</div>
	<script src="{{ asset('js/vendor/jquery.js') }}"></script>
	<script src="{{ asset('js/foundation.min.js') }}"></script>
	@section('footer')
	@show
	<script>$(document).foundation();</script>
</body>
</html>