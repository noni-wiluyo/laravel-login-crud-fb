<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="icon" type="image/ico" href="{{ URL::asset('favicon.ico') }}">
    	@yield('seo')

		<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
		<link href="{{ URL::asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
		<link href="{{ URL::asset('assets/css/jquery.dataTables.css') }}" rel="stylesheet" />

		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<br />
			@include('nav')

			@yield('content')

		<br/>
		</div>
		<footer class="footer">
	      <div class="container">
	        <p class="text-muted"><em>Copyright © Noni Wiluyo.</em></p>
	      </div>
	    </footer>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
		<script src="{{ URL::asset('assets/js/jquery.js') }}"></script>
		<script src="{{ URL::asset('assets/js/jquery.dataTables.js') }}"></script>
		<script>
			$(document).ready(function() {
			    $('#dataTable').dataTable();
			} );
		</script>
	</body>
</html>