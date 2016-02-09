@extends('master')

@section('content')
	<div class="row vertical-align">
        <div class="col-md-6"><h1>Add Clip</h1></div>
        <div class="col-md-6">&nbsp;</div>
    </div>
    <hr>
	
<div class="row">
    <div class="col-md-6">
    <div class="well">
    {!! Form::open([
        'route' => 'clips.store'
    ]) !!}
    <div class="form-group">
        {!! Form::label('title','Clip Title') !!}
        {!! Form::text('title',null,['class' => 'form-control', 'placeholder' => 'Clip Title', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
          {!! Form::submit('Save',['class' => 'btn btn-success']) !!}
      </div>
   {!! Form::close() !!}
   </div>
   </div>
   </div>

@stop