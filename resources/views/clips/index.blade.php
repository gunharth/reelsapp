@extends('master')

@section('content')
	<div class="row vertical-align">
		<div class="col-md-6"><h1>Clips</h1></div>
		<div class="col-md-6"><a href="/clips/create" class="btn btn-primary pull-right"><i class="fa fa-btn fa-plus"></i>Add Clip</a></div>
	</div>
	<hr>

		@foreach($clips->chunk(4) as $cliparray)
		  <div class="row">
		  @foreach($cliparray as $clip)
		  <div class="col-sm-6 col-md-3">
		    <div class="thumbnail">
		      <a href="/clips/{{ $clip->slug }}"><img src="{{ $clip->image }}" alt="{{ $clip->title }}"></a>
		      <div class="caption">
		        <h3>{{ $clip->title }}</h3>
		        <p>...</p>
		        <p>
		        	<a href="/clips/{{ $clip->slug }}" class="btn btn-primary" role="button"><i class="fa fa-btn fa-eye"></i>Show</a> 
		        	<a href="/clips/{{ $clip->slug }}/edit" class="btn btn-primary" role="button"><i class="fa fa-btn fa-pencil"></i>Edit</a>
		        </p>
		      </div>
		    </div>
		  </div>
		  @endforeach
		  </div>
		@endforeach

@stop