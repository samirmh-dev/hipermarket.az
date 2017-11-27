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
        <span>
        @if (session('status'))
            {{ session('status') }}
        @endif
        </span>
        <form action="{{ route('password.email') }}" method="POST">
            {{csrf_field()}}
            <section class="formGroup">
                <input type="text" name="email" required value="{{old('email')}}">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>E-mail</label>
                <span class="error">
                    @if ($errors->has('email'))
                        {{ $errors->first('email') }}
                    @endif
                </span>
            </section>

            <input type="submit" value="DAVAM ET">
        </form>
    </section>
@endsection
