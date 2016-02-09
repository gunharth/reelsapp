@extends('master')

@section('content')
	<div class="row vertical-align">
		<div class="col-md-6"><h1>Reels</h1></div>
		<div class="col-md-6"><a href="/reels/create" class="btn btn-primary pull-right"><i class="fa fa-btn fa-plus"></i>Add Reel</a></div>
	</div>
	<hr>

		@foreach($reels->chunk(4) as $reelarray)
		  <div class="row">
		  @foreach($reelarray as $reel)
		  <div class="col-sm-6 col-md-3">
		    <div class="thumbnail">
		      <div class="caption">
		        <h3>{{ $reel->title }}</h3>
		        <p>...</p>
		        <p>
		        	<a href="/reels/{{ $reel->slug }}" class="btn btn-primary" role="button"><i class="fa fa-btn fa-eye"></i>Show</a> 
		        	<a href="/reels/{{ $reel->slug }}/edit" class="btn btn-primary" role="button"><i class="fa fa-btn fa-pencil"></i>Edit</a>
		        </p>
		      </div>
		    </div>
		  </div>
		  @endforeach
		  </div>
		@endforeach

@stop