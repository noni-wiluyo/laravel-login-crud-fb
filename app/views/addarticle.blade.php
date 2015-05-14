@extends('layout.main')

@section('seo')
<title>Add Article</title>
@stop

@section('content')
<a href="{{ URL::route('home') }}">Dashboard</a> > Add
<br /><h4>Add Article</h4><br />

@if(Session::has('success'))
<div class="alert alert-success">
	<strong>Success!</strong> Your article has been submited successfully.
</div>
@else
@if(Session::has('unex-error'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Error!</strong> An unexpected error took place. It has been reported. Please try again later.
</div>
@endif
<form method="post" action="{{ URL::route('add-post') }}" role="form"> 

	<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
		<label for="inputTitle">Title:</label>
		<input type="text" class="form-control" id="inputTitle" placeholder="Title" name="title"{{ Input::old('title') ? ' value="'. Input::old('title') .'"' : '' }} />
		@if($errors->has('title'))
		<span class="help-block">
			@foreach($errors->get('title') as $message)
			{{ $message }} 
			@endforeach
		</ul></span>
		@endif
	</div>

	<div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
		<label for="inputText">Text:</label>
		<textarea class="form-control" id="inputText" style="height:200px" placeholder="Write your article here" name="text">{{ Input::old('text') ? Input::old('text') : '' }} </textarea>
		@if($errors->has('text'))
		<span class="help-block">
			@foreach($errors->get('text') as $message)
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