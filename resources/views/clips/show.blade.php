@extends('master')

@section('content')

  <div class="row vertical-align">
    <div class="col-md-6"><h1>{{ $clip->title }}</h1></div>
    <div class="col-md-6">
    <a href="/clips/{{ $clip->slug }}/edit" class="btn btn-primary pull-right" role="button"><i class="fa fa-btn fa-pencil"></i>Edit</a>
    </div>
  </div>
  <hr>


	<div class="row">
<div id="video"></div>
	</div>

@stop

@section('scripts')
<script>
  var playerInstance = jwplayer("video");
  playerInstance.setup({
    file: "/uploads/{{ $clip->video }}",
    image: "{{ $clip->image }}",
    width: 640,
    height: 360,
    //title: 'A Basic Video Embed',
    //description: 'A video with a basic title and description!'
  });
</script>
@stop