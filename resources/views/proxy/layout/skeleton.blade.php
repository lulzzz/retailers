

<!-- Stylesheet :: Retailers -->
<link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}/proxy/css/proxy.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyCTlnXnQV55QOGl22nw627SDxo6yXynJYs"></script>
<!-- jQuery – Framework (CDN) -->
<script src="https://baeb0c7c.ngrok.io/Retailers/public/proxy/js/core.min.js"></script>
<div class="container-fluid"  data-pjax="container">

  @yield('content')

  <script>
    $(function($) {
      if ($.support.pjax) {
        var pjaxOptions = {
          timeout: 1200,
          fragment: 'div[data-pjax="container"]',
          scrollTo: false
        };
        $(document).pjax('a', 'div[data-pjax="container"]', pjaxOptions);
      };
    });
  </script>

  @yield('js')
</div>
