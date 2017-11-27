@extends('layouts.master')

@section('head')
    <title>Şifrənin yenilənməsi - {{env('APP_NAME')}}</title>
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
        <h1>ŞİFRƏNİN YENİLƏNMƏSİ</h1>
        <span style="margin-top: 15px;color:red">
        @if (session('status'))
            {{ session('status') }}
        @endif
        </span>
        <form action="{{ route('password.reseting') }}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="token" value="{{ $token }}">
            <section class="formGroup">
                <input type="text" name="email" required value="{{ $email or old('email') }}" autofocus >
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>E-mail</label>
                <span class="error">
                    @if ($errors->has('email'))
                        {{ $errors->first('email') }}
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

            <section class="formGroup">
                <input type="password" name="password_confirmation" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Şifrəni təstiqləyin</label>
                <span class="error">
                    @if ($errors->has('password_confirmation'))
                        {{ $errors->first('password_confirmation') }}
                    @endif
                </span>
            </section>

            <input type="submit" value="DAVAM ET">
        </form>
    </section>
@endsection



