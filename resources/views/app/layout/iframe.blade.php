<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- Laravel – CSRF Token -->
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
    apiKey: "{{ Config::get('carter.shopify.client_id') }}",
    shopOrigin: "https://{{ Auth::user()->domain }}",
    debug: false
  });
</script>
</head>
<body class="bg-canvas">
 <!-- Main Content -->
 <main>
   @yield('content')
 </main>

<!-- jQuery – Framework (CDN) -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- jQuery – Components -->
<script src="{env('APP_URL')}}/assets/app/js/components.min.js"></script>

<!-- jQuery – Views -->
@yield('js')
</body>
</html>
