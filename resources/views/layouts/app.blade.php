<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Truis Taartjes') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="/plugins/bootstrap337/css/bootstrap.min.css">
    <link href="/css/app.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/20d6f89a9a.js"></script>
    <!-- <link href="/plugins/owl-carousel/owl.carousel.css" rel="stylesheet"> -->
    <link href="/plugins/summernote/summernote.css" rel="stylesheet">
    <!-- Custom -->
    <link rel="stylesheet" type="text/css" href="/css/custom/menubar.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="/css/custom/preloader.css">
    <link rel="stylesheet" type="text/css" href="/css/custom/mainstyle.css?v=1.0">
    <script type="text/javascript" src="/js/jquery311.min.js"></script>
   
    
@if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) 
<link rel="stylesheet" type="text/css" href="/css/custom/IE.css">
@endif
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>

<div id="web-app">




<nav class="navbar navbar-default nav-bar-custom" role="navigation">
<div class="nav-before-inner">
    <div class="fold-left"></div>
</div>
    <div class="nav-innerstyle">
    <div class="navbar-header">

      <button class="hidden-lg hidden-md open-mob-menu-btn">
        <div class="menu-bar1"></div>
        <div class="menu-bar2"></div>
        <div class="menu-bar3"></div>
      </button>

    <div class="navbar-brand nav-bar-logo">
    <img src='http://i.imgur.com/zy5RPFA.png'/>
    </div>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left navbar-items-left">
        <li><a href="/home" class="nav-menu-link nav-menu-first-link">Home</a></li>
        <li><a href="/taarten" class="nav-menu-link">Taarten</a></li>
        <li><a href="/decoraties" class="nav-menu-link">Decoraties</a></li>
        <li><a href="/anderecreaties" class="nav-menu-link">Anders</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right navbar-items-right">
        @if(!Auth::user())
        <li><a href="/register" class="nav-menu-link">Register</a></li>
        <li><a href="/login" class="nav-menu-link">Login</a></li>
        @else
        @if(Auth::user()->roleID == 2)
        <li><a href="/beheer" class="nav-menu-link">Beheer</a></li>
        @endif
        <li><a href="/profiel/{{Auth::user()->id}}" class="nav-menu-link">Profiel</a></li>
        <li><a href="/logout" class="nav-menu-link">Logout</a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
    </div>
    <div class="nav-after-inner"></div>
    <!-- <button style="width: 100%;">Menu</button> -->
</nav>

<div class="mob-nav-menu hidden-lg hidden-md">
    <div class="row close-menu-row">
            <button class="close-mob-menu-btn">X</button>
    </div>
    <div class="row mob-nav-items-first-row">
        <ul class="nav-mob-menu-ul">
            <div class="mob-menu-left">
                <li><a href="/home" class="nav-mob-menu-link">Home</a></li>
                    <li><a href="/taarten" class="nav-mob-menu-link">Taarten</a></li>
                    <li><a href="/decoraties" class="nav-mob-menu-link">Decoraties</a></li>
                    <li><a href="/anderecreaties" class="nav-mob-menu-link">Anders</a></li>
                </div>
                <div class="mob-menu-right">
                    @if(!Auth::user())
                    <li><a href="/register" class="nav-mob-menu-link">Register</a></li>
                    <li><a href="/login" class="nav-mob-menu-link">Login</a></li>
                    @else
                    @if(Auth::user()->roleID == 2)
                    <li><a href="/beheer" class="nav-mob-menu-link">Beheer</a></li>
                    @endif
                    <li><a href="/profiel/{{Auth::user()->id}}" class="nav-mob-menu-link">Profiel</a></li>
                    <li><a href="/logout" class="nav-mob-menu-link">Logout</a></li>
                    @endif
                </div>
        </ul>
    </div>

</div>

@yield('content')

@include('layouts/includes/footer')

 </div>

    <!-- Scripts -->
    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/javascript" src="/js/isotope302.min.js"></script>
    <script type="text/javascript" src="/js/progressbar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script>
    <script type="text/javascript" src="/plugins/bootstrap337/js/bootstrap.js"></script>
    <!-- Custom -->
    <script type="text/javascript" src="/js/custom/menuscript.js?v=1"></script>
    <script type="text/javascript" src="/js/custom/mainscript.js"></script>
    <script type="text/javascript" src="/js/custom/customisotope.js"></script>
    <script type="text/javascript" src="/plugins/summernote/summernote.min.js"></script>

</body>
</html>
