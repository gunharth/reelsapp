<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ReelsApp</title>
	<link rel="stylesheet" href="/css/app.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.css">
</head>
<body>

	<nav class="navbar navbar-inverse navbar-fixed-top">
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
          <li class="active"><a href="/clips">Clips</a></li>
          <li><a href="#">Reels</a></li>
          <li><a href="#">Directors</a></li>
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
</script>

</body>
</html>