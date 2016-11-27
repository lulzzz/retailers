<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <link href="//fonts.googleapis.com/css?family=Cormorant+Garamond" rel="stylesheet">
  <link rel="stylesheet" href="https://panoply.github.io/portfolio/assets/stylesheet.min.css">
  <link rel="stylesheet" href="{{env('APP_URL')}}/css/stylesheet.min.css">

  <script src="https://panoply.github.io/portfolio/assets/core.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="https://panoply.github.io/portfolio/assets/components.min.js"></script>
</head>
<body>
  <div class="content--loading"></div>

  <div class="container">
    <header class="px-sm-0">
    </header>

    <main id="container" class="is-moved-by-drawer" data-pjax="main">
      <div class="vertical-align">
        <div class="logo">
          <h1><a href="#">RETAILERS</a></h1>
          <div class="sub-header">
            An integrated Shopify application that enables users to create, manage and showcase brick and mortor retail locations selling their products.
          </div>
          <div class="py-2">
            <a href="/shopify/signup" class="btn b">
            </a>
          </div>
        </div>
      </main>
      <footer>
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
</body>
</html>
