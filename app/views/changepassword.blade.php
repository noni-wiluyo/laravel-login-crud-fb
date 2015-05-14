@extends('layout.main')

@section('seo')
<title>Change Password</title>
@stop

@section('content')
<br /><h4>Change password?</h4><br />

@if(Session::has('success'))
<div class="alert alert-success">
	<strong>Success</strong> Your password has been changed successfully.
</div>
@else

@if(Session::has('error'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Error!</strong> Unexpected error occurred. Please try again.
</div>
@endif

@if(Session::has('warning'))
<div class="alert alert-warning">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Alert!</strong> You recently requested a new password. You may want to change your password.
</div>
@endif

<form method="post" action="{{ URL::route('change-password-post') }}" role="form"> 

	<div class="form-group{{ ($errors->has('old_password')) ? ' has-error' : '' }}">
		<label for="inputOldPassword">Current Password:</label>
		<input type="password" class="form-control" id="inputOldPassword" name="old_password" />
		@if($errors->has('old_password'))
		<span class="help-block">
			@foreach($errors->get('old_password') as $message)
			{{ $message }} 
			@endforeach
		</ul></span>
		@endif
	</div>

	<div class="form-group{{ ($errors->has('password') || $errors->has('password_again')) ? ' has-error' : '' }}">
		<label for="inputPassword">Password:</label>
		<input type="password" class="form-control" id="inputPassword" name="password" />
		@if($errors->has('password'))
		<span class="help-block">
			@foreach($errors->get('password') as $message)
			{{ $message }} 
			@endforeach
		</ul></span>
		@endif
	</div>

	<div class="form-group{{ $errors->has('password_again') ? ' has-error' : '' }}">
		<label for="inputPasswordAgain">Re-type password:</label>
		<input type="password" class="form-control" id="inputPasswordAgain" name="password_again" />
		@if($errors->has('password_again'))
		<span class="help-block">
			@foreach($errors->get('password_again') as $message)
			{{ $message }} 
			@endforeach
		</ul></span>
		@endif
	</div>

	<button type="submit" class="btn btn-primary">Submit</button>
	{{ Form::token() }}

</form>
@endif
@stop