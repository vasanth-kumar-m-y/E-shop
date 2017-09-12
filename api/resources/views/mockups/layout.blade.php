<!doctype html>
<html lang="en" ng-app="shop">
    <head>
        
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>
            ShopApp ecommerce 
        </title>

        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.css"/>
        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap-theme.css"/>
        <link rel="stylesheet" href="/mockups/css/app.css"/>
        <link rel="stylesheet" href="/mockups/css/animations.css"/>
        <link href='https://fonts.googleapis.com/css?family=Fredoka+One|Comfortaa' rel='stylesheet' type='text/css'/>

        @yield('head.post')
    </head>

    <body>
        @yield('body.pre')

        <div class="container">
            <header class="row">
                @include('mockups.header')
            </header>
            <div class="main">
            	@yield('content')
            </div>
        </div>

        <script src="/bower_components/jquery/dist/jquery.js">
        </script>
        <script src="/bower_components/bootstrap/dist/js/bootstrap.js">
        </script>
        <script src="/bower_components/angular/angular.js">
        </script>
        <script src="/bower_components/angular-animate/angular-animate.js">
        </script>
        <script src="/bower_components/angular-route/angular-route.js">
        </script>
        <script src="/bower_components/angular-resource/angular-resource.js">
        </script>
        <script src="/mockups/js/shop.module.js">
        </script>
        <script src="/mockups/js/shop.controller.js">
        </script>

        @yield('body.post')
    </body>
</html>
