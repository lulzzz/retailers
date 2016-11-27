<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- Laravel – CSRF Token -->
 <meta name="csrf-param" content="_token">
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <title>{{ config('app.name', 'Retailers') }}</title>

 <!-- CSS – Application Stylesheet -->
 <link href="/css/stylesheet.min.css" rel="stylesheet">

 <!-- Javascript – Core Scripts -->
 <script src="/js/core.min.js"></script>

 <!-- Javascript – Shopify Scripts -->
 <script src="https://cdn.shopify.com/s/assets/external/app.js"></script>
 <script type="text/javascript">
 ShopifyApp.init({
     apiKey: '{{ Config::get('carter.shopify.client_id') }}',
     shopOrigin: 'https://{{ Auth::user()->domain }}',
     debug: {{ app()->environment() !== 'production' ? 'true' : 'false' }}
 });
</script>
<!-- Shopify Embedded Settings -->
<script type="text/javascript">
 ShopifyApp.ready(function(){
   ShopifyApp.Bar.loadingOff()
 });
</script>
</head>
<body>

  <!-- <div class="row">
    <div class="col-xs-12">
    <div class="alert alert-info alert-dismissible fade in" role="alert">
        <strong>Tip!</strong> Read the <a href="#">Documentation</a> if you're having trouble.
      </div>
    </div>
  </div>-->
  <!-- Main Content -->
  <header>
   @include('layouts.header')
 </header>
 <!-- Main Content -->
 <main>
   @yield('content')
 </main>
 <!-- Footer Content -->
 <footer>
   @include('layouts.footer')
 </footer>

<!-- jQuery – Framework (CDN) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- jQuery – Components -->
<script src="/js/components.min.js"></script>

<!-- jQuery – Views -->
@yield('js')
</body>
</html>
