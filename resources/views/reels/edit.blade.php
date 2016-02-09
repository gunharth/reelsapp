@extends('master')

@section('content')
	
    <div class="row vertical-align">
        <div class="col-md-6"><h1>{{ $reel->title}}</h1></div>
        <div class="col-md-6">
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['reels.destroy', $reel->id],
                'style' => 'display: inline;'
            ]) !!}
                 <a href="#" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Clip" data-message="Do you really want to delete the clip  {{ $reel->title }} ?" data-action="Delete" class="btn btn-primary pull-right"><i class="fa fa-btn fa-trash-o" data-toggle="tooltip" data-original-title="delete"></i>Delete Reel</a>
            {!! Form::close() !!}
        </div>
    </div>
    <hr>

    <div class="row">
    <div class="col-md-6">
    <div class="well">
	{!! Form::model($reel,[
        'method' => 'PATCH',
        'route' => ['reels.update', $reel->id],
        'files' => true
    ]) !!}
    <div class="form-group">
        {!! Form::label('title','Reel Title') !!}
        {!! Form::text('title',null,['class' => 'form-control', 'placeholder' => 'Reel Title', 'required' => 'required']) !!}
    </div>

          {!! Form::submit('Save',['class' => 'btn btn-success']) !!}

   {!! Form::close() !!}
   </div>
   </div>
    
    <div class="col-md-6">
       <div class="well">
            <h3>Clips</h3>
           <ul id="draggablePanelList" class="list-unstyled">
                @foreach($reel->clips as $clip)

            


      <li class="panel panel-info">
          
          <div class="panel-body">
          <div class="pull-left">
          <a href="/clips/{{ $clip->slug }}"><img src="{{ $clip->image }}" alt="{{ $clip->title }}" class="img-responsive" style="max-height: 50px; margin-right: 10px"></a></div>
          <div class="">{{$clip->title}}</div>
          <div class="pull-right">Remove</div>

          </div>
      </li>

                @endforeach
            </ul>
            
        </div>
    </div>
    </div>

@stop