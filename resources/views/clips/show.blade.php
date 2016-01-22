@extends('master')

@section('content')
	<h1>{{ $clip->title }}</h1>
	<a href="/clips/{{ $clip->slug }}/edit">Edit</a>

	<img src="/uploads/{{ $clip->image }}" alt="{{ $clip->title }}">
	

	

@stop