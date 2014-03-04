<div id="login" class="tiny reveal-modal" data-reveal>
	<h2>Sign In</h2>
	<form action="{{ route('login.post') }}" method="POST">
		<input type="text" placeholder="email">
		<input type="password" placeholder="password">
		<input type="submit" class="tiny radius expand button" value="Sign In">
		<p>
			<small>doesn't have an account? register 
				<a href="#" data-reveal-id="register" data-reveal>here</a> 
			</small>
		</p>
	</form>
	<a class="close-reveal-modal">&#215;</a>
</div>
<div id="register" class="tiny reveal-modal" data-reveal>
	<h2>Register</h2>
	<form action="{{ route('register.post') }}" method="POST">
		<input type="text" placeholder="email" name="email">
		<input type="password" placeholder="password" name="password">
		<input type="submit" class="tiny radius expand button" value="Register">
		<p>
			<small>
				already have an account? sign in 
				<a href="#" data-reveal-id="login" data-reveal>here</a> 
			</small>
		</p>
	</form>
	<a class="close-reveal-modal">&#215;</a>
</div>