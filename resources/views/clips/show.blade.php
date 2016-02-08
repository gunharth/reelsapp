@extends('master')

@section('content')
	<h1>{{ $clip->title }}</h1>
	<a href="/clips/{{ $clip->slug }}/edit">Edit</a>
	
	<div class="row">
	<img src="/uploads/{{ $clip->image }}" alt="{{ $clip->title }}" class="img-responsive">
	


<video id="my-video" class="video-js" controls preload="auto" width="400" height="100%"
  poster="/uploads/{{ $clip->image }}" data-setup="{fluid: true}">
    <source src="/uploads/{{ $clip->video }}" type='video/mp4'>
    <!--<source src="MY_VIDEO.webm" type='video/webm'>-->
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a web browser that
      <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
    </p>
  </video>
	</div>

@stop