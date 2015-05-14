@extends('layout.main')

@section('seo')
<title>Welcome</title>
@stop

@section('content')

@if(Auth::check())
<h1>Welcome back, {{ Auth::user()->name }}!</h1>
<h4>Share your story now. ^^</h4>
<a href="{{ URL::route('add') }}"><button>Add Article</button></a>
@else
<h1>Welcome!</h1>
<h4>You have stories to share?<br/>Feel free to sign up and share them with us. ^^</h4>
@endif
<br/>
<p> </p>

@if(Session::has('message'))
<div class="alert alert-success">
	<strong>Success!</strong> {{'message'}}
</div>
@endif
@if(Session::has('success'))
<div class="alert alert-success">
	<strong>Success!</strong> {{'success'}}
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Error!</strong> {{'error'}}
</div>
@endif

<div>
	<?php if(count($articles) == 0){
		echo 'No Data Available!';
	} else { ?>
		<table id="dataTable" class="cell-border hover stripe" cellspacing="0" width="100%">
	    	<thead style="background-color:#608FBF; color:#ffffff;">
				<tr>
					<th>Title</th>
					<th>Text</th>
					<th>Owner</th>
					<th>Action</th>
				</tr>
	    	</thead>
	    	<tbody>
				<?php foreach ($articles as $key => $value) { ?>
					<tr> 
					<td><?php echo $value->title;?></td>
					<td><?php echo strip_tags(substr($value->text, 0, 100));?></td>
					<td><?php echo $value->username;?></td>
					<td>
						<a href="{{ URL::to('article/read/'.$value->id) }}"><button>Read</button></a>
						@if(Auth::check())
							@if($value->userid == Auth::id())
								<a href="{{ URL::to('article/edit/'.$value->id) }}"><button>Edit</button></a>
								<a onclick="return confirm('Delete this article?')" href="{{ URL::to('article/delete/'.$value->id) }}"><button>Delete</button></a>
							@endif
						@endif
					</td>
					</tr>
				<?php } ?>
	   		</tbody>
		</table>
	<?php } ?>
</div>

@stop