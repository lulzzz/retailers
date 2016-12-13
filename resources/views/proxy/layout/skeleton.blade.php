  <!-- Stylesheet :: Retailers -->
  <link rel="stylesheet" type="text/css" href="{{ env('APP_URL') }}/assets/proxy/css/stylesheet.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="{{env('APP_URL')}}/assets/proxy/js/core.min.js"></script>

  @if($retailers->isEmpty())
    <div class="row">
      <div class="col-xs-12 text-xs-center pa-3">
        <h1 class="top-header">No Retailers Found</h1>
        <h2 class="sub-header">Sorry! We couldn't find any Retailers at this time. Please check back later.</h2>
      </div>
    </div>
  @else
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
      @yield('script')
      <script src="https://maps.google.com/maps/api/js?key=AIzaSyAMElu9QAKi3qU68wXQ5yJSCG_YNWVU3do"></script>
      <script>
      loadjs([
        '{{env('APP_URL')}}/assets/proxy/js/qwest.min.js',
        '{{env('APP_URL')}}/assets/proxy/js/map_styles.min.js',
        '{{env('APP_URL')}}/assets/proxy/js/map.min.js'],
        {
          success: function() {

            @yield('js')

          }
        }
      );
      </script>
    </div>
  @endif
