<!DOCTYPE html>
<html lang="az">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        @yield('head')
        <link rel="stylesheet" href="{{ asset('src/css/common.min.css') }}">
        <link href="https://file.myfontastic.com/fN6z8kuHRQez4DCK2cBE5Y/icons.css" rel="stylesheet">
        @yield('customCss')
    </head>
    <body>
        <section id="animasiya">
            <span class="noqteler"></span>
            <span class="noqteler"></span>
            <span class="noqteler"></span>
            <span class="noqteler"></span>
            <span class="noqteler"></span>
            <span class="noqteler"></span>
            <span class="noqteler"></span>
            <span class="noqteler"></span>
            <span class="noqteler"></span>
            <span class="noqteler"></span>
        </section>
        @include('includes.header')

        @if(!Auth::guest() && !Auth::user()->email_confirmed)
            <section class="alert info">
                <span class="metn">Sizin e-mail ünvanınız təstiqlənməyib. E-mail ünvanınıza göndərilən təstiqləməyə nəzər yetirin və ya hesabınızdan yeni təstiqləmə tələb edin.</span>
            </section>
        @endif

        @if($confirm = Session::get('confirm'))
            @if(is_bool($confirm) && $confirm)
                <section class="alert ugurlu">
                    <span class="metn"><b>Təbriklər!</b> E-mail ünvanınız təstiqləndi.</span>
                    <span class="close">&times;</span>
                </section>
            @elseif(is_bool($confirm) && !$confirm)
                <section class="alert ugursuz">
                    <span class="metn">E-mail təstiqlənməsi uğursuz oldu. Əlaqə bölməsindən istifadə edərək bizimlə əlaqə saxlayın.</span>
                    <span class="close">&times;</span>
                </section>
            @endif
        @endif

        @yield('content')
        @include('includes.footer')
        <script type="text/javascript" src="{{asset('src/js/angular.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('src/js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('src/js/common.js')}}"></script>
        @yield('scripts')

    </body>
</html>