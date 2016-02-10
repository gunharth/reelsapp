@extends('public.master')

@section('content')

  <div class="row vertical-align">
    <div class="col-md-6"><h1>{{ $reel->title }}</h1></div>
  </div>
  <hr>
	<div class="row">
  <div class="col-sm-12 col-md-10 col-md-offset-1">
    <div id="video"></div>
    </div>
  </div>
	<hr>
  <div class="row">
  @foreach($reel->clips as $index => $clip)
      <div class="col-xs-6 col-md-3">
        <div class="thumbnail">
          <a href="/clips/{{ $clip->slug }}" data-index="{{$index}}" class="loadPlaylistItem"><img src="{{ $clip->image }}" alt="{{ $clip->title }}"></a>
          <div class="caption">
            {{ $clip->title }}
          </div>
        </div>
      </div>
      @endforeach</div>

@stop

@section('scripts')
<script>
  var playerInstance = jwplayer("video");
  playerInstance.setup({
      playlist: [
    @foreach($reel->clips as $clip)
    {
      file: '/uploads/{{ $clip->video }}',
      image: '{{ $clip->image }}',
      title: '{{ $clip->title }}',
  },
  @endforeach
],
    //file: "/uploads/{{ $clip->video }}",
    //image: "{{ $clip->image }}",
    width: "100%",
    aspectratio: "16:9",
    autostart: true,
    //title: 'A Basic Video Embed',
    //description: 'A video with a basic title and description!'
  });

  $(function() {
    $('div.row').on('click', '.loadPlaylistItem', function(e) {
      e.preventDefault();
      var item = parseInt($(this).attr('data-index'));
      playerInstance.playlistItem(item);
    });
  });
</script>
@stop