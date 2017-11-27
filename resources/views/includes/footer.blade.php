<?php
/**
 * Created by PhpStorm.
 * User: samir
 * Date: 17.08.2017
 * Time: 16:03
 */
?>
<footer>
    <section>
        <ul>
            <li><a href="#"><span class="store-facebook-squared ikon"></span></a></li>
            <li><a href="#"><span class="store-instagrem ikon"></span></a></li>
        </ul>
    </section>
    <a href="{{route('home')}}"><img src="{{asset('src/images/logo.png')}}" alt="logo"></a>
    <section id="info">
        <span>{{env('APP_NAME')}}</span>
        <span>Bakı, Azərbaycan</span>
        <span><a href="tel:{{env('TELEFON')}}">Telefon: {{env('TELEFON')}}</a></span>
        <span><a href="mailto:{{env('MAIL_USERNAME')}}">E-mail: {{env('MAIL_USERNAME')}}</a></span>
    </section>
    <section><a href="https://www.google.com/maps" target="_blank"><span class="store-map-pin-fill ikon"></span>Bizi xəritədə tap!</a></section>
</footer>
