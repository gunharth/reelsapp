@extends('master')

@section('content')
	
    <div class="row vertical-align">
        <div class="col-md-6"><h1>{{ $clip->title}}</h1></div>
        <div class="col-md-6">
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['clips.destroy', $clip->id],
                'style' => 'display: inline;'
            ]) !!}
                 <a href="#" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Clip" data-message="Do you really want to delete the clip  {{ $clip->title }} ?" data-action="Delete" class="btn btn-primary pull-right"><i class="fa fa-btn fa-trash-o" data-toggle="tooltip" data-original-title="delete"></i>Delete Clip</a>
            {!! Form::close() !!}
        </div>
    </div>
    <hr>

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

          {!! Form::submit('Save',['class' => 'btn btn-success']) !!}

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

        <h3>Clip <small>50MB max, mp4 H.264</small></h3>
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