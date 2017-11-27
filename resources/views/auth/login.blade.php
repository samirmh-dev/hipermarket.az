@extends('layouts.master')

@section('head')
    <title>Daxil ol - {{env('APP_NAME')}}</title>
    <meta name="description" content="">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="{{asset('src/css/qeydiyyat.min.css')}}">
@endsection

@section('customCss')
    <style type="text/css">
        #qeydiyyat form{
            flex-direction: column;
            width: 480px;
        }
        .formGroup{
            margin-right: 0!important;
        }
    </style>
@endsection

@section('scripts')
@endsection

@section('content')
    <section id="qeydiyyat">
        <h1>GİRİŞ</h1>
        <span>Hələdə hesabınız yoxdur? Onda <a href="{{route('qeydiyyat')}}">qeydiyyatdan keçin</a></span>
        @if($status = Session::get('status'))
            <span style="margin-top: 15px;color:green">{{$status}}</span>
        @endif
        <form action="{{route('daxilol')}}" method="POST">
            {{csrf_field()}}
            <section class="formGroup">
                <input type="text" name="username" required autofocus value="{{old('username')}}">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>İstifadəçi adı</label>
                <span class="error">
                    @if ($errors->has('username'))
                        {{ $errors->first('username') }}
                    @endif
                </span>
            </section>
            <section class="formGroup">
                <input type="password" name="password" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Şifrə</label>
                <span class="error">
                    @if ($errors->has('password'))
                        {{ $errors->first('password') }}
                    @endif
                </span>
            </section>
            <section id="login-action">
                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Yadda saxla</label>
                <a href="{{ route('password.request') }}">Şifrəni unutmusunuz?</a>
            </section>
            <input type="submit" value="DAVAM ET">
        </form>
    </section>
@endsection
