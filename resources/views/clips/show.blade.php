@extends('master')

@section('content')

  <div class="row vertical-align">
    <div class="col-md-6"><h1>{{ $clip->title }}</h1></div>
    <div class="col-md-6">
    <a href="/clips/{{ $clip->slug }}/edit" class="btn btn-primary pull-right" role="button"><i class="fa fa-btn fa-pencil"></i>Edit</a></div>
  </div>
  <hr>


	<div class="row">
<video id="my-video" class="video-js" controls preload="auto" width="640" height="360"
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