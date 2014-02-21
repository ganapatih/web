@extends('layouts/master')

@section('content')
	<div class="row">
		<div id="single-form" class="small-12 medium-4 small-centered medium-centered columns">
			<div id="login">
				<h2>Register</h2>
				<form action="{{ route('register.post') }}" method="POST">
					<input type="text" placeholder="email" name="email">
					@if( !empty($errors->first('email')) )
						<small class="error">{{ $errors->first('email') }}</small>
					@endif

					<input type="password" placeholder="password" name="password">
					@if ( !empty($errors->first('password')) )
						<small class="error">{{ $errors->first('password') }}</small>
					@endif

					<input type="submit" class="tiny radius button" value="Register">
					<p>
						<small>already have an account? sign in 
							<a href="{{ route('login.get') }}">here</a> 
						</small>
					</p>
				</form>		
			</div>
		</div>
	</div>
@stop