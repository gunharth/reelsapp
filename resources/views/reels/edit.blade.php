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
          {!! Form::label('clip','Clip',['class' => 'col-sm-4']) !!}
          {!! Form::text('clip',null,['class' => 'form-control ui-autocomplete-input clipAutoComplete', 'placeholder' => 'Clip Title']) !!}
          <input type="hidden" name="client_id" id="client_id">

           <ul id="draggablePanelList" class="list-unstyled">
              @foreach($reel->clips as $clip)
              <li class="panel panel-info" id="sortItem_{{ $clip->pivot->id }}">
                <div class="panel-body">
                  <div class="pull-left">
                    <a href="/clips/{{ $clip->slug }}"><img src="{{ $clip->image }}" alt="{{ $clip->title }}" class="img-responsive" style="max-height: 50px; margin-right: 10px"></a>
                  </div>
                  <div class="">{{$clip->title}}</div>
                  <div class="pull-right"><a href="#" class="removeClip" data-pivot="{{ $clip->pivot->id }}">Remove</a></div>
                </div>
              </li>
              @endforeach
            </ul>
          
        </div>
    </div>
    </div>

@stop

@section('scripts')

<script>

  $(function() {
    $("input.clipAutoComplete").autocomplete({
        source: '/clipAutoComplete',
        //appendTo: $('#client').parent(),
        select: function(e, ui) {
            var field = $(this).attr('name');
            var clip_id = ui.item.id;
            // $('#' + field + '_id').val(ui.item.id);
            $.ajax({
                method: 'GET',
                type: 'json',
                url: '/clip/' + ui.item.id
            }).done(function(html) {
                // save to pivot
                var sort_id = $('#draggablePanelList .panel').length;
                $.ajax({
                    method: 'GET',
                    type: 'json',
                    url: '/reel/addclip/{{$reel->id}}/' + ui.item.id + '/' + sort_id+1,
                }).done(function(pivot_id) {
                    
                    $('#draggablePanelList').append(html);
                    $('#draggablePanelList .panel:eq('+sort_id+')').attr('id','sortItem_'+pivot_id);
                    //$('#' + field + 'Details').html(html);
                    //$('.ui-autocomplete').hide();
                })
                    //$('#draggablePanelList').append(html);
                //$('#' + field + 'Details').html(html);
                //$('.ui-autocomplete').hide();
            })
        }

    });

    

    var panelList = $('#draggablePanelList');
        panelList.sortable({
            // Only make the .panel-heading child elements support dragging.
            // Omit this to make then entire <li>...</li> draggable.
           //handle: '.panel-heading', 
           axis: 'y'
            //update: function() {
                /*$('.panel', panelList).each(function(index, elem) {
                     var $listItem = $(elem),
                         newIndex = $listItem.index();
});*/
                     // Persist the new indices.
                    //var order = $('#draggablePanelList').sortable('serialize');
                     //var order = $('#draggablePanelList').sortable('serialize');
                     //console.log(order);
                     //$.post('/reel/sortclips', { order: order });
                     //$.get('/reel/sortclips?'+order);
                     
                     /*$.ajax({
                        method: 'GET',
                        type: 'json',
                        url: '/reel/addclip/{{$reel->id}}/' + ui.item.id + '/' + sort_id,
                    }).done(function(data) {
                        $('#draggablePanelList').append(html);
                        //$('#' + field + 'Details').html(html);
                        //$('.ui-autocomplete').hide();
                    })*/
                
            //}
        });

        function sortClips() {
           var order = $('#draggablePanelList').sortable('serialize');
                     //console.log(order);
                     //$.post('/reel/sortclips', { order: order });
                     $.get('/reel/sortclips?'+order);
        }

        $('#draggablePanelList').on('sortupdate',function() { sortClips() });
        // $('#draggablePanelList').trigger('sortupdate');

        // on delete item reindex clips and update again

        $('#draggablePanelList').on('click', '.removeClip', function() {
            var pivotID = $(this).attr('data-pivot');
            $.ajax({
                        method: 'GET',
                        type: 'json',
                        url: '/reel/removeclip/' + pivotID,
                    }).done(function(data) {
                        $('#sortItem_'+pivotID).remove();
                        $('#draggablePanelList').trigger('sortupdate');
                        //$('#' + field + 'Details').html(html);
                        //$('.ui-autocomplete').hide();
                    })
        })
});
</script>


@stop