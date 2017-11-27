@extends('layouts.master')

@section('head')
    <title>Qeydiyyat - {{env('APP_NAME')}}</title>
    <meta name="description" content="">
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="{{asset('src/css/qeydiyyat.min.css')}}">
@endsection

@section('customCss')
@endsection

@section('scripts')
@endsection

@section('content')
    <section id="qeydiyyat">
        <h1>QEYDİYYAT</h1>
        <span>Artıq qeydiyyatdan keçmisiniz? Onda sistemə <a href="{{route('daxilol')}}">daxil olun</a></span>
        <form action="{{route('qeydiyyat')}}" method="POST">
            {{csrf_field()}}
            <section class="formGroup">
                <input type="text" name="ad" required autofocus value="{{old('ad')}}">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Adınız</label>
                <span class="error">
                    @if ($errors->has('ad'))
                        {{ $errors->first('ad') }}
                    @endif
                </span>
            </section>
            <section class="formGroup">
                <input type="text" name="soyad" required value="{{old('soyad')}}">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Soyadınız</label>
                <span class="error">
                    @if ($errors->has('soyad'))
                        {{ $errors->first('soyad') }}
                    @endif
                </span>
            </section>
            <section class="formGroup">
                <input type="text" name="email" required value="{{old('email')}}">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>E-mail ünvanınız</label>
                <span class="error">
                    @if ($errors->has('email'))
                        {{ $errors->first('email') }}
                    @endif
                </span>
            </section>
            <section class="formGroup">
                <input type="text" name="username" required value="{{old('username')}}">
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>İstifadəçi adınız</label>
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

            <section class="formGroup">
                <input type="password" name="password_confirmation" required>
                <span class="highlight"></span>
                <span class="bar"></span>
                <label>Şifrəni təstiqləyin</label>
            </section>


            <input type="submit" value="DAVAM ET">
        </form>
    </section>
@endsection
