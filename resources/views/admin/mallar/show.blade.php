<?php
/**
 * Created by PhpStorm.
 * User: samir
 * Date: 20.08.2017
 * Time: 10:23
 */
?>
@extends('layouts.admin')
@php $rengler=['qirmizi','qara','çəhrayı','narıncı','sarı','bənövşəyi','yaşıl','mavi','qəhvəyi','ağ','boz'] @endphp

@section('content')
    <a href="{{route('mallar.deyis-form',['id'=>$id])}}">
        <button class="elaveet btn btn-xs" data-title="Sil" style="color:#303641;width: 85px;display: flex;justify-content: center;align-items: center;margin-bottom: 15px;" data-toggle="modal" data-target="#add" >
            <span class="entypo-pencil" style="font-size: 20px;"></span>Dəyişdir
        </button>
    </a>
    <section class="col-sm-4" style="display: flex;flex-direction: column;align-items:flex-start;justify-content: flex-start;font-size: 18px">
        <span><b>Kod: {{$content['kod']}}</b></span>
        <span><b>Ad: </b>{{ucfirst(mb_strtolower($content['ad']))}}</span>
        <span><b>Melumat:</b><br><p>{{$content['melumat']}}</p></span>
        <span><b>Qiymət:</b>&nbsp;{{$content['qiymet']}} AZN</span>

        <span>
            @if(isset(explode( '_', $content['kateqoriya'])[1]))
                @foreach($kateqoriyalar as $kateqoriya)
                    @if($kateqoriya['id']==explode( '_', $content['kateqoriya'])[0])
                        {{$kateqoriya['kateqoriya_ad']}} -
                    @endif
                @endforeach
                @foreach($multikateqoriyalar as $multikateqoriya)
                    @if($multikateqoriya['id']==explode( '_', $content['kateqoriya'])[1])
                        {{$multikateqoriya['kateqoriya_ad']}}
                    @endif
                @endforeach
            @else
                @foreach($kateqoriyalar as $kateqoriya)
                    @if($kateqoriya['id']==explode( '_', $content['kateqoriya'])[0])
                        {{$kateqoriya['kateqoriya_ad']}}
                    @endif
                @endforeach
            @endif
        </span>


        <span><b>Ölçülər:</b><br>
            <p style="margin-left: 15px">
                @foreach($content['olculer'] as $olcu)
                    {{$olcu}},
                @endforeach
            </p></span>

        {{--<span><b>Rənglər:</b><br>--}}
            {{--<p style="margin-left: 15px">--}}
                {{--@foreach($content['rengler'] as $reng)--}}
                    {{--{{$rengler[$reng]}},--}}
                {{--@endforeach--}}
            {{--</p></span>--}}

        <span><b>Xüsusiyyətlər:</b><br>
            <p style="margin-left: 15px">
                @if(isset($content['xususiyyetler']))
                    @foreach($content['xususiyyetler'] as $xususiyyet)
                        {{$xususiyyet['xususiyyet']}}:&nbsp;{{$xususiyyet['teyinat']}}<br>
                    @endforeach
                @else
                    yoxdur
                @endif
            </p></span>

        <span><b>Endirim: </b>{{$content['endirim']}}&nbsp;%</span>

        <span><b>Stokda: </b>{{$content['stok']}}</span>

    </section>
    <section class="col-sm-8" style="display: flex;align-items:flex-start;justify-content: flex-start;flex-wrap:wrap;font-size: 18px">
        @foreach($content['sekiller'] as $sekil)
            <a href="{{asset('src/images/stock/'.$sekil)}}" target="_blank" style="margin-bottom: 5px;">
                <img src="{{asset('src/images/500x659/'.$sekil)}}" alt="" style="margin-right: 15px">
            </a>
        @endforeach
    </section>
@endsection
