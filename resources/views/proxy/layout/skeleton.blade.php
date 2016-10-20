<html>
<head>

  <!-- Stylesheet :: Retailers -->
  <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}proxy/css/proxy.min.css">

  <!-- jQuery – Framework (CDN) -->
  <script src="{{ env('APP_URL') }}proxy/js/core.min.js"></script>

</head>
<body id="retailers-container">

  <div class="container-fluid">
    @yield('content')
  </div>

  <!-- jQuery – Framework (CDN) -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <!-- jQuery – Components -->
  @yield('js')
</body>
</html>