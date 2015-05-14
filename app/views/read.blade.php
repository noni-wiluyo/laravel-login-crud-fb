@extends('layout.main')

@section('seo')
<title>Read</title>
@stop

@section('content')
<a href="{{ URL::route('home') }}">Dashboard</a> > Read
<h1>{{ $article->title}}</h1>
<h3>Author : {{ $article->username }}</h3>
<br/>
<p>{{ $article->text }}</p>
<br/>
<p><em>{{ date('d M Y', strtotime($article->created_at)) }}</em></p>

@stop