<html>
<head>

  <!-- Stylesheet :: Retailers -->
  <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}proxy/css/proxy.min.css">

  <!-- jQuery – Framework (CDN) -->
  <script src="{{ env('APP_URL') }}proxy/js/core.min.js"></script>
</head>
<body id="retailers-container">

  <div class="container-fluid">
    <div data-pjax="container">
      @yield('content')

    </div>
  </div>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="{{ env('APP_URL') }}js/plugins/pjax.min.js"></script>

  <script>
    jQuery(function($) {
      if ($.support.pjax) {
        var pjaxOptions = {
          timeout: 1800,
          fragment: 'div[data-pjax="container"]',
          scrollTo: false
        };
        $(document).pjax('a', 'div[data-pjax="container"]', pjaxOptions);
      };
    });
  </script>  
  <!-- jQuery – Components -->
  @yield('js')
</body>
</html>