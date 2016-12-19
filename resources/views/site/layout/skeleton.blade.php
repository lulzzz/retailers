<!doctype html>
<html class="no-js" lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <title>@yield('title')</title>
   <meta name="description" content="@yield('description')">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <link rel="apple-touch-icon" href="apple-touch-icon.png">
   <link href="//fonts.googleapis.com/css?family=Cormorant+Garamond" rel="stylesheet">
   <link rel="stylesheet" href="{{env('APP_URL')}}/site/css/site.min.css">

   <script src="https://panoply.github.io/portfolio/assets/core.min.js"></script>
   <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
   <script src="https://panoply.github.io/portfolio/assets/components.min.js"></script>
</head>
<body data-pjax="main">
   <div class="content--loading"></div>

   <div class="container">
      <header class="px-sm-0">
         @yield('header')
      </div>
   </header>

   @include('site.layout.drawer')
   <main id="container" class="is-moved-by-drawer">
      @yield('content')
   </main>
   <footer>
      <div class="footer">
         <a class="footer-badge" href="https://panoply.github/portfolio">
            <small><b>BY PANOPLY</b><p>ENGINEERING E-COMMERCE</p></small>
         </a>
      </div>
   </footer>
</div>

<script>
loadjs(['https://panoply.github.io/portfolio/assets/pjax.min.js'],
{ success: function() {
   skriptz.pjaxMain();
}
});
</script>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88969411-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
