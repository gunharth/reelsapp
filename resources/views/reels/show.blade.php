@extends('master')

@section('content')

  <div class="row vertical-align">
    <div class="col-md-6"><h1>{{ $reel->title }}</h1></div>
    <div class="col-md-6">
    <a href="/reel/{{ $reel->slug }}" class="btn btn-primary pull-right" role="button" target="_blank"><i class="fa fa-btn fa-eye"></i>Public</a>
    <a href="/reels/{{ $reel->slug }}/edit" class="btn btn-primary pull-right" role="button"><i class="fa fa-btn fa-pencil"></i>Edit</a>

    </div>
  </div>
  <hr>

	<div class="row">
    <div class="col-sm-12 col-md-10 col-md-offset-1">
      @if (count($reel->clips)  > 0)
        <div id="video"></div>
      @else
        <p>No clips found</p>
      @endif
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
    @endforeach

  </div>
      
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
    width: "100%",
    aspectratio: "16:9",
    autostart: true
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