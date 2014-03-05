<div id="login" class="tiny reveal-modal" data-reveal>
	<h2>Sign In</h2>
		
	{{ Form::open(array('route' => 'login.post')) }}
		<input type="text" placeholder="email" name="email">
		<input type="password" placeholder="password" name="password">
		<input type="submit" class="tiny radius expand button" value="Sign In">
		<p>
			<small>doesn't have an account? register 
				<a href="#" data-reveal-id="register" data-reveal>here</a> 
			</small>
		</p>
	{{ Form::close() }}
	
	<a class="close-reveal-modal">&#215;</a>
</div>
<div id="register" class="tiny reveal-modal" data-reveal>
	<h2>Register</h2>
			
	{{ Form::open(array('route' => 'register.post')) }}
		<input type="text" placeholder="email" name="email">
		<input type="password" placeholder="password" name="password">
		<input type="submit" class="tiny radius expand button" value="Register">
		<p>
			<small>
				already have an account? sign in 
				<a href="#" data-reveal-id="login" data-reveal>here</a> 
			</small>
		</p>
	{{ Form::close() }}
	
	<a class="close-reveal-modal">&#215;</a>
</div>