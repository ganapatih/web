@extends('layouts/master')
@section('content')
	<div class="row" id="homepage-content">
		<div class="small-12 medium-6 columns">
			<img src="{{ asset('img/gana-mockup.png') }}" alt="Ganapatih Mockup Image">
		</div>
		<div class="small-12 medium-6 columns">
			<h2>GANAPATIH Application</h2>
			<h4>Disaster Response Application</h4>
			<p>In information technology, an application is a computer program designed to help people perform an activity. An application thus differs from an operating system (which runs a computer), a utility (which performs maintenance or general-purpose chores), and a programming tools (with which computer programs are created).</p>
			<p>Depending on the activity for which it was designed, an application can manipulate text, numbers, graphics, or a combination of these elements. Some application packages offer considerable computing power by focusing on a single task, such as word processing; others, called integrated software, offer somewhat less power but include several applications.</p>
			<a href="#" class="small radius button"><i class="fa fa-download"></i> Download App</a>
		</div>
	</div>
	<div id="login" class="tiny reveal-modal" data-reveal>
		<h2>Sign In</h2>
		<form action="{{ route('login') }}" method="POST">
			<input type="text" placeholder="email">
			<input type="password" placeholder="password">
			<input type="submit" class="tiny radius expand button" value="Sign In">
			<p><small>doesn't have an account? register <a href="#" data-reveal-id="register" data-reveal>here</a> </small></p>
		</form>
		<a class="close-reveal-modal">&#215;</a>
	</div>
	<div id="register" class="tiny reveal-modal" data-reveal>
		<h2>Sign In</h2>
		<form action="{{ route('login') }}" method="POST">
			<input type="text" placeholder="email">
			<input type="password" placeholder="password">
			<input type="submit" class="tiny radius expand button" value="Register">
			<p><small>already have an account? sign in <a href="#" data-reveal-id="login" data-reveal>here</a> </small></p>
		</form>
		<a class="close-reveal-modal">&#215;</a>
	</div>
@stop