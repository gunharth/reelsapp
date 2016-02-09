<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ReelsApp</title>
	<!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.css">
  <link href="http://vjs.zencdn.net/5.5.3/video-js.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/app.css">
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">ReelsApp</a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          @if (Auth::check())
          <li><a href="{{ url('/home') }}">Dashboard</a></li>
          <li><a href="/clips">Clips</a></li>
          <li><a href="/reels">Reels</a></li>
          <li><a href="/directors">Directors</a></li>
          @endif
        </ul>

        <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <!--<li><a href="{{ url('/register') }}">Register</a></li>-->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>

      </div><!--/.nav-collapse -->
    </div>
  </nav>

	<div class="container">
		@include('partials.errors')
    @if(Session::has('flash_message'))
          <div id="flashMessage">
          <div class="alert alert-success">
              {{ Session::get('flash_message') }}
          </div>
          </div>
      @endif
    @yield('content')
	</div>
  @include('partials/modal')

<!-- JavaScripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://vjs.zencdn.net/5.5.3/video.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

<script>
  Dropzone.options.thumbDropzone = {
    paramName: 'thumb',
    maxFiles: 1,
    maxFilesize: 50,
    addRemoveLinks: true,
    dictDefaultMessage: 'Drop thumbnail here to upload'
  };
  Dropzone.options.clipDropzone = {
    paramName: 'clip',
    maxFiles: 1,
    maxFilesize: 50,
    dictDefaultMessage: 'Drop clip here to upload'
  };

  $(function() {

    $('#flashMessage').not('.alert-important').delay(1000).slideUp(300);

    $('#confirmDelete').on('show.bs.modal', function(e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);
        $title = $(e.relatedTarget).attr('data-action');
        $(this).find('.modal-action').text($title);

        // Pass form reference to modal for submission on yes/ok
        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
    });


    $('#confirmDelete').find('.modal-footer #confirm').on('click', function() {
        $(this).data('form').submit();
    });

  });
</script>

</body>
</html>