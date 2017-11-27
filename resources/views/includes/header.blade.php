<?php
/**
 * Created by PhpStorm.
 * User: samir
 * Date: 17.08.2017
 * Time: 16:02
 */
?>
<header>
    <section id="yuxari">
        <section>
            <a href="tel:{{env('TELEFON')}}"><span class="ikon store-phone-1"></span>{{env('TELEFON')}}</a>
            <a href="mailto:{{env('MAIL_USERNAME')}}"><span class="ikon store-mail"></span>{{env('MAIL_USERNAME')}}</a>
        </section>
        <section>
            @if(Auth::guest())
                <a href="{{route('daxilol')}}"><span class="ikon store-user"></span>Daxil ol</a>
                <span>və ya</span>
                <a href="{{route('qeydiyyat')}}"><span class="ikon store-users"></span>Qeydiyyatdan keç</a>
            @else
                <span style="color:white">Salam {{ucfirst(mb_strtolower(Auth::user()->ad))}}!</span>
                @if(Auth::user()->isAdmin)
                    <a href="{{route('admin.index')}}" style="text-decoration: underline">Admin Paneli</a>
                @endif
                <a href="{{route('hesabim')}}"><span class="ikon store-user" style="position: relative;top:-1px"></span>Hesabım</a>

                <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="ikon store-sign-out"></span>Çıxış</a>
                <form id="logout-form" action="{{ route('cixis') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
                </form>
            @endif
        </section>
    </section>
    <section id="header">
        <section>
            <a href="{{route('home')}}"><img src="{{ asset('src/images/logo.png') }}" alt="logo"></a>
        </section>
        <span id="hamburger-nav">
            <span></span>
            <span></span>
            <span></span>
        </span>
        <form action="{{route('axtaris')}}" method="get" id="axtaris-form">
            <select name="kateqoriya">
                <option value="0" selected>Bütün kateqoriyalar</option>
                @foreach(App\KateqoriyaModel::kateqoriyalarlist() as $category)
                    @if(is_array($category['multi']))
                        <optgroup label="{{ ucfirst(mb_strtolower(htmlspecialchars_decode($category['kateqoriya_ad']))) }}">
                        @foreach($category['multi'] as $multi_category)
                            <option value="{{$category['id']}}_{{$multi_category['id']}}">&nbsp;&nbsp;&nbsp;{{ucfirst(mb_strtolower(htmlspecialchars_decode($multi_category['kateqoriya_ad'])))}}</option>
                        @endforeach
                        </optgroup>
                    @else
                        <option value="{{$category['id']}}">{{ucfirst(mb_strtolower(htmlspecialchars_decode($category['kateqoriya_ad'])))}}</option>
                    @endif
                @endforeach
            </select>
            <input placeholder="Axtarış edin..." name="acarsoz" required>
            <input type="submit" value="AXTAR">
        </form>
    </section>
    <nav>
        <ul>
            @foreach(App\KateqoriyaModel::kateqoriyalarlist() as $category)
                @if(is_array($category['multi']))
                    <li class="multi-menu">
                        {{----}}
                        <a href="{{route('kat',['id'=>$category['slug']])}}" style="text-transform: uppercase">{{$category['kateqoriya_ad']}} <span class="store-arrow-down-b ikon"></span></a>
                        <section>
                            <hr>
                            {{--<h1>{{ucfirst(htmlspecialchars_decode(mb_strtolower($category['kateqoriya_ad'])))}}</h1>--}}
                            <section class="list">
                                <ul>
                                    @foreach($category['multi'] as $index=>$multi_category)
                                            <li><a href="{{route('multikat',['id'=>$multi_category['slug']])}}">{{ucfirst(mb_strtolower(htmlspecialchars_decode($multi_category['kateqoriya_ad'])))}}</a></li>
                                    @endforeach
                                </ul>
                            </section>
                        </section>
                    </li>


                @else
                    <li><a href="{{route('kat',['id'=>$category['slug']])}}" style="text-transform: uppercase">{{$category['kateqoriya_ad']}}</a></li>
                @endif
            @endforeach
            <li><a href="#">ÇATDIRILMA</a></li>
            <li><a href="#">ƏLAQƏ</a></li>
        </ul>
        <ul>
            <li><a href="#"><span class="ikon store-heart"></span><span class="nomre istek">0</span>İstək siyahısı</a></li>
            <li><a href="#"><span class="ikon store-bag"></span><span class="nomre sebet">0</span>Səbət</a></li>
            <li id="axtaris" style="display: none"><a><span style="margin-right: 6px;position:relative;top:-1px" class="ikon store-search"></span>Axtarış</a></li>
        </ul>
    </nav>
</header>