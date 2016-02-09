@extends('master')

@section('content')
	<h1>{{ $clip->title}}</h1>

    <div class="row">
    <div class="col-md-6">
    <div class="well">
	{!! Form::model($clip,[
        'method' => 'PATCH',
        'route' => ['clips.update', $clip->id],
        'files' => true
    ]) !!}
    <div class="form-group">
        {!! Form::label('title','Clip Title') !!}
        {!! Form::text('title',null,['class' => 'form-control', 'placeholder' => 'Clip Title', 'required' => 'required']) !!}
    </div>

          {!! Form::submit('Save',['class' => 'btn btn-primary']) !!}

   {!! Form::close() !!}
   </div>
   </div>
    
    <div class="col-md-6">
   <div class="well">
        <h3>Thumbnail</h3>
        {!! Form::open(array(
            'route' => ['addClipThumb', $clip->id],
            'id' => 'thumbDropzone',
            'class' => 'dropzone',
            'files' => true
            )) !!}
            <div class="fallback">
            <input name="thumb" type="file" multiple />
          </div>
        {!! Form::close() !!}

        <h3>Clip <small>50MB max</small></h3>
        {!! Form::open(array(
            'route' => ['addClip', $clip->id],
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
    </div>

@stop