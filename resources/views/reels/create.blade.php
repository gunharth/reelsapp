@extends('master')

@section('content')
	<h1>Create new Reel</h1>

	{!! Form::open([
        'route' => 'reels.store',
        'class' => 'form-horizontal'
    ]) !!}
    <div class="form-group">
        {!! Form::label('title','Reel Title',['class' => 'col-sm-2']) !!}
        <div class="col-sm-10">
        {!! Form::text('title',null,['class' => 'form-control', 'placeholder' => 'Reel Title']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
        </div>
      </div>
   {!! Form::close() !!}

@stop