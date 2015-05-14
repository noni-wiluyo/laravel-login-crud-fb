@extends('layout.main')

@section('seo')
<title>Sign Up</title>
@stop

@section('content')
<br /><h4>Sign Up</h4><br />

@if(Session::has('success'))
<div class="alert alert-success">
	<strong>Success!</strong> Your account has been created successfully.
</div>
@else
@if(Session::has('unex-error'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Error!</strong> An unexpected error took place. It has been reported. Please try again later.
</div>
@endif
<form method="post" action="{{ URL::route('sign-up-post') }}" role="form"> 

	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<label for="inputName">Name:</label>
		<input type="text" class="form-control" id="inputName" placeholder="Name" name="name"{{ Input::old('name') ? ' value="'. Input::old('name') .'"' : '' }} />
		@if($errors->has('name'))
		<span class="help-block">
			@foreach($errors->get('name') as $message)
			{{ $message }} 
			@endforeach
		</ul></span>
		@endif
	</div>

	<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		<label for="inputEmail">Email:</label>
		<input type="email" class="form-control" id="inputEmail" placeholder="email@mail.com" name="email"{{ Input::old('email') ? ' value="'. Input::old('email') .'"' : '' }} />
		@if($errors->has('email'))
		<span class="help-block">
			@foreach($errors->get('email') as $message)
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

	<button type="submit" class="btn btn-primary">Sign Up</button>
	
	{{ Form::token() }}

</form>

@endif
@stop