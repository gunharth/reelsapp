@extends('master')

@section('content')

  <div class="row vertical-align">
    <div class="col-md-6"><h1>{{ $reel->title }}</h1></div>
    <div class="col-md-6">
    <a href="/reels/{{ $reel->slug }}/edit" class="btn btn-primary pull-right" role="button"><i class="fa fa-btn fa-pencil"></i>Edit</a></div>
  </div>
  <hr>


	<div class="row">
  @foreach($reel->clips as $clip)
    {{$clip->title}}
    @endforeach


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
<script>
  var player = videojs('my-video');

player.playlist([{
  sources: [{
    src: 'http://media.w3.org/2010/05/sintel/trailer.mp4',
    type: 'video/mp4'
  }],
  poster: 'http://media.w3.org/2010/05/sintel/poster.png'
}, {
  sources: [{
    src: 'http://media.w3.org/2010/05/bunny/trailer.mp4',
    type: 'video/mp4'
  }],
  poster: 'http://media.w3.org/2010/05/bunny/poster.png'
}, {
  sources: [{
    src: 'http://vjs.zencdn.net/v/oceans.mp4',
    type: 'video/mp4'
  }],
  poster: 'http://www.videojs.com/img/poster.jpg'
}, {
  sources: [{
    src: 'http://media.w3.org/2010/05/bunny/movie.mp4',
    type: 'video/mp4'
  }],
  poster: 'http://media.w3.org/2010/05/bunny/poster.png'
}, {
  sources: [{
    src: 'http://media.w3.org/2010/05/video/movie_300.mp4',
    type: 'video/mp4'
  }],
  poster: 'http://media.w3.org/2010/05/video/poster.png'
}]);

// Play through the playlist automatically.
player.playlist.autoadvance(0);
  
</script>
@stop