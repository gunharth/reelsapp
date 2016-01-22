@extends('master')

@section('content')
	<h1>{{ $clip->title }}</h1>
	<a href="/clips/{{ $clip->slug }}/edit">Edit</a>

	{{ $clip->image }}
	

@stop