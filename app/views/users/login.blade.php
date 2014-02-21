@extends('layouts/master')
@include('elements.modals')

@section('content')
	<div class="row">
		<div id="single-form" class="small-12 medium-4 small-centered medium-centered columns">
			<div id="login">
				<h2>Sign In</h2>

				@if( Session::has('auth.failed') )
					<small class="error">{{ Session::get('auth.failed') }}</small>
				@endif

				@if( Session::has('register.success') )
					<small class="success label" id="single-notif">{{ Session::get('register.success') }}</small>
				@endif

				<form action="{{ route('login.post') }}" method="POST">
					<input type="text" placeholder="email">
					<input type="password" placeholder="password">
					<input type="submit" class="tiny radius button" value="Sign In">
					<p>
						<small>doesn't have an account? register 
							<a href="{{ route('register.get') }}">here</a> 
						</small>
					</p>
				</form>		
			</div>
		</div>
	</div>
@stop