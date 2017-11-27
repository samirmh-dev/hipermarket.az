<!DOCTYPE html>
<html lang="az">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin paneli</title>

    <link rel="stylesheet" href="{{asset('src/admin/css/jquery-ui-1.10.3.custom.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/admin/css/entypo.css')}}">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{asset('src/admin/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('src/admin/css/neon-core.css')}}">
    <link rel="stylesheet" href="{{asset('src/admin/css/neon-theme.css')}}">
    <link rel="stylesheet" href="{{asset('src/admin/css/neon-forms.css')}}">
    <link rel="stylesheet" href="{{asset('src/admin/css/custom.css')}}">

    <link href="https://file.myfontastic.com/fN6z8kuHRQez4DCK2cBE5Y/icons.css" rel="stylesheet">

    <script src="{{asset('src/js/jquery.min.js')}}"></script>

    <!--[if lt IE 9]>
    <script src="{{asset('src/admin/js/ie8-responsive-file-warning.js')}}"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('custom-css')

    <style>

        [type="radio"]:not(:checked) {
            position: relative;
            left: -9999px; }
        [type="radio"]:not(:checked) + label {
            position: relative;
            padding-left: 1.5em;
            cursor: pointer; }

        [type="radio"]:checked {
            position: relative;
            left: -9999px; }
        [type="radio"]:checked + label {
            position: relative;
            padding-left: 1.5em;
            cursor: pointer; }

        [type="radio"]:not(:checked) + label:before,
        [type="radio"]:checked + label:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 1.1em;
            height: 1.1em;
            border: 2px solid #1B252F;
            background: #fff;
            border-radius: 4px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1); }

        [type="radio"]:not(:checked) + label:after,
        [type="radio"]:checked + label:after {
            content: "✔";
            position: absolute;
            top: 0.287em;
            left: 0.17em;
            font-size: 0.95em;
            line-height: 0.8;
            color: #1B252F;
            font-weight: 700;
            transition: all 0.4s ease-in-out; }

        [type="radio"]:not(:checked) + label:after {
            opacity: 0;
            transform: scale(0); }

        [type="radio"]:checked + label:after {
            opacity: 1;
            transform: scale(1); }

        [type="radio"]:disabled:not(:checked) + label:before,
        [type="radio"]:disabled:checked + label:before {
            box-shadow: none;
            border-color: #bbb;
            background-color: #ddd; }

        [type="radio"]:disabled:checked + label:after {
            color: #999; }

        [type="radio"]:disabled + label {
            color: #aaa; }

        [type="radio"]:checked:focus + label:before,
        [type="radio"]:not(:checked):focus + label:before {
            border: 2px solid #1B252F; }

        label:hover:before {
            border: 2px solid #1B252F !important; }

    </style>
</head>
<body class="page-body  page-fade" data-url="http://neon.dev">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <div class="sidebar-menu">

        <div class="sidebar-menu-inner">

            <header class="logo-env"  style="display: flex; align-items: center;justify-content: space-between">

                <!-- logo -->
                <div class="logo">
                    <a href="{{route('home')}}">
                        <img src="{{asset('src/images/logo.png')}}" width="120" alt="" />
                    </a>
                </div>

                <!-- logo collapse icon -->
                <div class="sidebar-collapse">
                    <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>


                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>

            </header>


            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

                <li>
                    <a href="{{route('slide.index')}}">
                        <i class="entypo-picture"></i>
                        <span class="title">Slide</span>
                    </a>
                </li>



                <li>
                    <a href="{{route('kateqoriyalar.index')}}">
                        <i class="entypo-layout"></i>
                        <span class="title">Kateqoriyalar</span>
                    </a>
                </li>



                <li>
                    <a href="{{route('multi-kateqoriyalar.index')}}">
                        <i class="entypo-layout"></i>
                        <span class="title">Multi kateqoriyalar</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('mallar.index')}}">
                        <i class="entypo-bag"></i>
                        <span class="title">Mallar</span>
                    </a>
                </li>
            </ul>

        </div>

    </div>

    <div class="main-content">
        <div class="row" style="display: flex;align-items: center;justify-content: space-between;font-size: 15px!important;">

            <!-- Profile Info and Notifications -->
            <div class="col-md-6 col-sm-8 clearfix">

                <ul class="user-info pull-left pull-none-xsm">

                    <!-- Profile Info -->
                    <li class="profile-info dropdown pull-right"><!-- add class "pull-right" if you want to place this from right -->

                        {{--{{route('hesabim.index')}}--}}
                        <a style="display: flex;justify-content: flex-start;align-items: center" href="">
                            <span class="store-user" style="color:#303641;display:flex;font-size: 19px;margin-right: 10px;"></span>{{ucfirst(mb_strtolower(Auth::user()->ad))}}
                        </a>
                    </li>

                </ul>



            </div>


            <!-- Raw Links -->
            <div class="col-md-6 col-sm-4 clearfix">

                <ul class="list-inline links-list pull-right">

                    {{--<li class="sep"></li>--}}

                    <li>
                        <a href="" style="display: flex;justify-content: center;align-items: center" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="entypo-logout right" style="display: flex;align-items: center"></i>Çıxış</a>
                        <form id="logout-form" action="{{ route('cixis') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>

            </div>

        </div>

        <hr>

        @yield('content')

    </div>

</div>


<!-- Imported styles on this page -->
<link rel="stylesheet" href="{{asset('src/admin/css/jquery-jvectormap-1.2.2.css')}}">
<link rel="stylesheet" href="{{asset('src/admin/css/rickshaw.min.css')}}">

<!-- Bottom scripts (common) -->
<script src="{{asset('src/admin/js/TweenMax.min.js')}}"></script>
<script src="{{asset('src/admin/js/jquery-ui-1.10.3.minimal.min.js')}}"></script>
<script src="{{asset('src/admin/js/bootstrap.js')}}"></script>
<script src="{{asset('src/admin/js/joinable.js')}}"></script>
<script src="{{asset('src/admin/js/resizeable.js')}}"></script>
<script src="{{asset('src/admin/js/neon-api.js')}}"></script>
<script src="{{asset('src/admin/js/jquery-jvectormap-1.2.2.min.js')}}"></script>


<!-- Imported scripts on this page -->
<script src="{{asset('src/admin/js/jquery-jvectormap-europe-merc-en.js')}}"></script>
<script src="{{asset('src/admin/js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('src/admin/js/d3.v3.js')}}"></script>
<script src="{{asset('src/admin/js/rickshaw.min.js')}}"></script>
<script src="{{asset('src/admin/js/raphael-min.js')}}"></script>
<script src="{{asset('src/admin/js/morris.min.js')}}"></script>
<script src="{{asset('src/admin/js/toastr.js')}}"></script>
<script src="{{asset('src/admin/js/neon-chat.js')}}"></script>


<!-- JavaScripts initializations and stuff -->
<script src="{{asset('src/admin/js/neon-custom.js')}}"></script>


<!-- Demo Settings -->
<script src="{{asset('src/admin/js/neon-demo.js')}}"></script>

@yield('custom-js')

</body>
</html>