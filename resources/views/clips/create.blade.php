@extends('master')

@section('content')
	<h1>Create a new Clip</h1>
	{!! Form::open([
        'route' => 'clips.store',
        'class' => 'form-horizontal'
    ]) !!}
    <div class="form-group">
        {!! Form::label('title','Clip Title',['class' => 'col-md-2']) !!}
        <div class="col-md-4">
        {!! Form::text('title',null,['class' => 'form-control', 'placeholder' => 'Clip Title', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-2 col-md-4">
          {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}
        </div>
      </div>
   {!! Form::close() !!}

@stop