<li class="panel panel-info">
  <div class="panel-body">
    <div class="pull-left">
      <a href="/clips/{{ $clip->slug }}"><img src="{{ $clip->image }}" alt="{{ $clip->title }}" class="img-responsive" style="max-height: 50px; margin-right: 10px"></a>
    </div>
    <div class="">{{$clip->title}}</div>
    <div class="pull-right"><a href="#" class="removeClip">Remove</a></div>
  </div>
</li>