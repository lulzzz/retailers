<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Stylesheet :: Retailers -->
    <link rel="stylesheet" type="text/css" href="/proxy/css/proxy.min.css">

    <!-- jQuery – Framework (CDN) -->
    <script src="/proxy/js/core.min.js"></script>

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #111;
            font-family: 'Raleway';
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
            width:500px;

        }

        .title {
            font-size: 94px;
        }

        .links > a {
            color: #111;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 400;
            letter-spacing: .2rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                <img src="images/logo.png" width="200">
            </div>

            <div class="links">
               <h1>RETAILERS</h1>
           </div>

           <div class="row">
               <div class="col-sm-6">
                   <h3><a href="#">Install Application</a></h3>
               </div>
               <div class="col-sm-6">
                   <h3><a href="#">Documentation</a></h3>
               </div> 
           </div>
       </div>

   </div>
</div>
</body>
</html>
