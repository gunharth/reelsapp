@extends('master')

@section('content')
	<h1>{{ $clip->title}}</h1>
	{!! Form::model($clip,[
        'method' => 'PATCH',
        'route' => ['clips.update', $clip->id],
        'files' => true,
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
    
    <div class="row">
   <div class="col-sm-6">
        {!! Form::open(array(
            'url' => 'clips/thumbUploader', 
            'id' => 'thumbDropzone',
            'class' => 'dropzone',
            'files' => true
            )) !!}
            <div class="fallback">
            <input name="thumb" type="file" multiple />
          </div>
        {!! Form::close() !!}

    </div>
    <div class="col-sm-6">
        {!! Form::open(array(
            'url' => 'clips/clipUploader', 
            'id' => 'clipDropzone',
            'class' => 'dropzone',
            'files' => true
            )) !!}
            <div class="fallback">
            <input name="clip" type="file" multiple />
          </div>
        {!! Form::close() !!}
    </div>
    </div>

@stop