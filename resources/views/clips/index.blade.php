@extends('master')

@section('content')

	<h1>Clips</h1>
	<p>search <a href="/clips/create">New</a></p>
	@foreach($clips as $clip)
	<div class="row"><a href="/clips/{{ $clip->slug }}">{{ $clip->id }} {{ $clip->title }}</a> thumb categories client director created /// preview edit /// publish unpublish ///delete</div>
	@endforeach
@stop