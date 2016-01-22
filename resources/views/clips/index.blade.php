@extends('master')

@section('content')

	<h1>Clips</h1>
	<p>search <a href="/clips/create">New</a></p>

	<div class="row">
		@foreach($clips as $clip)
		  <div class="col-sm-6 col-md-3">
		    <div class="thumbnail">
		      <a href="/clips/{{ $clip->slug }}"><img src="{{ !empty($clip->image) && file_exists(public_path('uploads/'.$clip->image) ) ? asset('uploads/'.$clip->image) : 'http://placehold.it/640x360?text=no+image'  }}" alt="{{ $clip->title }}"></a>
		      <div class="caption">
		        <h3>{{ $clip->title }}</h3>
		        <p>...</p>
		        <p>
		        	<a href="/clips/{{ $clip->slug }}" class="btn btn-primary" role="button">Show</a> 
		        	<a href="/clips/{{ $clip->slug }}/edit" class="btn btn-primary" role="button">Edit</a>
		        </p>
		      </div>
		    </div>
		  </div>
		@endforeach
	</div>

	<p>thumb categories client director created /// preview edit /// publish unpublish ///delete</p>
@stop