<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ Setting::get('site_title','Xeride') }}</title>

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="{{ Setting::get('site_icon') }}"/>

    <link href="{{asset('asset/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('asset/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('asset/css/style.css')}}" rel="stylesheet">
    
</head>
<body>


    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-analytics.js"></script>

    <script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyA1K-fiMb_nL-6YdI2Gc1x3cEMEE5X41rg",
        authDomain: "touramp-978e5.firebaseapp.com",
        databaseURL: "https://touramp-978e5.firebaseio.com",
        projectId: "touramp-978e5",
        storageBucket: "touramp-978e5.appspot.com",
        messagingSenderId: "27164690994",
        appId: "1:27164690994:web:fc05e169a3cc405cd5ca2b",
        measurementId: "G-FSNJ211FZ5"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
    </script>

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    </script>

    <div id="wrapper">
        <div class="overlay" id="overlayer" data-toggle="offcanvas"></div>

        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li>
                </li>
                <li class="full-white">
                    <a href="{{ url('/register') }}">SIGN UP To RIDE</a>
                </li>
                <li class="white-border">
                    <a href="{{ url('/provider/login') }}">BECOME A DRIVER</a>
                </li>
                <li>
                    <a href="{{ url('/ride') }}">Ride</a>
                </li>
                <li>
                    <a href="{{ url('/drive') }}">Drive</a>
                </li>
                <li>
                    <a href="{{ url('/help') }}">Help</a>
                </li>
                <li>
                    <a href="{{ url('/privacy') }}">Privacy Policy</a>
                </li>
                <li>
                    <a href="{{ url('/terms') }}">Terms and Conditions</a>
                </li>
                <li>
                    <a href="{{ Setting::get('store_link_ios','#') }}"><img src="{{ asset('/asset/img/appstore-white.png') }}"></a>
                </li>
                <li>
                    <a href="{{ Setting::get('store_link_android','#') }}"><img src="{{ asset('/asset/img/playstore-white.png') }}"></a>
                </li>
            </ul>
        </nav>

        <div id="page-content-wrapper">
            <header>
                <nav class="navbar navbar-fixed-top">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>

                            <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                                <span class="hamb-top"></span>
                                <span class="hamb-middle"></span>
                                <span class="hamb-bottom"></span>
                            </button>

                            <a class="navbar-brand" href="{{url('/')}}"><img src="{{ Setting::get('site_logo', asset('logo-black.png')) }}"></a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li @if(Request::url() == url('/ride')) class="active" @endif>
                                    <a href="{{url('/ride')}}">Ride</a>
                                </li>
                                <li @if(Request::url() == url('/drive')) class="active" @endif>
                                    <a href="{{url('/drive')}}">Drive</a>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="{{ url('/help') }}">Help</a></li>
                                <li><a href="{{url('/login')}}">Signin</a></li>
                                <li><a class="menu-btn" href="{{url('/drive')}}">Become a Driver</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>

            @yield('content')
            <div class="page-content">
                <div class="footer row no-margin">
                    <div class="container">
                        <div class="footer-logo row no-margin">
                            <div class="logo-img">
                                <img src="{{Setting::get('site_logo',asset('asset/img/logo-white.png'))}}">
                            </div>
                        </div>
                        <div class="row no-margin">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <ul>
                                    <li><a href="#">Ride</a></li>
                                    <li><a href="#">Drive</a></li>
                                    <li><a href="#">Cities</a></li>
                                    <li><a href="#">Fare Estimate</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <ul>
                                    <li><a href="{{url('ride')}}">Signup to Ride</a></li>
                                    <li><a href="{{url('drive')}}">Become a Driver</a></li>
                                    <li><a href="{{url('ride')}}">Ride Now</a></li>                            
                                </ul>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <h5>Get App on</h5>
                                <ul class="app">
                                    <li>
                                        <a href="{{Setting::get('store_link_ios','#')}}">
                                            <img src="{{asset('asset/img/appstore.png')}}">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{Setting::get('store_link_android','#')}}">
                                            <img src="{{asset('asset/img/playstore.png')}}">
                                        </a>
                                    </li>                                                        
                                </ul>                        
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">                        
                                <h5>Connect us</h5>
                                <ul class="social">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="row no-margin">
                            <div class="col-md-12 copy">
                                <p>{{ Setting::get('site_copyright', '&copy; '.date('Y').' Appoets') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('asset/js/jquery.min.js')}}"></script>
    <script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('asset/js/scripts.js')}}"></script>
    @if(Setting::get('demo_mode', 0) == 1)
        <!-- Start of LiveChat (www.livechatinc.com) code -->
        <script type="text/javascript">
            window.__lc = window.__lc || {};
            window.__lc.license = 8256261;
            (function() {
                var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
                lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
            })();
        </script>
        <!-- End of LiveChat code -->
    @endif
</body>
</html>
