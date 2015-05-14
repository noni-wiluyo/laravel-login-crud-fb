<div class="nav-container">
	<nav>
		<ul class="list-inline">

			@if(Request::is('/'))
			<li><em>Dashboard</em></li>
			@else
			<li><a href="{{ URL::route('home') }}">Dashboard</a></li>
			@endif

			@if(Auth::check())
				@if(Auth::user()->facebook_id == NULL)
					@if(Request::is('account/change-password'))
					<li><em>Change Password</em></li>
					@else
					<li><a href="{{ URL::route('change-password') }}">Change Password</a></li>
					@endif
				@endif

				<li><a href="{{ URL::route('sign-out') }}">Sign Out</a></li>
			@else
				@if(Request::is('account/sign-in'))
				<li><em>Sign In</em></li>
				@else
				<li><a href="{{ URL::route('sign-in') }}">Sign In</a></li>
				@endif

				@if(Request::is('account/sign-up'))
				<li><em>Sign Up</em></li>
				@else
				<li><a href="{{ URL::route('sign-up') }}">Sign Up</a></li>
				@endif

				@if(Request::is('login/fb'))
				<li><em>Connect With Facebook</em></li>
				@else
				<li><a href="{{ URL::to('login/fb') }}">Connect With Facebook</a></li>
				@endif
			@endif
		</ul>
	</nav>
</div>