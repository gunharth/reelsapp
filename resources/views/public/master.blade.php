<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ReelsApp</title>
	<!-- Fonts -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.css">
  <link rel="stylesheet" href="/css/app.css">
</head>
<body style="padding-top: 20px;">

<div class="container">
    @yield('content')
  </div>

<!-- JavaScripts -->
<script src="/js/app.js"></script>
​<script src="/js/vendor/jwplayer-7.2.4/jwplayer.js"></script>
<script>jwplayer.key="xCERQViWBtMxSklCl+RrOBdnJHk2qOE3ZVmLGA==";</script>

@yield('scripts')

</body>
</html>