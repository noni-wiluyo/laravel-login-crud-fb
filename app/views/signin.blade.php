@extends('layout.main')

@section('seo')
<title>Sign In</title>
@stop

@section('content')
<br /><h4>Sign In</h4><br />

@if(Session::has('error'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Error!</strong> 
	{{ (Session::get('error') == 'invalid-account') ? 'Invalid email and/or password. Please try again.' : '' }}
	{{ (Session::get('error') == 'account-doesnt-exist') ? 'Account does not exist. Please try again or '.link_to_route('sign-up', 'Sign Up') : '' }}
	{{ (Session::get('error') == 'inactive-account') ? 'Account not active, please check your email and activate.' : '' }}
	{{ (Session::get('error') == 'unexpected-error') ? 'Unexpected error occurred. Please try again.' : '' }}
	{{ (Session::get('error') == 'unactive-account') ? 'Unexpected error occurred while activating your account. Please try again later.' : '' }}
</div>
@endif

@if(Session::has('success'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Success!</strong> Your account has been activated.
</div>
@endif

<form method="post" action="{{ URL::route('sign-in-post') }}" role="form"> 

	<div class="form-group">
		<label for="inputEmail">Email:</label>
		<input type="email" class="form-control" id="inputEmail" placeholder="email@mail.com" name="email"{{ Input::old('email') ? ' value="'. e(Input::old('email')) .'"' : '' }} />
	</div>

	<div class="form-group">
		<label for="inputPassword">Password:</label>
		<input type="password" class="form-control" id="inputPassword" name="password" />
	</div>

	<button type="submit" class="btn btn-primary">Sign In</button>
	
	{{ Form::token() }}

</form>
@stop