<!doctype html>
<html lang="en">
<head>
    @yield('head')
    <script src="https://cdn.shopify.com/s/assets/external/app.js"></script>
    <script type="text/javascript">
        ShopifyApp.init({
            apiKey: '{{ Config::get('carter.shopify.client_id') }}',
            shopOrigin: 'https://{{ Auth::user()->domain }}',
            debug: {{ app()->environment() !== 'production' ? 'true' : 'false' }}
        });
    </script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body style="background-color: #ebeef0">

@yield('content')

@yield('script')
<script type="text/javascript">
    ShopifyApp.ready(function(){
        ShopifyApp.Bar.loadingOff()
    });
</script>
</body>
</html>